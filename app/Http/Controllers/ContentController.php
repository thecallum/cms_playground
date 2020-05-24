<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CMS\Content;
use CMS\Model;

class ContentController extends Controller
{
    public function index($modelId)
    {
        $model = Model::Find($modelId);
        $files = Content::Fetch($modelId);

        return view("content.index", [
            "files" => $files,
            "title" => $model["title"],
            "model" => $modelId
        ]);
    }

    public function create($modelId)
    {
        $model = Model::Find($modelId);

        return view("content.create", [
            "model" => $modelId,
            "schema" => $model
        ]);
    }

    public function store(Request $request, $modelId)
    {
        $validationObject = Model::GetValidationObject($modelId);
        $validatedData = $request->validate($validationObject);

        Content::Save($validatedData, $modelId);

        return Redirect('/content/' . $modelId);
    }

    public function edit($modelId, $id)
    {
        $model =  Content::Single($id, $modelId);
        $schema = Model::Find($modelId);

        return view("content.edit", [
            "page" => $model,
            "model" => $modelId,
            "schema" => $schema
        ]);
    }

    public function update(Request $request, $modelId, $id)
    {
        $validationObject = Model::GetValidationObject($modelId);
        $validatedData = $request->validate($validationObject);

        Content::Update($validatedData, $id, $modelId);

        return redirect("/content/" . $modelId . "/" . $id . "/edit/");
    }

    public function destroy($modelId, $id)
    {
        Content::Delete($id, $modelId);

        return redirect("/content/" . $modelId);
    }
}
