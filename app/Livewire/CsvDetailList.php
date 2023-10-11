<?php

namespace App\Livewire;

use App\Models\CsvDetail;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class CsvDetailList extends Component
{
    use WithPagination;
    public $document;

    public function mount(Document $document)
    {

        $this->document = $document;
    }
    public function render()
    {
        return view('livewire.csv-detail-list', [
            'csvDetails' => CsvDetail::where('document_id', $this->document->id)->paginate(),
            'document' => $this->document
        ]);
    }
}
