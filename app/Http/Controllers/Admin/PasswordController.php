<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class PasswordController extends Controller
{
    public function ganti(Request $request)
    {
        $id = Auth::user()->id;
        // $data = $request->all();
        $user = User::where('id', $id)->first();
        $password = $user['password'];
        $lama = $request['passwordlama'];

        if (Hash::check($lama, $password)) {
            if (strcmp($request['passwordbaru'], $request['konfirmasi']) == 0) {
                $akun = User::where('id', $id)->update([
                    'password' => bcrypt($request['passwordbaru']),
                ]);
                $response = [
                    'message' => 'ganti password berhasil',
                    'status' => true,
                ];
                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'password konfirmasi salah',
                    'status' => false
                ];
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response = [
                'message' => 'password lama salah',
                'status' => false,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }
}
