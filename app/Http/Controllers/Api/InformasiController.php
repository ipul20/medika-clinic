<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::all();
        $response = [
            'message' => 'daftar informasi',
            'data' => $informasi
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function view($id)
    {
        $informasi = Informasi::where('id', $id)->get();
        $response = [
            'message' => 'informasi berdasarkan id',
            'data' => $informasi
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
