<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function __construct()
    {
        $this->title = 'poli';
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
        $data = Poli::when($request->input('cari'), function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->input('cari')}%");
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
        $data = Poli::create($model);
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = Poli::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Poli::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Poli::find($id)->delete();
        return response()->json($data);
    }
}
