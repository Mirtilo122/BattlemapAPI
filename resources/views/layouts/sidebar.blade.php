<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 220px; min-height: 100vh;">
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-house me-2"></i> Home
            </a>
        </li>

        @if(session()->has('user') && session('user')->acesso === 'dm')
            <li>
                <a href="{{ route('users.index') }}"
                   class="nav-link d-flex align-items-center {{ request()->routeIs('usuarios.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-user-gear me-2"></i> Usuário
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('personagens.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('personagens.*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-user-ninja me-2"></i> Personagens
            </a>
        </li>

        @if(session()->has('user') && session('user')->acesso === 'dm')
            <li>
                <a href="{{ route('monstros.index') }}"
                   class="nav-link d-flex align-items-center {{ request()->routeIs('monstros.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-dragon me-2"></i> Monstros
                </a>
            </li>
        @endif

        @if(session()->has('user') && session('user')->acesso === 'dm')
            <li>
                <a href="{{ route('mapas.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('personagens.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-map me-2"></i> Mapas
                </a>
            </li>
        @endif

        @if(session()->has('user') && session('user')->acesso === 'dm')
            <li>
                <a href="{{ route('mapas.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('personagens.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-map me-2"></i> Quartos
                </a>
            </li>
        @endif
    </ul>
</div>
