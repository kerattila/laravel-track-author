<?php

namespace Kerattila\TrackAuthor\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Trait DeletedBy
 * @package Kerattila\TrackAuthor\Traits
 */
trait DeletedBy
{
    /**
     *
     */
    public static function bootDeletedBy()
    {
        self::deleting(function (self $model) {
            $model->setDeletedBy();
        });
    }

    /**
     * @return BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(
            config('track-author.models.user'),
            config('track-author.columns.deletedByColumnName')
        );
    }

    /**
     *
     */
    private function setDeletedBy()
    {
        $events = $this->getEventDispatcher();

        $column = config('track-author.columns.deletedByColumnName');
        tap($this)->unsetEventDispatcher()
            ->forceFill([
                $column => Auth::id()
                ] + $this->getOriginal())
            ->save();

        $this->setEventDispatcher($events);
    }
}
