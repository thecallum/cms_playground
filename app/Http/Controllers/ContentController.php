<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CMS\Content;
use CMS\Model;

class ContentController extends Controller
{
    public function index($modelId)
    {
        $modelData = Model::Find($modelId);
        $files = Content::Fetch($modelId);

        return view("content.index", [
            "files" => $files,
            "title" => $modelData["title"],
            "model" => $modelId
        ]);
    }

    public function create($modelId)
    {
        return view("content.create", [
            "model" => $modelId
        ]);
    }

    public function store(Request $request, $modelId)
    {
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content")        
        ];

        Content::Save($model, $modelId);

        return Redirect('/content/' . $modelId);
    }

    public function edit($modelId, $id)
    {
        $model =  Content::Single($id, $modelId);

        return view("content.edit", [
            "page" => $model,
            "model" => $modelId
        ]);
    }

    public function update(Request $request, $modelId, $id)
    {
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content"),
            "file_name" => $id
        ];

        Content::Update($model, $id, $modelId);

        return redirect("/content/" . $modelId . "/" . $id . "/edit/");
    }

    public function destroy($modelId, $id)
    {
        Content::Delete($id, $modelId);

        return redirect("/content/" . $modelId);
    }
}
