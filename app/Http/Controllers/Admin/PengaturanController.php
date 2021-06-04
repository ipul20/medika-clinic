<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->waktu = date('H:i:s');
        $this->tanggal = date('Y-m-d');
    }
    public function index()
    {
        $waktu = $this->waktu;
        $jadwal = Jadwal::where([['mulai', '<', $waktu]])->get();

        return view('admin.pengaturanjadwal.index', compact(['jadwal']));
    }
    public function skip($id)
    {
        $tanggal = $this->tanggal;
        $cek = Reservasi::where([['dokter_id', $id], ['tanggal', $tanggal], ['status', '0']])->count();
        $no = Helper::getAntrian($id) + 1;
        $ada = Reservasi::where([['dokter_id', $id], ['tanggal', $tanggal], ['status', '0'], ['no_antrian', '>=', $no]])->count();
        if ($cek == 0) {
            Helper::akhiriAntrian($id);
        } elseif ($ada == 0) {
            Helper::akhiriAntrian($id);
        } else {
            $data = Reservasi::where([['dokter_id', $id], ['tanggal', $tanggal], ['status', '0']])->first();

            $dokter = $data->dokter->nama;
            $no = sprintf("%03d", $no);
            Helper::updateAntrian($id, $dokter, $no);
            $namadokter = $data->dokter->nama;
            $data = Reservasi::where([['dokter_id', $id], ['tanggal', $tanggal], ['status', '0']])->limit(3)->get();
            foreach ($data as $v) {
                if ($v['no_antrian'] == $no) {
                    $user_id = $v->pasien->user_id;
                    $pesan = "sekarang adalah giliran anda";
                    Helper::notif($user_id, $pesan);
                } else {
                    $user_id = $v->pasien->user_id;
                    $pesan = "No Antrian Selanjutnya " . $namadokter . "-" . $no;
                    Helper::notif($user_id, $pesan);
                }
            }
        }
    }
}
