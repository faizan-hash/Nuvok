<?php

// app/Models/BusinessPriority.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPriority extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
}
