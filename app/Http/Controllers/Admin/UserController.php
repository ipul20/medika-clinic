<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->title = 'user';
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
        $data = User::when($request->input('cari'), function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->input('cari')}%")
                ->orWhere("username", "like", "%{$request->input('cari')}%")
                ->orWhere("role", "like", "%{$request->input('cari')}%");
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
        $model['password'] = Hash::make($model['password']);
        $model['created_by'] = auth()->user()->id;
        $data = User::create($model);
        return response()->json($data);
    }

    public function edit($id)
    {
        $model = User::find($id);
        return response()->json($model);
    }

    public function update(Request $request)
    {
        $model = $request->all();
        $data = User::find($model['id']);
        if ($model['password'] == '') {
            $model['password'] = $data->password;
        } else {
            $model['password'] = Hash::make($model['password']);
        }
        $model['updated_by'] = auth()->user()->id;
        $data = $data->update($model);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = User::find($id)->delete();
        return response()->json($data);
    }
}
