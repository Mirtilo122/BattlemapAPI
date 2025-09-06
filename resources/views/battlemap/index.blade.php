{{-- resources/views/battlemap/index.blade.php --}}

@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Battlemap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        header {
            padding: 10px;
            background-color: #222;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .token {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 80vh;
        }
        .quarto {
            position: relative;
            background-color: #fff;
        }
        .porta {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: brown;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }
        .porta.trancada {
            background-color: gray;
            cursor: not-allowed;
        }
        .entidade {
            position: absolute;
            width: 40px;
            height: 40px;
        }
        .tabs {
            margin-left: 20px;
        }
    </style>
</head>
<body>

<header>
    @if($user->acesso === 'dm')
        <ul class="nav nav-tabs" id="tabs">
            <li class="nav-item"><a class="nav-link active" href="#personagens" data-bs-toggle="tab">Personagens</a></li>
            <li class="nav-item"><a class="nav-link" href="#monstros" data-bs-toggle="tab">Monstros</a></li>
        </ul>
        <div class="tab-content tabs">
            <div class="tab-pane fade show active" id="personagens">
                @foreach($personagens as $p)
                    <img src="{{ $p->imagem_token }}" class="token" title="{{ $p->nome }}"
                        data-id="{{ $p->id }}" data-tipo="personagem">
                @endforeach
            </div>
            <div class="tab-pane fade" id="monstros">
                @foreach($monstros as $m)
                    <img src="{{ $m->imagem_token }}" class="token" title="{{ $m->nome }}"
                        data-id="{{ $m->id }}" data-tipo="monstro">
                @endforeach
            </div>
        </div>
    @else
        {{-- Jogador vê todos os personagens --}}
        @foreach($personagens as $p)
            <img src="{{ $p->imagem_token }}" class="token" title="{{ $p->nome }}">
        @endforeach
    @endif
</header>

<main>
    {{-- Quarto --}}
    @php
        $quarto = \App\Models\Quarto::find($quartoId);
        $gridWidth = $quarto->x * 50; // 50px por bloco
        $gridHeight = $quarto->y * 50;
    @endphp
    <div class="quarto" style="width: {{ $gridWidth }}px; height: {{ $gridHeight }}px;">

        {{-- Grid --}}
        @for($i = 1; $i < $quarto->x; $i++)
            <div style="position: absolute; top: 0; left: {{ $i * 50 }}px; width: 1px; height: 100%; background: rgba(0,0,0,0.2);"></div>
        @endfor
        @for($i = 1; $i < $quarto->y; $i++)
            <div style="position: absolute; left: 0; top: {{ $i * 50 }}px; width: 100%; height: 1px; background: rgba(0,0,0,0.2);"></div>
        @endfor

        {{-- Portas de saída --}}
        @foreach($quarto->portasSaida as $porta)
            @php
                $estado = $porta->estadoPorta ? $porta->estadoPorta->estado : 'destrancada';
                $trancada = $estado === 'trancada';
                $link = route('battlemap.index', ['mapaId' => $mapaId, 'quartoId' => $porta->qb_id]);
            @endphp
            <a href="{{ $trancada && $user->acesso !== 'dm' ? '#' : $link }}"
            class="porta {{ $trancada ? 'trancada' : '' }}"
            style="left: {{ $porta->qax * 50 }}px; top: {{ $porta->qay * 50 }}px;"
            title="Porta para {{ $porta->quartoB->nome }}">
            P
            </a>
        @endforeach

        {{-- Portas de entrada --}}
        @foreach($quarto->portasEntrada as $porta)
            @php
                $estado = $porta->estadoPorta ? $porta->estadoPorta->estado : 'destrancada';
                $trancada = $estado === 'trancada';
                $link = route('battlemap.index', ['mapaId' => $mapaId, 'quartoId' => $porta->qa_id]);
            @endphp
            <a href="{{ $trancada && $user->acesso !== 'dm' ? '#' : $link }}"
            class="porta {{ $trancada ? 'trancada' : '' }}"
            style="left: {{ $porta->qbx * 50 }}px; top: {{ $porta->qby * 50 }}px;"
            title="Porta de {{ $porta->quartoA->nome }}">
            P
            </a>
        @endforeach

        {{-- Entidades no quarto --}}
        @foreach($mapa['posicoes']->where('quarto_id', $quartoId) as $pos)
            @php
                $imagem = '';
                $nome = '';

                if ($pos->tipo_entidade === 'personagem') {
                    $entidade = $personagens->firstWhere('id', $pos->entidade_id);
                } elseif ($pos->tipo_entidade === 'monstro') {
                    $entidade = $monstros->firstWhere('id', $pos->entidade_id);
                } else {
                    $entidade = null;
                }

                if ($entidade) {
                    $imagem = $entidade->imagem_token;
                    $nome = $entidade->nome;
                }
            @endphp

            @if($entidade)
                <img src="{{ $imagem }}" class="entidade"
                    style="left: {{ $pos->x * 50 }}px; top: {{ $pos->y * 50 }}px;"
                    title="{{ $nome }}"
                    data-id="{{ $pos->entidade_id }}"
                    data-tipo="{{ $pos->tipo_entidade }}">
            @endif
        @endforeach
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tokensHeader = document.querySelectorAll('header .token');
    const battlemap = document.querySelector('.quarto');

    let dragToken = null;
    let offsetX = 0;
    let offsetY = 0;

    const urlSegments = window.location.pathname.split('/');
    // urlSegments = ["", "battlemap", "1", "4"]

    const mapaId = urlSegments[2];   // "1"
    const quartoId = urlSegments[3]; // "4"

    // Função para criar/atualizar posição no backend
    function criarOuAtualizarPosicao(entidadeId, tipoEntidade, x, y) {
        // Pega mapaId e quartoId da URL
        const urlParts = window.location.pathname.split('/'); // ['/battlemap', '1', '4']
        const mapaId = urlParts[2];
        const quartoId = urlParts[3] || null;

        // Cria objeto com todos os dados
        const dados = {
            tipo_entidade: tipoEntidade,
            mapa_id: mapaId,
            quarto_id: quartoId,
            x: x,
            y: y
        };

        // Log para conferir antes de enviar
        console.log('Enviando para o backend:', dados);

        fetch(`/battlemap/mover/${entidadeId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(dados)
        })
        .then(response => response.json())
        .then(data => console.log('Posição salva', data))
        .catch(error => console.error('Erro:', error));
    }

    // --- Arrastar tokens do header ---
    tokensHeader.forEach(token => {
        token.addEventListener('mousedown', e => {
            dragToken = token.cloneNode(true);
            dragToken.style.position = 'absolute';
            dragToken.style.zIndex = 1000;
            dragToken.style.pointerEvents = 'none';
            document.body.appendChild(dragToken);

            offsetX = e.offsetX;
            offsetY = e.offsetY;

            moveAt(e.pageX, e.pageY);
        });
    });

    function moveAt(pageX, pageY) {
        if(dragToken) {
            dragToken.style.left = pageX - offsetX + 'px';
            dragToken.style.top = pageY - offsetY + 'px';
        }
    }

    document.addEventListener('mousemove', e => {
        if(dragToken) moveAt(e.pageX, e.pageY);
    });

    document.addEventListener('mouseup', e => {
        if(dragToken) {
            const rect = battlemap.getBoundingClientRect();
            if(e.pageX >= rect.left && e.pageX <= rect.right &&
               e.pageY >= rect.top && e.pageY <= rect.bottom) {

                // Calcula posição em grid
                let x = Math.floor((e.pageX - rect.left) / 50);
                let y = Math.floor((e.pageY - rect.top) / 50);

                // Adiciona token no battlemap
                const newToken = dragToken.cloneNode(true);
                newToken.style.position = 'absolute';
                newToken.style.left = (x*50) + 'px';
                newToken.style.top = (y*50) + 'px';
                newToken.style.pointerEvents = 'auto';
                newToken.classList.add('entidade');
                newToken.setAttribute('data-id', dragToken.dataset.id);
                newToken.setAttribute('data-tipo', dragToken.dataset.tipo);
                battlemap.appendChild(newToken);

                // Salva no backend
                criarOuAtualizarPosicao(newToken.dataset.id, newToken.dataset.tipo, x, y);

                // Permite mover depois
                habilitarDragNoMapa(newToken, newToken.dataset.id, newToken.dataset.tipo);
            }
            dragToken.remove();
            dragToken = null;
        }
    });

    // --- Mover tokens já no mapa ---
    function habilitarDragNoMapa(token, entidadeId, tipoEntidade) {
        let offsetX2 = 0;
        let offsetY2 = 0;
        let dragging = false;

        token.addEventListener('mousedown', e => {
            dragging = true;
            offsetX2 = e.offsetX;
            offsetY2 = e.offsetY;
        });

        document.addEventListener('mousemove', e => {
            if(dragging) {
                token.style.left = e.pageX - battlemap.getBoundingClientRect().left - offsetX2 + 'px';
                token.style.top = e.pageY - battlemap.getBoundingClientRect().top - offsetY2 + 'px';
            }
        });

        document.addEventListener('mouseup', e => {
            if(dragging) {
                dragging = false;

                let x = Math.floor((token.offsetLeft + offsetX2) / 50);
                let y = Math.floor((token.offsetTop + offsetY2) / 50);

                token.style.left = (x*50) + 'px';
                token.style.top = (y*50) + 'px';

                // Salva a nova posição
                criarOuAtualizarPosicao(entidadeId, tipoEntidade, x, y);
            }
        });
    }

    // Inicializa drag dos tokens já no mapa
    document.querySelectorAll('.quarto .entidade').forEach(el => {
        const id = el.getAttribute('data-id');
        const tipo = el.getAttribute('data-tipo');
        habilitarDragNoMapa(el, id, tipo);
    });
});
</script>

</body>
</html>
