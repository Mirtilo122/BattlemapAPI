<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 220px; min-height: 100vh;">
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-house me-2"></i> Home
            </a>
        </li>

        <li>
            <a href="{{ route('personagens.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('personagens.*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-user-ninja me-2"></i> Personagens
            </a>
        </li>

        <li>
            <a href="{{ route('melhorias.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('melhorias.*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-wrench me-2"></i> Melhorias
            </a>
        </li>

        <li>
            <a href="{{ route('maldicoes.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('maldicoes.*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-eye me-2"></i> Maldições
            </a>
        </li>

        <li>
            <a href="{{ route('itens.index') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('itens.*') ? 'active' : 'text-dark' }}">
                <i class="fa-solid fa-gift me-2"></i> Itens
            </a>
        </li>

        @if(auth()->check() && auth()->user()->acesso === 'dm')
            <li>
                <a href="{{ route('users.index') }}"
                   class="nav-link d-flex align-items-center {{ request()->routeIs('users.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-user-gear me-2"></i> Usuário
                </a>
            </li>


            <li>
                <a href="{{ route('monstros.index') }}"
                   class="nav-link d-flex align-items-center {{ request()->routeIs('monstros.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-dragon me-2"></i> Monstros
                </a>
            </li>

            <li>
                <a href="{{ route('mapas.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('mapas.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-map me-2"></i> Mapas
                </a>
            </li>

            <li>
                <a href="{{ route('tags.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('tags.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-tag me-2"></i> Tags
                </a>
            </li>

            <li>
                <a href="{{ route('tipos_subtipos.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('tipos_subtipos.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-cubes me-2"></i> Tipos de Itens
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('quartos.index') }}"
                    class="nav-link d-flex align-items-center {{ request()->routeIs('personagens.*') ? 'active' : 'text-dark' }}">
                    <i class="fa-solid fa-map me-2"></i> Quartos
                </a>
            </li> --}}
        @endif
    </ul>
</div>
