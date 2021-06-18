<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Resep;
use App\Models\Reservasi;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class PemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->title = 'pemeriksaan';
        $this->tanggal = date('Y-m-d');
    }
    public function index($id)
    {
        $data = Reservasi::where('id', $id)->first();
        $title = $this->title;
        return view('admin.' . $title . '.index', $data);
    }

    public function store(Request $request)
    {
        $post = $request->all();
        $post['tanggal'] = date('Y-m-d');
        $id = $post['id'];
        $data = Reservasi::where('id', $id)->first();
        $post['pasien_id'] = $data['pasien_id'];
        $post['poli_id'] = $data['poli_id'];
        $post['dokter_id'] = $data['dokter_id'];
        $cek = Pemeriksaan::create($post);
        $no = 0;
        foreach ($post['obat'] as $data) {
            $resep = new Resep;
            $resep->pemeriksaan_id = $cek['id'];
            $resep->obat = $data;
            $resep->aturan = $post['aturan'][$no];
            $resep->jumlah = $post['jumlah'][$no];

            $resep->save();
            $no++;
        }
        $data = Reservasi::where('id', $id)->update(['status' => '1']);
        $data = Reservasi::where('id', $id)->first();
        $no = Helper::getAntrian($data['dokter_id']);
        if ($data['no_antrian'] >= $no) {
            $nomor = sprintf("%03d", $no + 1);

            $selanjutnya = Reservasi::where([['dokter_id', $data['dokter_id']], ['status', '0'], ['no_antrian', '>=', $no]])->limit(3)->get();
            $cek = Reservasi::where([['dokter_id', $data['dokter_id']], ['status', '0'], ['no_antrian', '>=', $no]])->first();
            $noantrian = sprintf("%03d", $cek->no_antrian);
            $iddokter = $cek->dokter_id;
            $namadokter = $cek->dokter->nama;
            if (count($selanjutnya) != 0) {
                foreach ($selanjutnya as $selanjutnya => $v) {
                    if ($selanjutnya == 0) {
                        if ($v->pasien->user_id != null) {
                            $user_id = $v->pasien->user_id;
                            $pesan = "Selanjutnya adalah giliran anda";
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
                Helper::akhiriAntrian($data['dokter_id']);
            }
        }

        return redirect(route('reservasi'));
    }

    public function riwayat()
    {
        $title = $this->title;
        return view('admin.' . $title . '.riwayat', compact('title'));
    }

    public function show(Request $request)
    {
        $jml = $request->jml == '' ? '5' : $request->jml;
        $title = $this->title;
        $data = Pemeriksaan::when($request->input('cari'), function ($query) use ($request) {
            $query->where('keluhan', 'like', "%{$request->input('cari')}%")
                ->orWhere('diagnosa', "like", "%{$request->input('cari')}%");
        })
            ->paginate($jml);
        $view = view('admin.' . $this->title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
            1) * $jml)->render();
        return response()->json([
            "total_page" => $data->lastpage(),
            "total_data" => $data->total(),
            "html"       => $view,
        ]);
    }

    public function export($id)
    {
        $title = $this->title;
        $tanggal = $this->tanggal;
        if ($id == 1) {
            $data = Pemeriksaan::all();
        } elseif ($id == 0) {
            $data = Pemeriksaan::where('tanggal', $tanggal)->get();
        }
        // return view('admin.' . $title . '.export', compact('data'));
        $pdf = PDF::loadview('admin.' . $title . '.export', ['data' => $data])->setPaper('A4');
        return $pdf->stream('kartupasien.pdf');
    }
}
