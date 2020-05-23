<?php

namespace CMS;

class Model {

    public static function Save($model)
    {
        $count = count(Model::ListFilePaths("blogpost"));
        $position = $count + 1;

        $path = Model::GetPathFromId($position);

        file_put_contents($path, json_encode($model, JSON_PRETTY_PRINT));

    }

    private static function GetPathFromId($id)
    {
        return base_path() . "/cms/content/blogpost/". $id . ".json";
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
        $path = Model::GetPathFromId($id);
        $contents = Model::Read($path);
        return $contents;
    }

    public static function Update($model, $id)
    {
        $path = Model::GetPathFromId($id);

        file_put_contents($path, json_encode($model, JSON_PRETTY_PRINT));

    }

    public static function Delete($id)
    {
        $path = Model::GetPathFromId($id);
        unlink($path);
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

        $json = json_decode($contents, true); 
        
        $json["file_name"] = $file_name;

        return $json;
    }
}
