<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CMS\Content;
use CMS\Model;

class ContentController extends Controller
{
    public function index($model)
    {
        $files = Content::Fetch($model);
        if ($files == null) abort(404);

        return view("content.index", [
            "files" => $files,
            "model" => $model  
        ]);
    }

    public function create()
    {
        return view("content.create");
    }

    public function store(Request $request)
    {
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content")        
        ];

        Content::Save($model);

        return Redirect('/content/');
    }

    public function edit($id)
    {
        $model =  Content::Single($id);

        return view("content.edit", [
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

        Content::Update($model, $id);

        return redirect("/content/" . $id . "/edit/");
    }

    public function destroy($id)
    {
        Content::Delete($id);

        return redirect("/content/");
    }
}
