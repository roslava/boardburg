<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = ['category_name_en', 'category_name_ru', 'category_item_en', 'category_item_ru', 'category_description', 'category_id',];
}
