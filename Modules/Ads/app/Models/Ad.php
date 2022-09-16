<?php

namespace Modules\Ads\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ads\Database\Factories\AdFactory;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'category_id', 'advertiser_id','start_date'];

    protected static function newFactory()
    {
        return AdFactory::new();
    }
}
