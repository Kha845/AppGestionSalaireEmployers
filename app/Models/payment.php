<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function employer()

    {
        return $this->belongsTo(employe::class,'employer_id');
    }

}
