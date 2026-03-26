<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [PokemonController::class, 'home'])->name('home');

// Listado de Pokémon
Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');

// Detalle de un Pokémon
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');