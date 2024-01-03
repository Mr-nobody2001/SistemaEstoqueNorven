<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
<div class="container">
    <x-avisos.toast/>

    <div class="content first-content">
        <div class="first-column">
            <h2 class="title title-primary">Bem-vindo de volta!</h2>
            <p class="description description-primary">Para se manter conectado conosco,</p>
            <p class="description description-primary">por favor faça login com suas informações pessoais</p>
            <button id="signin" class="btn btn-primary">Entrar</button>
        </div>
        <div class="second-column">
            <h2 class="title title-second">criar conta</h2>
            <p class="description description-second">use seu e-mail para registro:</p>
            <form class="form" method="POST" action="{{ route('usuario.store') }}">
                @csrf
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="name" placeholder="Nome" value="{{ old('name') ?? '' }}" required>
                </label>

                <label class="label-input" for="">
                    <i class="far fa-envelope icon-modify"></i>
                    <input type="email" name="email" placeholder="E-mail" value="{{ old('email') ?? '' }}" required>
                </label>

                <span class="mt-1 campo-invalido">
                    @error('email')
                    O email fornecido não está no formato adequado ou já existe no banco de dados.
                    @enderror
                </span>

                <label class="label-input" for="">
                    <i class="fas fa-lock icon-modify"></i>
                    <input type="password" name="password" placeholder="Senha" required>
                </label>

                <span class="mt-1 campo-invalido">
                    @error('password')
                     A senha fornecida não está no formato adequado.
                    @enderror
                </span>

                <button class="btn btn-second">registrar</button>
            </form>
        </div><!-- segunda coluna -->
    </div><!-- primeiro conteúdo -->
    <div class="content second-content">
        <div class="first-column">
            <h2 class="title title-primary">olá, amigo!</h2>
            <p class="description description-primary">Insira seus detalhes pessoais</p>
            <p class="description description-primary">e comece a jornada conosco</p>
            <button id="signup" class="btn btn-primary">registrar</button>
        </div>
        <div class="second-column">
            <h2 class="title title-second">entrar</h2>
            <p class="description description-second">use sua conta de e-mail:</p>
            <form class="form" method="POST" action="{{ route('autenticar') }}">
                @csrf
                <label class="label-input" for="">
                    <i class="far fa-envelope icon-modify"></i>
                    <input type="email" name="email" placeholder="E-mail">
                </label>

                <label class="label-input" for="">
                    <i class="fas fa-lock icon-modify"></i>
                    <input type="password" name="password" placeholder="Senha">
                </label>

                <button class="btn btn-second">entrar</button>
            </form>
        </div>
    </div>
</div>
<script type="module" src="{{ asset('js/login/login.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>
