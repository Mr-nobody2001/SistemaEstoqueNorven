@section('titulo', 'Cadastrar Fornecedor')

@section('estilo')
    <link rel="stylesheet" href="{{ asset('css/components/estilosGerais/criacao-atualizacao-delecao-geral.css') }}">
@endsection

@section('script')
    <script type="module" src="{{ asset('js/scriptGeral/criacaoGeral.js') }}"></script>
@endsection

<x-layouts.estrutura-basica>
    <x-avisos.toast/>

    <x-componentesGerais.informacoes-pagina :textoIcone="'list'" :titulo="'Cadastrar Fornecedor'"/>

    <form id="container-formulario" class="needs-validation" action="{{ route('fornecedor.store') }}" method="POST"
          enctype="multipart/form-data" novalidate>
        @csrf
        <div id="container-botao-salvar">
            <button type="submit" id="botao-salvar" class="btn">Salvar</button>
        </div>

        <div>
            <label for="nome_fornecedor" class="form-label">Nome do fornecedor</label>
            <input type="text" id="nome_fornecedor" class="form-control" name="nome_fornecedor" maxlength="50"
                   pattern="^[a-zA-Z0-9áéíóúâêîôûãõàèìòùäëïöüçñÁÉÍÓÚÂÊÎÔÛÃÕÀÈÌÒÙÄËÏÖÜÇÑ&'\-\s]*$" required>
            <div class="invalid-feedback">
                O nome não pode ser nulo e deve conter apenas caracteres alfanuméricos, "-", "&" e "'.
            </div>
            <span class="mt-1 campo-invalido">
                @error('nome_fornecedor')
                Este fornecedor já existe no banco de dados e não pode ser inserido novamente.
                @enderror
            </span>
        </div>

        <div>
            <label for="email_fornecedor" class="form-label">Email do fornecedor</label>
            <input type="email" id="email_fornecedor" class="form-control" name="email_fornecedor" value=""
                   maxlength="50" pattern="^(\+?\d{1,4}?)?[-.\s]?(\(?\d{1,}\)?)?[-.\s]?\d{1,}[-.\s]?\d{1,}$" required>
            <div class="invalid-feedback">
                O email não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('email_fornecedor')
                Este email já existe no banco de dados e não pode ser inserido novamente.
                @enderror
            </span>
        </div>

        <div>
            <label for="telefone_fornecedor" class="form-label">Telefone do fornecedor (deve estar no formato
                (XX)XXXX-XXXX ou (XX)9XXXX-XXXX)</label>
            <input type="text" id="telefone_fornecedor" class="form-control" name="telefone_fornecedor"
                   minlength="13" maxlength="14"
                   pattern="\([1-9]{2}\)(?:9[1-9]{1}|[2-9]{1})[0-9]{3,4}-[0-9]{4}" required>
            <div class="invalid-feedback">
                O telefone não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('telefone_fornecedor')
                Este telefone já existe no banco de dados e não pode ser inserido novamente.
                @enderror
            </span>
        </div>

        <div>
            <label for="cpf_fornecedor" class="cpf-label">Cpf do fornecedor (deve estar no formato
                XXX.XXX.XXX-XX)</label>
            <input type="text" id="cpf_fornecedor" class="form-control" name="cpf_fornecedor"
                   minlength="14" maxlength="14"
                   pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
            <div class="invalid-feedback">
                O cpf não pode ser nulo e deve estar num formato válido.
            </div>
            <span class="mt-1 campo-invalido">
                @error('telefone_fornecedor')
                Este cpf já existe no banco de dados e não pode ser inserido novamente.
                @enderror
            </span>
        </div>
    </form>
</x-layouts.estrutura-basica>

