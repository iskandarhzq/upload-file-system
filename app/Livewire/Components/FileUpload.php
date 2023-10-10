<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    /**
     * Props
     */
    public $model;

    public $uploads;

    public $disabled = false;

    /**
     * States
     */
    public $uploadFiles = [];

    public $selectedCollection;

    /**
     * onOpenUploadModal
     *
     * @param  mixed  $collection
     */
    public function onOpenUploadModal($collection)
    {
        $this->selectedCollection = $collection;
        $this->clearUpload();
    }

    /**
     * onUploadDocument
     */
    public function onUploadDocument()
    {
        foreach ($this->uploadFiles as $uploadFile) {
            $this->model
                ->addMedia($uploadFile->getRealPath())
                ->usingName($uploadFile->getClientOriginalName())
                ->toMediaCollection($this->selectedCollection);
        }

        $this->dispatchBrowserEvent('closeUploadModal');

        $this->dispatchBrowserEvent('refreshPage');
    }

    /**
     * removeUpload
     *
     * @param  mixed  $index
     */
    public function removeUpload($index)
    {
        array_splice($this->uploadFiles, $index, 1);
    }

    /**
     * deleteUploadedFile
     *
     * @param  mixed  $document
     */
    public function deleteUploadedFile($collection, $index)
    {
        $this->model->getMedia($collection)[$index]->delete();

        $this->dispatchBrowserEvent('refreshPage');
    }

    /**
     * clearUpload
     */
    public function clearUpload()
    {
        $this->reset('uploadFiles');
    }

    /**
     * render
     */
    public function render()
    {
        return view('livewire.components.file-upload');
    }
}
