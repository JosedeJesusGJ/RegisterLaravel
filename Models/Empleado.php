<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;


    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function scopeConCargo($query)
    {
        return $query->select('empleados.*', 'cargos.nombre as nombre_cargo')
            ->join('cargos', 'empleados.cargo_id', '=', 'cargos.id');
    }
}
