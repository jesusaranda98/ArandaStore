<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Videojuego;

class VideojuegosSeeder extends Seeder
{
    public function run(): void
    {
        $terror = Categoria::create(['nombre' => 'Terror', 'icono' => 'bi-emoji-dizzy']);
        $ficcion = Categoria::create(['nombre' => 'Ciencia Ficción', 'icono' => 'bi-rocket-takeoff']);
        $accion = Categoria::create(['nombre' => 'Acción & Aventura', 'icono' => 'bi-lightning-charge']);
        $battle = Categoria::create(['nombre' => 'Battle Royale', 'icono' => 'bi-crosshair']);

        Videojuego::create([
            'categoria_id' => $battle->id,
            'nombre' => 'Fortnite Battle Royale',
            'sinopsis' => 'Salta desde el autobús de batalla y sé el último superviviente construyendo y combatiendo en una isla dinámica con constantes actualizaciones.',
            'precio' => 499.00,
            'stock' => 15,
            'imagen_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80'
        ]);

        Videojuego::create([
            'categoria_id' => $terror->id,
            'nombre' => 'Resident Evil Village',
            'sinopsis' => 'Experimenta el terror de supervivencia definitivo en una misteriosa aldea repleta de criaturas macabras y castillos góticos.',
            'precio' => 899.00,
            'stock' => 10,
            'imagen_url' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=800&q=80'
        ]);

        Videojuego::create([
            'categoria_id' => $ficcion->id,
            'nombre' => 'Cyberpunk 2077',
            'sinopsis' => 'Una aventura de acción en Night City, una megalópolis obsesionada con el poder, el glamur y la modificación corporal ilimitada.',
            'precio' => 1099.00,
            'stock' => 8,
            'imagen_url' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&w=800&q=80'
        ]);

        Videojuego::create([
            'categoria_id' => $accion->id,
            'nombre' => 'God of War Ragnarök',
            'sinopsis' => 'Emprende un viaje mítico con Kratos y Atreus a través de los Nueve Reinos en busca de respuestas ante el inminente Ragnarök.',
            'precio' => 1299.00,
            'stock' => 12,
            'imagen_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80'
        ]);
    }
}