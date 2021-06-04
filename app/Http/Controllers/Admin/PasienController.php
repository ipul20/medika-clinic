<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->title = 'pasien';
        //        $this->middleware("roles:{$this->title}");
    }

    public function index()
    {
        $title = $this->title;
        return view('admin.' . $title . '.index', compact('title'));
    }

    public function show(Request $request)
    {
        $jml = $request->jml == '' ? '5' : $request->jml;
        $title = $this->title;
        $data = Pasien::when($request->input('cari'), function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->input('cari')}%")
                ->orWhere('nik', "like", "%{$request->input('cari')}%")
                ->orWhere('alamat', "like", "%{$request->input('cari')}%")
                ->orWhere('tanggal_lahir', "like", "%{$request->input('cari')}%");
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

    public function store(Request $request)
    {
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
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = Pasien::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Pasien::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Pasien::find($id)->delete();
        return response()->json($data);
    }
}
