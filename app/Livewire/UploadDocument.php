<?php

namespace App\Livewire;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;

class UploadDocument extends Component
{
    use WithFileUploads;

    public $listeners = ['storeUploadDocument'];

    public $uploadFiles = [];

    public $iteration = 0;

    public function onUploadDocument()
    {
        $this->emit('swal:confirm', [
            'type' => 'question',
            'title' => 'Confirmation',
            'text' => 'Are you sure to upload the file(s)?',
            'confirmText' => 'Yes',
            'cancelText' => 'Close',
            'method' => 'storeUploadDocument',
        ]);
    }

    public function storeUploadDocument()
    {
        foreach ($this->uploadFiles as $index => $uploadFile) {
            $path = "document/$index".date('/Y/m/');
            Storage::put($path, $uploadFile, 'public');

            $document = Document::updateOrCreate([
                'original_filename' => $uploadFile->getClientOriginalName(),
            ], [
                'uuid' => Uuid::uuid4(),
                'mime_type' => $uploadFile->getClientMimeType(),
                'is_s3' => config('filesystems.default') == 'spaces',
                'path' => $path.$uploadFile->hashName(),
                'hashname' => $uploadFile->hashName(),
                'type' => 'csv-file',
            ]);
        }
    }

    public function removeUpload($index)
    {
        array_splice($this->uploadFiles, $index, 1);
    }

    public function clearUploadDocument()
    {
        $this->reset('uploadFiles');
    }

    public function render()
    {
        $documents = Document::all();

        return view('livewire.upload-document', [
            'documents' => $documents,
        ]);
    }
}