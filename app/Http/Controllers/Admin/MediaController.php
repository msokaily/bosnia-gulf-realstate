<?php
namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Imports\LocationsImport;
use Maatwebsite\Excel\Facades\Excel;

class MediaController extends Controller
{
    public $settings;
    
    public function __construct()
    {
        $this->settings = Settings::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }
    

    public function upload_media(Request $request)
    {
        $uploadedFile = $request->file('file');

        // $validatedData = $request->validate([
        //     'file' => 'required|file|mimes:jpeg,png,gif|max:10240',
        // ]);

        dd(123);
        
        $media = new Media();
        $media->type = 'image';
        $media->url = $request->file('file');
        $media->save();

        return response()->json(['message' => 'File uploaded successfully']);
    }

}
