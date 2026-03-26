<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Lista de 12 pokemons de prueba (dummy data).
     * Incluye nombre, tipo, número y color de tipo para la UI.
     */
    private array $pokemonList = [
        ['name' => 'bulbasaur',  'number' => '001', 'type' => 'grass',   'type2' => 'poison',   'hp' => 45,  'attack' => 49,  'defense' => 49],
        ['name' => 'charmander', 'number' => '004', 'type' => 'fire',    'type2' => null,        'hp' => 39,  'attack' => 52,  'defense' => 43],
        ['name' => 'squirtle',   'number' => '007', 'type' => 'water',   'type2' => null,        'hp' => 44,  'attack' => 48,  'defense' => 65],
        ['name' => 'pikachu',    'number' => '025', 'type' => 'electric','type2' => null,        'hp' => 35,  'attack' => 55,  'defense' => 40],
        ['name' => 'jigglypuff', 'number' => '039', 'type' => 'normal',  'type2' => 'fairy',     'hp' => 115, 'attack' => 45,  'defense' => 20],
        ['name' => 'meowth',     'number' => '052', 'type' => 'normal',  'type2' => null,        'hp' => 40,  'attack' => 45,  'defense' => 35],
        ['name' => 'psyduck',    'number' => '054', 'type' => 'water',   'type2' => null,        'hp' => 50,  'attack' => 52,  'defense' => 48],
        ['name' => 'geodude',    'number' => '074', 'type' => 'rock',    'type2' => 'ground',    'hp' => 40,  'attack' => 80,  'defense' => 100],
        ['name' => 'gengar',     'number' => '094', 'type' => 'ghost',   'type2' => 'poison',    'hp' => 60,  'attack' => 65,  'defense' => 60],
        ['name' => 'eevee',      'number' => '133', 'type' => 'normal',  'type2' => null,        'hp' => 55,  'attack' => 55,  'defense' => 50],
        ['name' => 'snorlax',    'number' => '143', 'type' => 'normal',  'type2' => null,        'hp' => 160, 'attack' => 110, 'defense' => 65],
        ['name' => 'mewtwo',     'number' => '150', 'type' => 'psychic', 'type2' => null,        'hp' => 106, 'attack' => 110, 'defense' => 90],
    ];

    /**
     * Vista Home
     */
    public function home()
    {
        return view('home');
    }

    /**
     * GET /pokemon
     */
    public function index()
    {
        $pokemon = $this->pokemonList;
        return view('pokemon.index', compact('pokemon'));
    }

    /**
     * GET /pokemon/{name}
     */
    public function show(string $name)
    {
        // buscar pokemon por nombre
        $pokemon = collect($this->pokemonList)
            ->firstWhere('name', strtolower($name));

        // si no se encuentra, muestra un pokemon generico
        if (!$pokemon) {
            $pokemon = [
                'name'     => strtolower($name),
                'number'   => '???',
                'type'     => 'normal',
                'type2'    => null,
                'hp'       => 50,
                'attack'   => 50,
                'defense'  => 50,
            ];
        }

        return view('pokemon.show', compact('pokemon'));
    }
}