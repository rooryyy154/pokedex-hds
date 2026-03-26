@extends('layouts.app')

@section('title', 'Todos los Pokémon')

@section('styles')
<style>
    .section-header {
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .section-eyebrow {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.55rem;
        color: var(--poke-accent);
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 0.6rem;
    }

    .section-title {
        font-family: 'Press Start 2P', monospace;
        font-size: 1.4rem;
        color: #fff;
        text-shadow: 2px 2px 0 rgba(0,0,0,0.4);
        margin: 0;
    }

    .section-count {
        color: var(--poke-muted);
        font-size: 0.9rem;
        margin-top: 0.4rem;
    }

    .pokemon-card {
        background: var(--poke-mid);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .pokemon-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.5);
        border-color: rgba(255,255,255,0.2);
    }

    .card-img-area {
        background: var(--poke-card);
        padding: 1.5rem;
        text-align: center;
        position: relative;
        min-height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .card-number-bg {
        position: absolute;
        bottom: -10px;
        right: 5px;
        font-family: 'Press Start 2P', monospace;
        font-size: 2.8rem;
        color: rgba(255,255,255,0.06);
        user-select: none;
        line-height: 1;
    }

    .pokemon-sprite {
        width: 90px;
        height: 90px;
        image-rendering: pixelated;
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.5));
        transition: transform 0.3s ease;
    }

    .pokemon-card:hover .pokemon-sprite {
        transform: scale(1.1) translateY(-4px);
    }

    .sprite-placeholder {
        width: 90px;
        height: 90px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        border: 2px dashed rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        position: relative;
        z-index: 1;
    }

    .card-body-custom {
        padding: 1rem 1.2rem 1.2rem;
    }

    .pokemon-number {
        font-size: 0.72rem;
        color: var(--poke-muted);
        font-weight: 600;
        margin-bottom: 0.2rem;
    }

    .pokemon-name {
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        text-transform: capitalize;
        margin-bottom: 0.6rem;
    }

    .pokemon-types {
        display: flex;
        gap: 0.3rem;
        flex-wrap: wrap;
    }
    .mini-stats {
        margin-top: 0.8rem;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .mini-stat-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        color: var(--poke-muted);
    }

    .mini-stat-label {
        width: 18px;
        flex-shrink: 0;
        font-weight: 700;
        color: var(--poke-muted);
    }

    .mini-stat-bar {
        flex: 1;
        height: 4px;
        background: rgba(255,255,255,0.08);
        border-radius: 2px;
        overflow: hidden;
    }

    .mini-stat-fill {
        height: 100%;
        border-radius: 2px;
        background: var(--poke-accent);
        transition: width 0.5s ease;
    }

    .mini-stat-fill.hp    { background: #ff5959; }
    .mini-stat-fill.atk   { background: #f5ac78; }
    .mini-stat-fill.def   { background: #fae078; }
</style>
@endsection

@section('content')

{{-- Cabecera --}}
<div class="section-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end gap-3">
    <div>
        <p class="section-eyebrow">&#9679; Generación I</p>
        <h1 class="section-title">Pokédex</h1>
        <p class="section-count">
            <i class="bi bi-collection me-1"></i>
            Mostrando {{ count($pokemon) }} Pokémon
        </p>
    </div>
    <a href="{{ route('home') }}" class="btn btn-poke-secondary">
        <i class="bi bi-house me-1"></i> Inicio
    </a>
</div>

{{-- Grid de tarjetas --}}
<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-6 g-3">
    @foreach($pokemon as $poke)
    <div class="col">
        <a href="{{ route('pokemon.show', $poke['name']) }}" class="pokemon-card">

            {{-- Imagen / sprite --}}
            <div class="card-img-area">
                <span class="card-number-bg">#{{ $poke['number'] }}</span>
                <img
                    src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{{ (int)$poke['number'] }}.png"
                    alt="{{ $poke['name'] }}"
                    class="pokemon-sprite"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >
                <div class="sprite-placeholder" style="display:none;">
                    <i class="bi bi-question-circle" style="color:var(--poke-muted)"></i>
                </div>
            </div>

            {{-- Info --}}
            <div class="card-body-custom">
                <div class="pokemon-number">#{{ $poke['number'] }}</div>
                <div class="pokemon-name">{{ $poke['name'] }}</div>

                {{-- Tipos --}}
                <div class="pokemon-types">
                    <span class="type-badge type-{{ $poke['type'] }}">{{ $poke['type'] }}</span>
                    @if($poke['type2'])
                        <span class="type-badge type-{{ $poke['type2'] }}">{{ $poke['type2'] }}</span>
                    @endif
                </div>

                {{-- Mini stats --}}
                <div class="mini-stats">
                    <div class="mini-stat-row">
                        <span class="mini-stat-label">HP</span>
                        <div class="mini-stat-bar">
                            <div class="mini-stat-fill hp" style="width: {{ min(($poke['hp'] / 160) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div class="mini-stat-row">
                        <span class="mini-stat-label">AT</span>
                        <div class="mini-stat-bar">
                            <div class="mini-stat-fill atk" style="width: {{ min(($poke['attack'] / 130) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div class="mini-stat-row">
                        <span class="mini-stat-label">DF</span>
                        <div class="mini-stat-bar">
                            <div class="mini-stat-fill def" style="width: {{ min(($poke['defense'] / 130) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>
    @endforeach
</div>

@endsection