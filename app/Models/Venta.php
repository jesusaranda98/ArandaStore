<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_id', 'videojuego_id', 'cantidad', 'total', 'fecha_venta', 'estado'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }
}