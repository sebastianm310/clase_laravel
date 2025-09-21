<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotogrametria extends Model
{
    use HasFactory;

    protected $table = 'fotogrametria';
    protected $fillable = ['imagen'];
}
