<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CMS\Model;



class ContentController extends Controller
{
    public function index()
    {
        $files = Model::Fetch();

        return view("content", ["files" => $files]);
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content")        
        ];

        Model::Save($model);

        return Redirect('/content/');
    }

    public function edit($id)
    {
        $model =  Model::Single($id);

        return view("edit", [
            "page" => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content"),
            "file_name" => $id
        ];

        Model::Update($model, $id);

        return redirect("/content/" . $id . "/edit/");
    }

    public function destroy($id)
    {
        Model::Delete($id);

        return redirect("/content/");
    }
}
