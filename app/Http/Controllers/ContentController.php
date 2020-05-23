<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use Storage;

class Model {

    public static function Save($model)
    {
        $count = count(Model::ListFilePaths("blogpost"));
        $position = $count + 1;

        $path = base_path() . "/cms/content/blogpost";

        $path = $path . '/' . $position . '.json';

        file_put_contents($path, json_encode($model, JSON_PRETTY_PRINT));

    }

    public static function Fetch()
    {
        $files = Model::ListFilePaths("blogpost");
        $file_contents = [];

        foreach($files as $file)
        {
            $contents = Model::Read($file);
            array_push($file_contents, $contents);
        }

        return $file_contents;
    }

    public static function Single($id)
    {
        $path = base_path() . "/cms/content/blogpost/". $id . ".json";
        $contents = Model::Read($path);
        return $contents;
    }

    public static function Update($model, $id)
    {
        $path = base_path() . "/cms/content/blogpost/". $id . ".json";


      

        file_put_contents($path, json_encode($model, JSON_PRETTY_PRINT));

    }

    private static function ListFilePaths($model)
    {
        $directory_path = base_path() . "/cms/content/" . $model . "/*.json";
        $files = glob($directory_path);

        return $files;
    }

    private static function Read($path)
    {
        $contents = file_get_contents($path);

        $file_name = array_slice(explode("/", $path), -1)[0];
        $file_name = explode(".", $file_name)[0];

        //dd($file_name);


        $json = json_decode($contents, true); 
        
        $json["file_name"] = $file_name;

 
        return $json;
    }
}

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
        //
    }
}
