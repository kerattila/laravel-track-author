<?php

namespace Kerattila\TrackAuthor;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

/**
 * Class TrackAuthorServiceProvider
 * @package Kerattila\TrackAuthor
 */
class TrackAuthorServiceProvider extends ServiceProvider
{
    /**
     * Boot up the serivce providers
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/track-author.php' => config_path('track-author.php'),
        ], 'config');

        $this->registerMacro();
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/track-author.php',
            'track-author'
        );
    }

    /**
     * Register macros
     */
    public function registerMacro()
    {
        Blueprint::macro('trackAuthor', function () {
            /** @var $this Blueprint */
            $this->unsignedBigInteger(
                config('track-author.columns.createdByColumnName', 'created_by')
            )->nullable();
            $this->unsignedBigInteger(
                config('track-author.columns.updatedByColumnName', 'updated_by')
            )->nullable();
            $this->unsignedBigInteger(
                config('track-author.columns.deletedByColumnName', 'deleted_by')
            )->nullable();
        });
    }

}
