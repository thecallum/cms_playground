<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use Storage;

class Model {

    public static function Fetch()
    {
        $directory_path = base_path() . "/cms/content/blogpost";
        $files = scandir($directory_path);
        $files = array_diff($files, array('..', '.'));

        $file_contents = [];

        foreach($files as $file)
        {
            $path = $directory_path . '/' . $file;
            $contents = Model::Read($path);
            array_push($file_contents, $contents);
        }

        return $file_contents;
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
}
