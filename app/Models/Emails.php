<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    use HasFactory;

    protected $table = "emails";

    protected $fillable = [
       'id','subject','addressee','bodytext','created_by','state_id'
    ];

}
