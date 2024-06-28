<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\departement;
use App\Models\payment;

class employe extends Model
{
    use HasFactory;


    public function departement()

    {
        return $this->belongsTo(departement::class);
    }


    public function payments()

    {
        return $this->hasMany(payment::class,'employer_id');
    }

}
