<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Throwable;
use Illuminate\Support\Str;

class GDriveController extends Controller
{
    public static function token(): string | object
    {
        try {
            $client_id = config('app.gdrive.client_id');
            $client_secret = config('app.gdrive.client_secret');
            $refresh_token = config('app.gdrive.refresh_token');

            if (!$client_id || !$client_secret || !$refresh_token) {
                throw new Exception('Google Drive credentials are not set');
            }

            $response = Http::post('https://oauth2.googleapis.com/token', [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'refresh_token' => $refresh_token,
                'grant_type' => 'refresh_token',
            ]);

            if (!$response->successful()) {
                throw new Exception('Failed to get access token');
            }

            //dd($response);
            $accessToken = json_decode((string) $response->getBody(), true)['access_token'];

            return $accessToken;
        } catch (Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    public static function getFolderIdByName(string $folder_name): string | object
    {
        try {
            $accessToken = self::token();

            if (!$accessToken) {
                return response()->json([
                    'message' => 'Failed to get access token'
                ], 500);
            }

            $response = Http::withToken($accessToken)
                ->get('https://www.googleapis.com/drive/v3/files', [
                    'q' => "mimeType='application/vnd.google-apps.folder' and name='{$folder_name}'",
                ]);

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Failed to get folder ID'
                ], 500);
            }

            // dd($response->body());
            $folderId = json_decode($response->body())->files[0]->id;

            return $folderId;
        } catch (Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    public static function prefixUrl(): string
    {
        return 'https://drive.google.com/thumbnail?id=';
    }

    public static function toAccessibleUrl(string $fileId): string
    {
        return self::prefixUrl() . $fileId;
    }

    public static function upload(UploadedFile $file, string $folder_name): string | object
    {
        try {
            $accessToken = self::token();

            $parent_folder_id = self::getFolderIdByName($folder_name);

            $file_name = $file->getClientOriginalName();
            $path = $file->getRealPath();

            // Metadata for the file, parent folder ID is required in array format
            $metadata = json_encode([
                'name' => $file_name,
                'parents' => [$parent_folder_id],
            ]);

            $response = Http::withToken($accessToken)
                ->attach(
                    'metadata',
                    $metadata,
                    'metadata.json'
                )
                ->attach(
                    'file',
                    file_get_contents($path),
                    $file_name
                )
                ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart');

            // dd($response->body());

            if (!$response->successful()) {
                throw new Exception('Failed to upload file');
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
                throw new Exception('Failed to make file public');
            }

            return self::toAccessibleUrl($fileId);
        } catch (Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    public static function isFileExists(string $fileId): bool
    {
        try {
            $accessToken = self::token();
            $fileId = Str::after($fileId, self::prefixUrl());

            $response = Http::withToken($accessToken)
                ->get("https://www.googleapis.com/drive/v3/files/{$fileId}");

            if (!$response->successful()) {
                throw new Exception('Failed to check file existence');
            }

            return true;
        } catch (Throwable $th) {
            return false;
        }
    }

    public static function delete(string $fileId): object
    {
        try {
            $accessToken = self::token();

            $fileId = Str::after($fileId, self::prefixUrl());

            $response = Http::withToken($accessToken)
                ->delete("https://www.googleapis.com/drive/v3/files/{$fileId}");

            if (!$response->successful()) {
                throw new Exception('Failed to delete file');
            }

            return response()->json([
                'message' => 'File deleted successfully'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }
}
