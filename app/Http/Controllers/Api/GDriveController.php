<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GDriveController extends Controller
{
    public static function token()
    {
        $client_id = config('app.gdrive.client_id');
        $client_secret = config('app.gdrive.client_secret');
        $refresh_token = config('app.gdrive.refresh_token');
        $folder_id = config('app.gdrive.folder_id');

        if (!$client_id || !$client_secret || !$refresh_token || !$folder_id) {
            return response()->json([
                'message' => 'Google Drive configuration is not set'
            ], 500);
        }

        $response = Http::post('https://oauth2.googleapis.com/token', [

            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',

        ]);

        //dd($response);
        $accessToken = json_decode((string) $response->getBody(), true)['access_token'];

        return $accessToken;
    }


    public static function upload(UploadedFile $file)
    {
        $accessToken = self::token();

        $parent_folder_id = config('app.gdrive.folder_id');
        
        $file_name = $file->getClientOriginalName();
        $path = $file->getRealPath();

        // Metadata for the file, parent folder ID is required in array format
        $metadata = [
            'name' => $file_name,
            'parents' => [$parent_folder_id], 
        ];

        $response = Http::withToken($accessToken)
            ->attach(
                'metadata',
                json_encode($metadata),
                'metadata.json'
            )
            ->attach(
                'file',
                file_get_contents($path),
                $file_name 
            )
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart&ignoreDefaultVisibility=true');

        // dd($response->body());

        if (!$response->successful()) {
            return response('Failed to upload file');
        }

        $fileId = json_decode($response->body())->id;

        // dd($fileId);

        // Make the file public
        $permissionResponse = Http::withToken($accessToken)
            ->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                'role' => 'reader',
                'type' => 'anyone',
            ]);

        if (!$permissionResponse->successful()) {
            return response('Failed to set file permissions');
        }

        // dd('https://drive.google.com/uc?id=' . $fileId);

        return 'https://drive.google.com/uc?id=' . $fileId;
    }
}
