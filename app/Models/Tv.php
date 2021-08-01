<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'description',
        'contained_in',
        'price',
        'type',
        'user_id'

    ];

    public function container() {
        return $this->belongsTo('App\Models\Tv', 'contained_in', 'id');
    }
}
