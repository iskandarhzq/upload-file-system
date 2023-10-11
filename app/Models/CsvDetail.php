<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $document_id
 * @property string $unique_key
 * @property string $product_title
 * @property string $product_description
 * @property string $style
 * @property string $sanmar_mainframe_color
 * @property string $size
 * @property string $color_name
 * @property string $piece_price
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Document $document
 */
class CsvDetail extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['document_id', 'unique_key', 'product_title', 'product_description', 'style', 'sanmar_mainframe_color', 'size', 'color_name', 'piece_price', 'created_at', 'updated_at', 'deleted_at'];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
