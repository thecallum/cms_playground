<?php

namespace CMS;

class Model {
    public static function FindAll()
    {
        $files = Model::ListFilePaths();

        $file_contents = [];

        foreach($files as $file)
        {
            $contents = Model::Read($file);
            array_push($file_contents, $contents);
        }

        return $file_contents;
    }

    public static function Find($model)
    {
        $path = base_path() . "/cms/models/" . $model . ".json";
        $contents = Model::Read($path);
        
        return $contents;
    }

    public static function GetValidationObject($modelId)
    {
        $schema = Model::Find($modelId);
        $validationObject = [];

        foreach($schema["fields"] as $field => $properties)
        {
            $validationObject[$field] = $properties["validation"];
        }

        return $validationObject;
    }

    private static function ListFilePaths()
    {
        $directory_path = base_path() . "/cms/models/*.json";
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