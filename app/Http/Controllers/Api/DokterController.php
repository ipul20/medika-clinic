<?php

namespace App\Http\Controllers\Api;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Symfony\Component\HttpFoundation\Response;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->waktu = date('H:i:s');
    }

    public function index($id)
    {
        $cek = [];
        $waktu = $this->waktu;
        $dokter = Dokter::where([['poli_id', $id], ['status', 1]])->get();
        foreach ($dokter as $d) {
            $jadwal = Jadwal::where([['dokter_id', $d->id], ['selesai', '>', $waktu]])->count();
            if ($jadwal != null) {
                $sesi = Jadwal::where([['dokter_id', $d->id], ['selesai', '>', $waktu]])->get();
                $cek[] = [
                    'id' => $d['id'],
                    'nama_dokter' => $d['nama'],
                    'poli_id' => $d['poli_id'],
                    'jadwal' => $sesi,
                ];
            }
        }
        if ($cek != null) {
            $response = [
                'message' => 'daftar dokter',
                'data' => $cek,
                'status' => true
            ];
        } else {
            $response = [
                'message' => 'Dokter tidak tersedia',
                'status' => false,
            ];
        }


        // $cek = [];
        // foreach ($data as $d) {
        //     $jadwal = Jadwal::where('dokter_id', $d['id'])->get();
        //     $cek[] = [
        //         'id' => $d['id'],
        //         'nama_dokter' => $d['nama'],
        //         'poli_id' => $d['poli_id'],
        //         'jadwal' => $jadwal,
        //     ];
        // }

        return response()->json($response, Response::HTTP_OK);
    }
}
