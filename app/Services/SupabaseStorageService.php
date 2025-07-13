<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseStorageService
{
    protected $url;
    protected $key;
    protected $bucket;

    public function __construct()
    {
        $this->url = env('SUPABASE_URL');
        $this->key = env('SUPABASE_KEY');
        $this->bucket = env('SUPABASE_BUCKET', 'images');

        if (!$this->url || !$this->key || !$this->bucket) {
            throw new \Exception('Supabase environment variables are not properly set.');
        }
    }

    public function upload($file, $path)
    {
        $endpoint = "{$this->url}/storage/v1/object/{$this->bucket}/{$path}";

        $fileContent = @file_get_contents($file);
        if ($fileContent === false) {
            throw new \Exception('Failed to read file content for upload.');
        }

        $response = Http::withHeaders([
            'apikey' => $this->key,
            'Authorization' => "Bearer {$this->key}",
            'Content-Type' => $file->getMimeType(),
            'Cache-Control' => 'max-age=3600'
        ])->withBody(
            $fileContent,
            $file->getMimeType()
        )->put($endpoint);

        if ($response->successful()) {
            return "{$this->url}/storage/v1/object/public/{$this->bucket}/{$path}";
        } else {
            throw new \Exception('Upload failed: ' . $response->body());
        }
    }

    public function delete($publicUrl)
    {
        $path = parse_url($publicUrl, PHP_URL_PATH);
        $path = ltrim(str_replace("/storage/v1/object/public/{$this->bucket}/", '', $path), '/');

        $endpoint = "{$this->url}/storage/v1/object/{$this->bucket}/{$path}";

        $response = Http::withHeaders([
            'apikey' => $this->key,
            'Authorization' => "Bearer {$this->key}",
        ])->delete($endpoint);

        if (!$response->successful()) {
            throw new \Exception('Delete failed: ' . $response->body());
        }

        return true;
    }
}
