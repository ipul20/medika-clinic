<?php

namespace App\Http\Controllers\Api;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class PasienController extends Controller
{
    public function user($id)
    {
        $data = Pasien::where('user_id', $id)->first();

        if (!$data) {
            $response = [
                'message' => 'data pasien',
                'status' => false,
            ];
        } else {
            $response = [
                'message' => 'data pasien',
                'data' => $data,
                'status' => true,
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function regis(Request $request)
    {

        $data = $request->all();
        $nik = $data['nik'];
        $cek = Pasien::where('nik', $nik)
            ->orWhere('no_regis', $nik)
            ->first();
        if ($cek != null) {
            $cek->update([
                'user_id' => $data['user_id'],
            ]);
            $response = [
                'message' => 'data ditemukan',
                'data' => $cek,
                'status' => true,
            ];
        } else {
            $response = [
                'message' => 'nik yang anda masukkan tidak terdaftar',
                'status' => false,
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'nik'          => 'required|numeric',
        ];

        $messages = [
            'nik.required'          => 'nik wajib di isi',
            'nik.numeric'          => 'nik hanya berupa angka',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = [
                'message' => $$validator->errors(),
                'status' => false,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
        $model = $request->all();
        $data = Pasien::max('id') + 1;
        if ($model['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $model['no_regis'] = 1 . $tahun . $kode;
        $data = Pasien::create($model);
        $response = [
            'message' => 'registrasi berhasil',
            'data' => $data,
            'status' => true,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
