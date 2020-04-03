<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function gifts()
    {
        $gift  = new Gift();
        $gifts = $gift->paginate(12);
        $data  = ['gifts' => $gifts];
        return view('admin.gift.index', $data);
    }


    public function edit($id)
    {
        $gift = Gift::findOrFail($id);
        $data = ['gift' => $gift];
        return view('admin.gift.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $gift        = Gift::find($id);
        $gift->title = $request->title;
        $gift->save();
        Session::flash('message', 'Изменения сохранены!');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin/gifts');
    }

    public function destroy($id)
    {
        $gift = Gift::findOrFail($id);
        $gift->delete();
        Session::flash('message', 'Идея удалена!');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin/gifts');
    }
}
