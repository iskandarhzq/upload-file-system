<?php

namespace App\Imports;

use App\Enums\UploadDocumentStatus;
use App\Models\CsvDetail;
use App\Models\Document;
use ForceUTF8\Encoding;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Events\ImportFailed;

class CsvProcessImport implements ShouldQueue, ToModel, WithChunkReading, WithHeadingRow, WithUpserts
{
    use Importable;

    public $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'unique_key';
    }

    public function model(array $row)
    {
        $this->document->update([
            'status' => UploadDocumentStatus::PROCESSING,
        ]);

        CsvDetail::updateOrCreate([
            'document_id' => $this->document->id,
            'unique_key' => trim($row['unique_key']),
        ], [
            'product_title' => Encoding::toUTF8(trim($row['product_title'])),
            'product_description' => Encoding::toUTF8(trim($row['product_description'])),
            'style' => Encoding::toUTF8(trim($row['style'])),
            'sanmar_mainframe_color' => Encoding::toUTF8(trim($row['sanmar_mainframe_color'])),
            'size' => Encoding::toUTF8(trim($row['size'])),
            'color_name' => Encoding::toUTF8(trim($row['color_name'])),
            'piece_price' => Encoding::toUTF8(trim($row['piece_price'])),
        ]);
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $this->document->update([
                    'status' => UploadDocumentStatus::FAILED,
                ]);
            },
        ];
    }

    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
