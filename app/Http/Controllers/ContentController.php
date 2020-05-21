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
            // $path = $directory_path . '/' . $file;
            $contents = Model::Read($file);
            array_push($file_contents, $contents);
        }

        return $file_contents;
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
        $json = json_decode($contents, true); 
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

    public function save(Request $request)
    {
        $model = [
            "name" => $request->input("name"),
            "published" => $request->input("published"),
            "content" => $request->input("content")
        ];

        Model::Save($model);

        return Redirect('/content/');

        //dd($request->input("name"));
    }
}
