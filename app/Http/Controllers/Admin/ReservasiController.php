<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Dokter;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->title = 'reservasi';
        $this->tanggal = date('Y-m-d');
        $this->waktu = date('H:i:s');
        //        $this->middleware("roles:{$this->title}");
    }

    public function index()
    {
        $title = $this->title;
        $waktu = $this->waktu;
        $tanggal = $this->tanggal;
        $jadwal = Jadwal::where('mulai', "<", $waktu)->get();
        foreach ($jadwal as $jadwal) {
            $reservasi = Reservasi::where([['dokter_id', $jadwal['dokter_id']], ['tanggal', $tanggal], ['status', '0']])->count();
            if ($reservasi > 0) {
                $cek = Reservasi::where([['dokter_id', $jadwal['dokter_id']], ['tanggal', $tanggal], ['status', '0']])->first();
                $noantrian = sprintf("%03d", $cek->no_antrian);
                $iddokter = $cek->dokter_id;
                $namadokter = $cek->dokter->nama;
                $status = Helper::getStatusAntrian($jadwal['dokter_id']);
                if ($status == false) {
                    $data = Reservasi::where([['dokter_id', $jadwal['dokter_id']], ['tanggal', $tanggal], ['status', '0']])->limit(3)->get();
                    foreach ($data as $data => $v) {
                        if ($data == 0) {
                            if ($v->pasien->user_id != null) {
                                $user_id = $v->pasien->user_id;
                                $pesan = "sekarang adalah giliran anda";
                                Helper::updateAntrian($iddokter, $namadokter, $noantrian);
                                Helper::notif($user_id, $pesan);
                            }
                        } else {
                            if ($v->pasien->user_id != null) {
                                $user_id = $v->pasien->user_id;
                                $pesan = "No Antrian Selanjutnya " . $namadokter . "-" . $noantrian;
                                Helper::notif($user_id, $pesan);
                            }
                        }
                    }
                } else {
                    Helper::akhiriAntrian($jadwal['dokter_id']);
                }
            }
        }
        $d = Reservasi::where([['tanggal', '<', $tanggal], ['status', '0']])->update(['status' => '2']);
        return view('admin.' . $title . '.index', compact('title'));
    }

    public function show(Request $request)
    {
        $jml = $request->jml == '' ? '5' : $request->jml;
        $title = $this->title;
        $tanggal = $this->tanggal;
        if (auth()->user()->role == 'dokter') {
            $username = auth()->user()->username;
            $dokter = Dokter::where('nip', $username)->first();
            $data = Reservasi::when($request->input('cari'), function ($query) use ($request) {
                $query->where('tanggal', 'like', "%{$request->input('cari')}%");
            })->where([['status', '0'], ['dokter_id', $dokter['id']], ['tanggal', $tanggal]])
                ->paginate($jml);
        } else {
            $data = Reservasi::when($request->input('cari'), function ($query) use ($request) {
                $query->where('tanggal', 'like', "%{$request->input('cari')}%");
            })->where([['status', '0'], ['tanggal', $tanggal],])
                ->orderBy('poli_id')
                ->paginate($jml);
        }
        $view = view('admin.' . $this->title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
            1) * $jml)->render();
        return response()->json([
            "total_page" => $data->lastpage(),
            "total_data" => $data->total(),
            "html"       => $view,
        ]);
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
            return response()->json($berhasil);
        } else {
            return false;
        }

        $data = Reservasi::create($model);
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = Reservasi::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Reservasi::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Reservasi::find($id)->update(['status' => '2']);
        return response()->json($data);
    }

    public function dokter($id)
    {
        $waktu = $this->waktu;
        $dokter = Dokter::where([['poli_id', $id], ['status', 1]])->get();
        echo "<option value='' selected disabled hidden>Choose here</option>";
        foreach ($dokter as $data) {
            $jadwal = Jadwal::where([['dokter_id', $data->id], ['selesai', '>', $waktu]])->count();
            if ($jadwal != null) {
                echo "<option value='$data->id'>$data->nama</option>";
            }
        }
    }

    public function jadwal($id)
    {
        $waktu = $this->waktu;
        $jadwal = Jadwal::where([['dokter_id', $id], ['selesai', '>', $waktu]])->get();
        echo "<option value='' selected disabled hidden>Choose here</option>";
        foreach ($jadwal as $data) {
            echo "<option value='$data->id'>$data->mulai  -  $data->selesai</option>";
        }
    }
}
