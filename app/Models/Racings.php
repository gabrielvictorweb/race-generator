<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Racings extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'rules', 'date'];
}
