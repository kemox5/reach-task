<?php

namespace Modules\Ads\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ads\Database\Factories\AdFactory;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'category_id', 'advertiser_id', 'start_date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    protected static function newFactory()
    {
        return AdFactory::new();
    }
}
