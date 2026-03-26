<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pokédex') | Pokédex Laravel</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --poke-red:      #e3350d;
            --poke-red-dark: #b02208;
            --poke-dark:     #1a1a2e;
            --poke-mid:      #16213e;
            --poke-card:     #0f3460;
            --poke-accent:   #e94560;
            --poke-yellow:   #ffd700;
            --poke-text:     #e8e8f0;
            --poke-muted:    #8888aa;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--poke-dark);
            color: var(--poke-text);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, var(--poke-red-dark) 0%, var(--poke-red) 100%);
            border-bottom: 3px solid var(--poke-yellow);
            padding: 0.6rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        .navbar-brand {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.85rem;
            color: #fff !important;
            text-shadow: 2px 2px 0 #000;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .pokeball-icon {
            width: 28px; height: 28px;
            border-radius: 50%;
            border: 3px solid #fff;
            background: linear-gradient(180deg, #fff 50%, #e3350d 50%);
            position: relative;
            flex-shrink: 0;
            box-shadow: 0 0 8px rgba(255,255,255,0.4);
        }

        .navbar-brand .pokeball-icon::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 8px; height: 8px;
            background: #fff;
            border-radius: 50%;
            border: 2px solid #333;
        }

        .navbar-brand .pokeball-icon::before {
            content: '';
            position: absolute;
            top: calc(50% - 1.5px); left: 0;
            width: 100%; height: 3px;
            background: #333;
        }

        .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.4rem 1rem !important;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15) !important;
            color: #fff !important;
        }

        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        .main-content {
            padding: 2.5rem 0 4rem;
        }

        .type-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .type-fire     { background:#f08030; color:#fff; }
        .type-water    { background:#6890f0; color:#fff; }
        .type-grass    { background:#78c850; color:#fff; }
        .type-electric { background:#f8d030; color:#333; }
        .type-psychic  { background:#f85888; color:#fff; }
        .type-ghost    { background:#705898; color:#fff; }
        .type-normal   { background:#a8a878; color:#fff; }
        .type-rock     { background:#b8a038; color:#fff; }
        .type-ground   { background:#e0c068; color:#333; }
        .type-poison   { background:#a040a0; color:#fff; }
        .type-fairy    { background:#ee99ac; color:#fff; }
        .type-dragon   { background:#7038f8; color:#fff; }
        .type-ice      { background:#98d8d8; color:#333; }
        .type-fighting { background:#c03028; color:#fff; }
        .type-bug      { background:#a8b820; color:#fff; }
        .type-steel    { background:#b8b8d0; color:#333; }
        .type-dark     { background:#705848; color:#fff; }
        .type-flying   { background:#a890f0; color:#fff; }

        footer {
            background: var(--poke-mid);
            border-top: 2px solid var(--poke-card);
            color: var(--poke-muted);
            text-align: center;
            padding: 1.2rem;
            font-size: 0.8rem;
        }

        .btn-poke-primary {
            background: var(--poke-red);
            border: 2px solid var(--poke-red-dark);
            color: #fff;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-poke-primary:hover {
            background: var(--poke-red-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(227,53,13,0.4);
        }

        .btn-poke-secondary {
            background: transparent;
            border: 2px solid var(--poke-muted);
            color: var(--poke-muted);
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-poke-secondary:hover {
            border-color: var(--poke-text);
            color: var(--poke-text);
            transform: translateY(-2px);
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--poke-dark); }
        ::-webkit-scrollbar-thumb { background: var(--poke-card); border-radius: 3px; }
    </style>

    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            {{-- Brand --}}
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="pokeball-icon"></div>
                Pokédex
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMain"
                    aria-controls="navbarMain" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ route('home') }}">
                            <i class="bi bi-house-fill me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pokemon*') ? 'active' : '' }}"
                           href="{{ route('pokemon.index') }}">
                            <i class="bi bi-grid-3x3-gap-fill me-1"></i> Pokémon
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <span>Pokédex Laravel &copy; {{ date('Y') }} &mdash; Unidad III – Herramientas para acelerar la construcción de software</span>
    </footer>

    {{-- Bootstrap 5 JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>