<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    protected $fillable = ['categoria_id', 'nombre', 'sinopsis', 'precio', 'stock', 'imagen_url'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}