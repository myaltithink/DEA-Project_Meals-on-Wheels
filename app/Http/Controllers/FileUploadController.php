<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{

    function __constructor()
    {
        if (!Storage::exists('/resources/images')) {
            Storage::makeDirectory('/resources/images');
        }
    }

    /**
     * Saves the file given to the parameter
     *
     * Will be used to upload images from website form
     *
     * Root location is storage/app/uploads
     *
     * @param UploadedFile $file - file that was attached to the form
     * @param string $file_name - file name of the $file that will be save as
     * @param string|'' $destination - the location on where the $file will be saved at, root location at storage/app/uploads do not give value if you wish to save on the root
     *
     * @return string|false the saved $file location in the storage folder or false if the upload fails
     */
    public static function upload_file(UploadedFile $file, $file_name, $destination = '')
    {

        $root = 'uploads/';

        $save_destination = $root . $destination;

        if (!Storage::exists($save_destination)) {
            Storage::makeDirectory($save_destination);
        }

        $complete_file_name = $file_name . '.' . $file->getClientOriginalExtension();

        if (!Storage::putFileAs($save_destination, $file, $complete_file_name)) {
            return false;
        }

        Log::info('file save result ' . $complete_file_name);

        return 'storage/app/' . $save_destination . '/' . $complete_file_name;
    }
}
