<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, mixed $current_id)
 */
class Skate extends Model
{
    use HasFactory;
    protected $fillable = ['external_id','name','description','img','price','category_id','user_id','slug'];
}

