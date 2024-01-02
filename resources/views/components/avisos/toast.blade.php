@if(session('msg'))
    <p class="aviso-secao d-none" data-mensagem="{{ session('msg') }}" data-tipo="{{ session('tipo') }}"></p>
@endif
