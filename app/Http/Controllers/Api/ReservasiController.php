<?php

namespace App\Http\Controllers\Api;

use App\Models\Resep;
use App\Models\Reservasi;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->tanggal = date('Y-m-d');
        $this->waktu = date('H:i:s');
        $this->tutup = date('H:i:s', strtotime('21:00:00'));
        $this->buka = date('H:i:s', strtotime('08:00:00'));
    }
    public function store(Request $request)
    {
        $tanggal = $this->tanggal;
        $model = $request->all();
        $model['tanggal'] = $tanggal;
        $idpasien = $model['pasien_id'];
        $poli = $model['poli_id'];
        $dokter = $model['dokter_id'];
        $jadwal = $model['jadwal_id'];
        $data = Reservasi::where([['tanggal', $tanggal], ['pasien_id', $idpasien], ['status', '0']])->count();
        if ($data == 0) {
            $jumlah = Reservasi::where([['tanggal', $tanggal], ['poli_id', $poli], ['dokter_id', $dokter], ['jadwal_id', $jadwal]])->count();
            if ($jumlah == 0) {
                $model['no_antrian'] = 1;
            } else {
                $cek = Reservasi::where([['tanggal', $tanggal], ['poli_id', $poli], ['dokter_id', $dokter], ['jadwal_id', $jadwal]])->max('no_antrian') + 1;
                $model['no_antrian'] = $cek;
            }
            $berhasil = Reservasi::create($model);
            $berhasil['no_antrian'] = $berhasil->dokter->nama . "-" . sprintf("%03d", $berhasil['no_antrian']);
            $response = [
                'message' => 'Reservasi berhasil',
                'data' => $berhasil,
                'status' => true
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'message' => 'Anda memiliki reservasi',
                'status' => false
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function status()
    {
        $waktu = $this->waktu;
        $buka = $this->buka;
        $tutup = $this->tutup;
        $tutup = date('H:i:s', strtotime('21:00:00'));
        if ($waktu < $buka || $waktu > $tutup) {
            $response = [
                'message' => 'reservasi online dibuka pada pukul 10:00 - 20:30',
                'status' => false,
            ];
        } else {
            $response = [
                'message' => 'reservasi aktif',
                'status' => true,
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function reservasi($id)
    {
        $tanggal = $this->tanggal;
        $data = Reservasi::where([['tanggal', $tanggal], ['pasien_id', $id], ['status', '0']])->first();
        if (!$data) {
            $response = [
                'message' => 'Anda belum melakukan reservasi',
                'status' => false
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $jadwal = $data['jadwal']['mulai'] . " - " . $data['jadwal']['selesai'];
            $tanggal = date('d F Y', strtotime($data['tanggal']));
            $waktu = date('H:i ', strtotime($data['waktu']));
            $data['waktu'] = $jadwal;
            $data['tanggal'] = $tanggal;
            $data['no_antrian'] = $data->dokter->nama . "-" . sprintf("%03d", $data['no_antrian']);
            $response = [
                'message' => 'data reservasi sesuai id',
                'status' => true,
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function batal($id)
    {
        $sekarang = $this->tanggal;
        $reservasi = Reservasi::where([['tanggal', $sekarang], ['status', '0'], ['pasien_id', $id]])->update(['status' => '2']);
        $response = [
            'message' => 'reservasi berhasil di batalkan',
            'status' => true,
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function riwayat($id)
    {
        $data = Pemeriksaan::where('pasien_id', $id)->get();
        $cek = [];
        foreach ($data as $b) {
            $resep = Resep::where('pemeriksaan_id', $b['id'])->get();

            $cek[] = [
                'tanggal' => date('d F Y', strtotime($b['tanggal'])),
                "id" => $b['id'],
                'resep' => $resep,
                'keluhan' => $b['keluhan'],
                'diagnosa' => $b['diagnosa'],
                'nama_dokter' => $b['dokter']['nama'],
                'nama_poli' => $b['poli']['nama'],
            ];
        }
        $response = [
            'message' => 'anda belum memiliki riwayat',
            'status' => true,
            'data' => $cek,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
