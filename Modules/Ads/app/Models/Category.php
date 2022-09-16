<?php

namespace Modules\Ads\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ads\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
