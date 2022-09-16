<?php

namespace Modules\Ads\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ads\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return TagFactory::new();
    }
}
