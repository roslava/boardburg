<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    protected $fillable = ['external_id','name','description','img','price','category_id','user_id','slug'];

    use HasFactory, InteractsWithMedia;

    /**
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaCollection('cover');

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    /**
     * @param $data
     * @return string|void
     */
    public static function getSlug($data)
    {
        switch ($data) {
            case 1:
                return 'boards';

            case 2:
                return 'suspensions';

            case 3:
                return 'wheels';

            case 4:
                return 'bearings';
        }
    }

    /**
     * @param $request
     * @param $productQuery
     * @return void
     */
    public static function priceFilter($request, $productQuery)
    {
        if ($request->filled('price_from')) {
            $productQuery->where('price', '>=', $request['price_from']);
        }
        if ($request->filled('price_to')) {
            $productQuery->where('price', '<=', $request['price_to']);
        }
    }
}
