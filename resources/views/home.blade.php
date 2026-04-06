@extends('layouts.app')

@section('title', 'Inicio')

@section('styles')
<style>
    .hero-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(227,53,13,0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 30%, rgba(233,69,96,0.08) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-pokeball-bg {
        position: absolute;
        right: -80px;
        top: 50%;
        transform: translateY(-50%);
        width: 500px;
        height: 500px;
        border-radius: 50%;
        border: 60px solid rgba(255,255,255,0.03);
        pointer-events: none;
    }

    .hero-pokeball-bg::after {
        content: '';
        position: absolute;
        inset: -30px;
        border-radius: 50%;
        border: 30px solid rgba(255,255,255,0.02);
    }

    .hero-eyebrow {
        font-family: 'Press Start 2P', monospace;
        font-size: 0.6rem;
        color: var(--poke-accent);
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }

    .hero-title {
        font-family: 'Press Start 2P', monospace;
        font-size: clamp(1.8rem, 5vw, 3.2rem);
        color: #fff;
        line-height: 1.4;
        text-shadow: 3px 3px 0 var(--poke-red-dark), 6px 6px 0 rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }

    .hero-title span {
        color: var(--poke-yellow);
    }

    .hero-desc {
        font-size: 1.1rem;
        color: var(--poke-muted);
        max-width: 480px;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-hero {
        padding: 0.8rem 2rem;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 50px;
    }

    .stat-pills {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 3rem;
    }

    .stat-pill {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
        font-size: 0.82rem;
        color: var(--poke-text);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .stat-pill i { color: var(--poke-yellow); }

    .deco-sprites {
        display: flex;
        gap: 0.8rem;
        margin-top: 2rem;
        opacity: 0.6;
    }

    .deco-sprite {
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
</style>
@endsection

@section('content')
<section class="hero-section">

    {{-- Decoracion fondo --}}
    <div class="hero-pokeball-bg"></div>

    <div class="row align-items-center w-100">
        <div class="col-lg-7">
            <h1 class="hero-title">
                Descubre el mundo<br>
                <span>Pokémon</span>
            </h1>

            <p class="hero-desc">
                Explora la enciclopedia completa de criaturas Pokemon.
                Consulta estadisticas, tipos y detalles de cada especie
                en nuestra Pokédex construida con Laravel.
            </p>

            {{-- Botones CTA --}}
            <div class="hero-cta">
                <a href="{{ route('pokemon.index') }}"
                   class="btn btn-poke-primary btn-hero">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                    Ver todos los pokemones
                </a>
                <a href="{{ route('pokemon.show', 'pikachu') }}"
                   class="btn btn-poke-secondary btn-hero">
                    <i class="bi bi-lightning-fill me-2"></i>
                    Pokemon destacado
                </a>
            </div>

        </div>

        <div class="col-lg-5 d-none d-lg-flex justify-content-end">
            <div style="text-align:center;">
                <svg width="280" height="280" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg" style="opacity:0.15;">
                    <circle cx="140" cy="140" r="130" fill="none" stroke="white" stroke-width="8"/>
                    <path d="M10 140 Q10 10 140 10" fill="none" stroke="#e3350d" stroke-width="8"/>
                    <path d="M270 140 Q270 10 140 10" fill="none" stroke="#e3350d" stroke-width="8"/>
                    <line x1="10" y1="140" x2="270" y2="140" stroke="white" stroke-width="8"/>
                    <circle cx="140" cy="140" r="30" fill="none" stroke="white" stroke-width="8"/>
                    <circle cx="140" cy="140" r="18" fill="rgba(255,255,255,0.3)"/>
                </svg>
            </div>
        </div>
    </div>
</section>
@endsection