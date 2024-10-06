<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales';
    protected $fillable = [
        'zona',
        'numero',
        'sucursal',
        'direccion',
    ];
    /*
    public function Tareas():HasMany
    {
        return $this->hasMany(Tarea::class);
    }
    */
    public function materialesGastados()
    {
        return $this->hasMany(MaterialGastado::class, 'tarea_id', 'id');
    }
    public function Tareas()
    {
        return $this->hasMany(Tarea::class, 'sucursal_id', 'id');
    }
}