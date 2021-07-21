# Laravel Track Author

This package allow you to track the user who created, deleted and deleted eloquent modelss.

## Install and configure

You can install the package via composer:

```bash

composer require kerattila/laravel-track-author

```

Publish the config file by running:

```bash

php artisan vendor:publish --provider="Kerattila\TrackAuthor\TrackAuthorServiceProvider"

```

After publishing configuration file, adjust the values accordingly your needs:

```php
<?php

return [
    'models' => [
        'user' => \App\User::class
    ],
    'columns' => [
        'createdByColumnName' => 'created_by',
        'updatedByColumnName' => 'updated_by',
        'deletedByColumnName' => 'deleted_by',
    ]
];

```

## Model and migration configuration

### Migrations:

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('posts', function (Blueprint $table) {
    // this will automatically add created_by, updated_by and updated_by nullable columns
    $table->trackAuthor();
});
            
``` 

### Models
You can add the `Kerattila\TrackAuthor\Traits\TrackAuthor` trait to your models or just add one of the CreatedBy, UpdatedBy, DeletedBy traits. 

Example:

```php
<?php

namespace App;

// use Kerattila\TrackAuthor\Traits\CreatedBy;
// use Kerattila\TrackAuthor\Traits\UpdatedBy;
// use Kerattila\TrackAuthor\Traits\DeletedBy;
use Kerattila\TrackAuthor\Traits\TrackAuthor;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use TrackAuthor;
    // use CreatedBy, UpdatedBy, DeletedBy;
}

```

### Relations

Relations are the type of `BelongsTo` and can be accessed as follows:

```php
$post = \App\Post::find(1);
$createdBy = $post->createdBy;
$updatedBy = $post->updatedBy;
$deletedBy = $post->deletedBy;
```
