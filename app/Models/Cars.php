<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model {
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'name',
        'description',
        'model',
        'date',
    ];

    protected $casts = [
        'date' => 'timestamp'
    ];

}
