<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $table = "profiles";

    protected $fillable = [
       'id','name','created_at','updated_at'
    ];

}
