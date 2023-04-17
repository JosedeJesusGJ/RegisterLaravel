<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;

class Cargo extends Model
{
    use HasFactory;

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
