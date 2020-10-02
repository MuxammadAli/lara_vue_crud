<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function form()
    {
        return view('form');
    }
    public function save_form(){
        $form = new Form;
        $form->name = request()->name;
        $form->email = request()->email;
        $form->adress = request()->adress;
        $form->phone = request()->phone;
        $form->save();
        return 'Ok';
    }

    public function all_form(){
        $form =  Form::paginate(5);
        return response()->json($form);
    }

    public function edit_form($id){
        $form = Form::find($id);
        return response()->json($form);
    }

    public function update_form(){
        $form = Form::find(request()->id);
        $form->name = request()->name;
        $form->email = request()->email;
        $form->adress = request()->adress;
        $form->phone = request()->phone;
        $form->update();
        return 'ok';
    }

    public function delete_form($id){
        $form = Form::find($id)->delete();
        return 'okey';
    }
}
