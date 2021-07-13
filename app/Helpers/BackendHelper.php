<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Storage;

class BackendHelper
{

    public static function uploadFileToStorage($uploaded_file, $path, $type = null)
    {
        if(isset($uploaded_file) && $uploaded_file !== null){
            $disk = Storage::disk('local');

            $file_original_name = pathinfo($uploaded_file->getClientOriginalName(), PATHINFO_FILENAME) ?? '';
            $file_extension = $uploaded_file->getClientOriginalExtension();

            if(!($file_extension == 'jpg' || $file_extension == 'png' || $file_extension == 'jpeg' || $file_extension == 'pdf' || $file_extension == 'PNG')){
                header("HTTP/1.0 400 Bad Request");
                die("Invalid file");
                return false;
            }

            $result = $disk->putFileAs($path, $uploaded_file, $file_original_name.crc32(time()). ($uploaded_file->getClientOriginalExtension() !== null ? '.'.$uploaded_file->getClientOriginalExtension() : ''));

            $url = $disk->url($result);

            return $url;
        }
        return null;
    }

}
