<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absense extends Model
{
    use HasFactory;
    protected $table = 'absense';
    protected $fillable = [
        'section_name',
        'content',
        'status',
    ];

}
