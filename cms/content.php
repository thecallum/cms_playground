<?php

namespace CMS;

class Content {

    public static function Save($content, $modelId)
    {
        $count = count(Content::ListFilePaths($modelId));
        $position = $count + 1;

        $path = Content::GetPathFromId($position, $modelId);

        file_put_contents($path, json_encode($content, JSON_PRETTY_PRINT));

    }

    private static function GetPathFromId($id, $modelId)
    {
        return base_path() . "/cms/content/" . $modelId . "/" . $id . ".json";
    }

    public static function Fetch($model)
    {
    
        $files = Content::ListFilePaths($model);

        if (count($files) == 0) return [];

        $file_contents = [];

        foreach($files as $file)
        {
            $contents = Content::Read($file);
            array_push($file_contents, $contents);
        }

        return $file_contents;
    }

    public static function Single($id, $modelId)
    {
        $path = Content::GetPathFromId($id, $modelId);
        $contents = Content::Read($path);
        return $contents;
    }

    public static function Update($content, $id, $modelId)
    {
        $path = Content::GetPathFromId($id, $modelId);

        file_put_contents($path, json_encode($content, JSON_PRETTY_PRINT));
    }

    public static function Delete($id, $modelId)
    {
        $path = Content::GetPathFromId($id, $modelId);
        unlink($path);
    }

    private static function ListFilePaths($model)
    {

        $directory_path = base_path() . "/cms/content/" . $model . "/*.json";

        // dd($model);

        $files = glob($directory_path);

        return $files;
    }

    private static function Read($path)
    {
        $contents = file_get_contents($path);

        $file_name = basename($path, ".json");

        $json = json_decode($contents, true); 
        
        $json["file_name"] = $file_name;

        return $json;
    }
}
