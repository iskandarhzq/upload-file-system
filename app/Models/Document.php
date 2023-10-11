<?php

namespace App\Models;

use App\Enums\UploadDocumentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $uuid
 * @property int $parent_id
 * @property string $original_filename
 * @property string $path
 * @property string $hashname
 * @property bool $is_s3
 * @property string $mime_type
 * @property string $type
 * @property string $title
 * @property string $description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property CsvDetail[] $csvDetails
 */
class Document extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['uuid', 'parent_id', 'original_filename', 'path', 'hashname', 'is_s3', 'mime_type', 'type', 'title', 'description', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'status' => UploadDocumentStatus::class,
    ];

    public function csvDetails(): HasMany
    {
        return $this->hasMany(CsvDetail::class);
    }
}
