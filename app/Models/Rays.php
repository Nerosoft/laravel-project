<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Rays extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mongodb';
    protected $collection = 'rays';
    protected $fillable = [
        '_id'
    ];
}
