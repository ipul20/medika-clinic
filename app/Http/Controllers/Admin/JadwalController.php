<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->title = 'jadwal';
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
        $data = Jadwal::when($request->input('cari'), function ($query) use ($request) {
            $query->where('mulai', 'like', "%{$request->input('cari')}%")
                ->orWhere('selesai', "like", "%{$request->input('cari')}%");
        })
            ->orderBy('dokter_id')
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
        $cek = Jadwal::where('dokter_id', $model['dokter_id'])->count();
        $model['sesi'] = $cek + 1;
        $data = Jadwal::create($model);
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = Jadwal::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Jadwal::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Jadwal::find($id)->delete();
        return response()->json($data);
    }
}
