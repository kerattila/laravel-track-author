<?php

namespace Kerattila\TrackAuthor\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Trait CreatedBy
 * @package Kerattila\TrackAuthor\Traits
 */
trait CreatedBy
{
    /**
     *
     */
    public static function bootCreatedBy()
    {
        self::creating(function(self $model) {
            $model->setCreatedBy();
        });
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            config('track-author.models.user'),
            config('track-author.columns.createdByColumnName')
        );
    }

    /**
     *
     */
    private function setCreatedBy()
    {
        $column = config('track-author.columns.createdByColumnName');
        $this->$column = Auth::id();
    }
}
