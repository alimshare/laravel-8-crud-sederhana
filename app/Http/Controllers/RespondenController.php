<?php

namespace App\Http\Controllers;

use App\Models\Responden;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        if (!empty($request->id)){
            $data['responden'] = Responden::find($request->id);
        }

        $data['data'] = Responden::get();
        return view('form', $data);
    }

    public function save(Request $request)
    {
        $r              = new Responden;

        if (!empty($request->id)) {
            $r = Responden::find($request->id);
        }


        $r->name        = $request->name;
        $r->email       = $request->email;
        $r->gender      = $request->gender;
        $r->religion    = $request->religion;
        $r->birthday    = $request->birthday;
        $r->biografi    = $request->biografi;

        if ($r->save()) {
            return redirect('/form')->with('success', 'success');
        } else {
            return redirect('/form')->with('error', 'fail');
        }
    }

    public function remove(Request $request, $id)
    {
        $x = Responden::find($id);
        if (!empty($x) && $x->delete()) {
            return redirect('/form')->with('success', 'delete success');
        } else {
            return redirect('/form')->with('error', 'delete fail');
        }
    }
}
