<?php

namespace App\Http\Controllers\Admin;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InformasiController extends Controller
{
    public function __construct()
    {
        $this->title = 'informasi';
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
        $data = Informasi::when($request->input('cari'), function ($query) use ($request) {
            $query->where('keterangan', 'like', "%{$request->input('cari')}%");
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
        $rules = [
            'gambar'          => 'required|image|mimes:jpg,jpeg,png,svg,jpg|max:10240',

        ];

        $messages = [
            'gambar.required'          => 'Foto Wajib Di Isi.',
            'gambar.image'          => 'Foto Harus Berupa Gambar.',
            'gambar.max'          => 'Ukuran Foto Maksimal 10MB.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return false;
        }
        $slug = \Str::slug(request('judul'));
        $foto = request()->file('gambar');
        $url = $foto->storeAs("gambar/informasi", "{$slug}.{$foto->extension()}");
        $post = $request->all();
        $post['foto'] = $url ?? 'kosong';
        $post['riwayat'] = request('riwayat') ?? '-';
        $data = Informasi::create($post);
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = Informasi::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Informasi::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Informasi::find($id)->delete();
        return response()->json($data);
    }
}
