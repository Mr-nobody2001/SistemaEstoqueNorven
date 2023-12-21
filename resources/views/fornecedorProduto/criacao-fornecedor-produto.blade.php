@section('titulo', 'Cadastrar Fornecedor')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/geral/criacaoGeral.js') }}"></script>
    <script src="{{ asset('js/fornecedor/criacaoAtualizacaoFornecedorProduto.js') }}"></script>
@endsection

@php
    $contemCpf = (bool) old('cpf');
@endphp

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'local_shipping'" :titulo="'Cadastrar Fornecedor'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('fornecedor.store') }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @csrf
        <div id="container-botao-salvar">
            <button type="submit" id="botao-salvar" class="btn">Salvar</button>
        </div>

        <div>
            <label for="nome_fornecedor" class="form-label">Nome do fornecedor</label>
            <input type="text" id="nome_fornecedor" class="form-control" name="nome_fornecedor"
                   value="{{ old('nome_fornecedor') ?? '' }}" maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido">
                @error('nome_fornecedor')
                O nome fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div>
            <label for="email" class="form-label">Email do fornecedor</label>
            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') ?? '' }}"
                   maxlength="50" required>
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
            <label for="telefone" class="form-label">Telefone do fornecedor (deve estar no formato
                (XX)XXXX-XXXX ou (XX)9XXXX-XXXX)</label>
            <input type="text" id="telefone" class="form-control" name="telefone" value="{{ old('telefone') ?? '' }}"
                   minlength="14" maxlength="15"
                   pattern="\([1-9]{2}\) (?:9[1-9]{1}|[2-9]{1})[0-9]{3,4}-[0-9]{4}" required>
            <div class="invalid-feedback">
                O telefone não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('telefone')
                O telefone fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div id="container-input-cnpj" @class(['d-none' => $contemCpf])>
            <label for="cnpj" class="cnpj-label">Cnpj do fornecedor (deve estar no formato
                XX.XXX.XXX/XXXX-XX)</label>

            <input type="text" id="cnpj" class="form-control" name="cnpj" value="{{ old('cnpj') ?? '' }}"
                   minlength="18" maxlength="18" pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" @required(!$contemCpf)>

            <div class="invalid-feedback">
                O cnpj não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('telefone')
                O cnpj fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>

        <div id="container-input-cpf" @class(['d-none' => !$contemCpf])>
            <label for="cpf" class="cpf-label">Cpf do fornecedor (deve estar no formato
                XXX.XXX.XXX-XX)</label>

            <input type="text" id="cpf" class="form-control" name="cpf" value="{{ old('cpf') ?? '' }}"
                   minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" @required($contemCpf)>

            <div class="invalid-feedback">
                O cpf não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('telefone')
                O cpf fornecido não está no formato adequado ou já existe na base de dados.
                @enderror
            </span>
        </div>
    </form>

    <div class="form-check form-switch d-flex">
        <input class="form-check-input me-2" type="checkbox" role="switch" id="tipo_fornecedor" @checked($contemCpf)>

        <label class="form-check-label" for="tipo_fornecedor">Fornecedor pessoa física</label>
    </div>
</x-layouts.estrutura-basica>

