@php use Illuminate\Support\Facades\Auth; @endphp
@section('titulo', 'Atualizar informações de cadastro')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/atualizacaoDelecao.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'person'" :titulo="'Atualizar informações de cadastro'"/>

    @php
        $usuario = Auth::user()
    @endphp

    <form id="container-formulario" class="needs-validation" action="{{ route('usuario.update',
        ['usuario' => $usuario->id ?? old('id')]) }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div id="container-botao-atualizar-deletar" class="w-100 justify-content-between">
            <a id="botao-sair" class="btn d-flex justify-content-center align-items-center" href="{{ route('deslogar') }}">Sair</a>
            <div>
                <button type="submit" id="botao-atualizar" class="btn">Atualizar</button>
                <button id="botao-deletar" class="btn">Deletar</button>
            </div>
        </div>

        <div class="d-none">
            <input type="hidden" name="id" value="{{ $usuario->id ?? old('id') }}">
        </div>

        <div>
            <label for="nome" class="form-label">Nome do usuário</label>
            <input type="text" id="nome" class="form-control" name="name"
                   value="{{ $usuario->name ?? old('name') }}" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo.
            </div>
            <span class="mt-1 campo-invalido">
                @error('name')
                 O nome fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email"
                   value="{{ $produto->email ?? old('email') }}" required>
            <div class="invalid-feedback">
                O email não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('email')
                O email fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div>
            <label for="senha" class="form-label">Senha</label>
            <input type="password" id="senha" class="form-control" name="password" required>
            <div class="invalid-feedback">
                A senha não pode ser nula.
            </div>
            <span class="mt-1 campo-invalido">
                @error('password')
                 A senha fornecida não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>
    </form>

    {{-- Formulário para a deleção (invisível para o usuário) --}}
    <x-componentesGerais.atualizacao.formulario-delecao :entidadeRota="'usuario'" :entidade="'usuario'"
                                                        :objeto="$usuario"/>
</x-layouts.estrutura-basica>
