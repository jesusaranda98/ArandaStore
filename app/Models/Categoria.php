<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'icono'];

    public function videojuegos()
    {
        return $this->hasMany(Videojuego::class);
    }
}