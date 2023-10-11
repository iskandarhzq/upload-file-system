<?php

namespace App\Enums;

enum UploadDocumentStatus: int
{
    case PENDING = 0;
    case PROCESSING = 1;
    case FAILED = 2;
    case COMPLETED = 3;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::FAILED => 'Failed',
            self::COMPLETED => 'Completed',
        };
    }

    /**
     * badge
     */
    public function badge(): string
    {
        return match ($this) {
            self::PENDING => '<span class="font-medium text-yellow-600 dark:text-yellow-500">'.self::PENDING->label().'</span>',
            self::PROCESSING => '<span class="font-medium text-blue-600 dark:text-blue-500">'.self::PROCESSING->label().'</span>',
            self::FAILED => '<span class="font-medium text-red-600 dark:text-red-500">'.self::FAILED->label().'</span>',
            self::COMPLETED => '<span class="font-medium text-green-600 dark:text-green-500">'.self::COMPLETED->label().'</span>',
        };
    }
}
