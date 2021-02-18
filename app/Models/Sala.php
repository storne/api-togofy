<?php

namespace App\Models;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    public function Reservas()
    {
        return $this-hasMany(Reserva::class,'reserva_id','id');
    }
}
