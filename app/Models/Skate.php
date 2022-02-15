<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, mixed $current_id)
 */
class Skate  extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }




    protected $fillable = ['external_id','name','description','img','price','category_id','user_id','slug'];
}
