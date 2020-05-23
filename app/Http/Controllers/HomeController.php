<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CMS\Model;

class HomeController extends Controller
{
    public function index()
    {

        $models = Model::FindAll();

        return view("home.index", [
            "models" => $models
        ]);
    }
}
