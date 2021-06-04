<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->title = 'dokter';
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
        $data = Dokter::when($request->input('cari'), function ($query) use ($request) {
            $query->where('nip', 'like', "%{$request->input('cari')}%")
                ->orWhere("nama", "like", "%{$request->input('cari')}%")
                ->orWhere("poli_id", "like", "%{$request->input('cari')}%");
        })
            ->orderBy('status')
            ->orderBy('poli_id')
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
        $post = $request->all();
        $data = Dokter::max('id') + 1;
        if ($post['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $post['nip'] = $tahun . $kode;
        $user['name'] = $post['nama'];
        $user['username'] = $post['nip'];
        $user['password'] = bcrypt($post['nip']);
        $user['password_default'] = bcrypt($post['nip']);
        $user['role'] = 'dokter';
        $id = User::create($user);
        $post['user_id'] = $id['id'];
        $v = Dokter::create($post);

        return response()->json($v);
    }

    public function edit($id)
    {
        $model = Dokter::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = Dokter::find($model['id']);
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Dokter::find($id)->delete();
        return response()->json($data);
    }

    public function aktif($id)
    {
        $data = Dokter::find($id);
        $data = $data->update([
            'status' => 1,
        ]);
        return response()->json($data);
    }

    public function nonaktif($id)
    {
        $data = Dokter::find($id);
        $data = $data->update([
            'status' => 0,
        ]);
        return response()->json($data);
    }

    public function pengaturan(Request $request)
    {
        $model = $request->all();
        $data = Dokter::find($model['id'])->update($model);
        return response()->json($data);
    }
}
