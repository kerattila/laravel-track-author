<?php

namespace Kerattila\TrackAuthor\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Trait UpdatedBy
 * @package Kerattila\TrackAuthor\Traits
 */
trait UpdatedBy
{
    /**
     *
     */
    public static function bootUpdatedBy()
    {
        self::creating(function (self $model) {
            $model->setUpdatedBy();
        });

        self::updating(function (self $model) {
            $model->setUpdatedBy();
        });
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(
            config('track-author.models.user'),
            config('track-author.columns.updatedByColumnName')
        );
    }

    /**
     *
     */
    private function setUpdatedBy()
    {
        $column = config('track-author.columns.updatedByColumnName');
        $this->$column = Auth::id();
    }
}
