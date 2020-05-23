<?php

namespace CMS;

class Content {

    public static function Save($Content)
    {
        $count = count(Content::ListFilePaths("blogpost"));
        $position = $count + 1;

        $path = Content::GetPathFromId($position);

        file_put_contents($path, json_encode($Content, JSON_PRETTY_PRINT));

    }

    private static function GetPathFromId($id)
    {
        return base_path() . "/cms/content/blogpost/". $id . ".json";
    }

    public static function Fetch($model)
    {
        $files = Content::ListFilePaths($model);
        if (count($files) == 0) return null;

        $file_contents = [];

        foreach($files as $file)
        {
            $contents = Content::Read($file);
            array_push($file_contents, $contents);
        }

        return $file_contents;
    }

    public static function Single($id)
    {
        $path = Content::GetPathFromId($id);
        $contents = Content::Read($path);
        return $contents;
    }

    public static function Update($Content, $id)
    {
        $path = Content::GetPathFromId($id);

        file_put_contents($path, json_encode($Content, JSON_PRETTY_PRINT));

    }

    public static function Delete($id)
    {
        $path = Content::GetPathFromId($id);
        unlink($path);
    }

    private static function ListFilePaths($Content)
    {
        $directory_path = base_path() . "/cms/content/" . $Content . "/*.json";
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
