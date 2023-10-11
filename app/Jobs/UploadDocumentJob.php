<?php

namespace App\Jobs;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uploadFile;

    public $index;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadFile, $index)
    {
        $this->uploadFile = $uploadFile;
        $this->index = $index;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = 'document/'.$this->index.''.date('/Y/m/');
        Storage::put($path, $this->uploadFile, 'public');

        $document = Document::updateOrCreate([
            'original_filename' => $this->uploadFile->getClientOriginalName(),
        ], [
            'mime_type' => $this->uploadFile->getClientMimeType(),
            'is_s3' => config('filesystems.default') == 'spaces',
            'path' => $path.$this->uploadFile->hashName(),
            'hashname' => $this->uploadFile->hashName(),
            'type' => 'csv-file',
        ]);
    }
}
