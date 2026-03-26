@extends('layouts.app')

@section('title', ucfirst($pokemon['name']))

@section('styles')
<style>
    .detail-wrapper {
        max-width: 800px;
        margin: 0 auto;
    }

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--poke-muted);
        margin-bottom: 2rem;
    }

    .breadcrumb-custom a {
        color: var(--poke-muted);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-custom a:hover { color: var(--poke-text); }
    .breadcrumb-custom i { font-size: 0.7rem; }

    .detail-card {
        background: var(--poke-mid);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        overflow: hidden;
    }

    .detail-hero {
        background: var(--poke-card);
        padding: 3rem 2rem 2rem;
        position: relative;
        text-align: center;
        overflow: hidden;
    }

    .detail-pokeball-bg {
        position: absolute;
        right: -60px;
        bottom: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        border: 35px solid rgba(255,255,255,0.04);
        pointer-events: none;
    }

    .detail-pokeball-bg::after {
        content: '';
        position: absolute;
        inset: -20px;
        border-radius: 50%;
        border: 18px solid rgba(255,255,255,0.02);
    }

    .detail-number {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-family: 'Press Start 2P', monospace;
        font-size: 1.1rem;
        color: rgba(255,255,255,0.15);
    }

    .detail-sprite {
        width: 180px;
        height: 180px;
        image-rendering: pixelated;
        filter: drop-shadow(0 8px 20px rgba(0,0,0,0.5));
        position: relative;
        z-index: 1;
        transition: transform 0.4s ease;
    }

    .detail-sprite:hover {
        transform: scale(1.05) translateY(-6px);
    }

    .sprite-placeholder-large {
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        border: 3px dashed rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .detail-body {
        padding: 2rem;
    }

    .detail-name {
        font-family: 'Press Start 2P', monospace;
        font-size: clamp(1.2rem, 4vw, 2rem);
        color: #fff;
        text-transform: capitalize;
        text-shadow: 2px 2px 0 rgba(0,0,0,0.3);
        margin-bottom: 0.8rem;
    }

    .detail-types {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .type-badge-large {
        padding: 5px 16px;
        font-size: 0.8rem;
        border-radius: 20px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stats-title {
        font-size: 0.7rem;
        font-family: 'Press Start 2P', monospace;
        color: var(--poke-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }

    .stat-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .stat-label {
        width: 80px;
        flex-shrink: 0;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--poke-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        width: 36px;
        flex-shrink: 0;
        font-size: 0.9rem;
        font-weight: 700;
        color: #fff;
        text-align: right;
    }

    .stat-bar-track {
        flex: 1;
        height: 8px;
        background: rgba(255,255,255,0.08);
        border-radius: 4px;
        overflow: hidden;
    }

    .stat-bar-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.8s ease;
    }

    .fill-hp      { background: linear-gradient(90deg, #ff5959, #ff9a9a); }
    .fill-attack  { background: linear-gradient(90deg, #f5ac78, #f8d030); }
    .fill-defense { background: linear-gradient(90deg, #fae078, #c8e050); }

    .detail-divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.07);
        margin: 1.5rem 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.75rem;
        font-size: 0.9rem;
        font-weight: 700;
        border-radius: 50px;
    }
</style>
@endsection

@section('content')
<div class="detail-wrapper">

    <div class="breadcrumb-custom">
        <a href="{{ route('home') }}">Inicio</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('pokemon.index') }}">Pokémon</a>
        <i class="bi bi-chevron-right"></i>
        <span style="color: var(--poke-text); text-transform: capitalize;">{{ $pokemon['name'] }}</span>
    </div>

    <div class="detail-card">

        <div class="detail-hero">
            <div class="detail-pokeball-bg"></div>
            <div class="detail-number">#{{ $pokemon['number'] }}</div>

            <img
                src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{{ (int)$pokemon['number'] }}.png"
                alt="{{ $pokemon['name'] }}"
                class="detail-sprite"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            >
            <div class="sprite-placeholder-large" style="display:none;">
                <i class="bi bi-question-circle" style="color:var(--poke-muted)"></i>
            </div>
        </div>

        <div class="detail-body">

            <h1 class="detail-name">{{ $pokemon['name'] }}</h1>

            <div class="detail-types">
                <span class="type-badge type-badge-large type-{{ $pokemon['type'] }}">
                    {{ $pokemon['type'] }}
                </span>
                @if($pokemon['type2'])
                    <span class="type-badge type-badge-large type-{{ $pokemon['type2'] }}">
                        {{ $pokemon['type2'] }}
                    </span>
                @endif
            </div>

            <hr class="detail-divider">

            <p class="stats-title">&#9632; Estadísticas base</p>

            <div class="stat-row">
                <span class="stat-label">HP</span>
                <span class="stat-value">{{ $pokemon['hp'] }}</span>
                <div class="stat-bar-track">
                    <div class="stat-bar-fill fill-hp"
                         style="width: {{ min(($pokemon['hp'] / 160) * 100, 100) }}%">
                    </div>
                </div>
            </div>

            <div class="stat-row">
                <span class="stat-label">Ataque</span>
                <span class="stat-value">{{ $pokemon['attack'] }}</span>
                <div class="stat-bar-track">
                    <div class="stat-bar-fill fill-attack"
                         style="width: {{ min(($pokemon['attack'] / 130) * 100, 100) }}%">
                    </div>
                </div>
            </div>

            <div class="stat-row">
                <span class="stat-label">Defensa</span>
                <span class="stat-value">{{ $pokemon['defense'] }}</span>
                <div class="stat-bar-track">
                    <div class="stat-bar-fill fill-defense"
                         style="width: {{ min(($pokemon['defense'] / 130) * 100, 100) }}%">
                    </div>
                </div>
            </div>

            <hr class="detail-divider">

            <a href="{{ route('pokemon.index') }}" class="btn btn-poke-secondary btn-back">
                <i class="bi bi-arrow-left"></i>
                Volver al listado
            </a>

        </div>
    </div>

</div>
@endsection