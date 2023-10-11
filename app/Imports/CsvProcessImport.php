<?php

namespace App\Imports;

use App\Models\CsvDetail;
use App\Models\Document;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Events\ImportFailed;

class CsvProcessImport implements ShouldQueue, ToModel, WithChunkReading, WithHeadingRow, WithUpserts
{
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
            'status' => 1,
        ]);

        CsvDetail::updateOrCreate([
            'document_id' => $this->document->id,
            'unique_key' => trim($row['unique_key']),
        ], [
            'product_title' => mb_convert_encoding(trim($row['product_title']), 'UTF-8', 'UTF-8'),
            'product_description' => mb_convert_encoding(trim($row['product_description']), 'UTF-8', 'UTF-8'),
            'style' => mb_convert_encoding(trim($row['style']), 'UTF-8', 'UTF-8'),
            'sanmar_mainframe_color' => mb_convert_encoding(trim($row['sanmar_mainframe_color']), 'UTF-8', 'UTF-8'),
            'size' => mb_convert_encoding(trim($row['size']), 'UTF-8', 'UTF-8'),
            'color_name' => mb_convert_encoding(trim($row['color_name']), 'UTF-8', 'UTF-8'),
            'piece_price' => mb_convert_encoding(trim($row['piece_price']), 'UTF-8', 'UTF-8'),
        ]);
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $this->document->update([
                    'status' => 2,
                ]);
            },
        ];
    }

    public function chunkSize(): int
    {
        return 300;
    }
}
