<?php

namespace App\Http\Controllers\Api;

use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        $response = [
            'message' => 'daftar poli',
            'data' => $poli
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function jadwal()
    {
        $data = [];
        $poli = Poli::all();
        foreach ($poli as $v) {
            $dokter = Dokter::where('poli_id', $v['id'])->get();
            $cek = [];
            foreach ($dokter as $d) {
                $jadwal = Jadwal::where('dokter_id', $d['id'])->get();
                $cek[] = [
                    'nama_dokter' => $d['nama'],
                    'jadwal' => $jadwal,
                ];
            }
            $data[] = [
                'nama_poli' => $v['nama'],
                'dokter' => $cek,
            ];
        }
        $response = [
            'message' => 'daftar jadwal',
            'data' => $data,
            'status' => true,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
