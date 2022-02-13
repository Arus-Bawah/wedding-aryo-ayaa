<?php namespace App\Http\Controllers;

class TemplateController extends Controller
{
    public function Index()
    {
        $name = session('name');

        return view('template.main');
    }
}
