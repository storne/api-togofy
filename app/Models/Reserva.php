<?php

namespace App\Models;
use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    public function Sala()
    {
        return $this->belongsTo(Sala::class,'sala_id','id');
    }
}
