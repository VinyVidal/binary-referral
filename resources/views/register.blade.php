@extends('templates/master')

@section('title')
    Criar conta
@endsection

@section('content')
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-6 border p-4">
                <h2 class="text-center">Criar uma nova conta</h2>
                @if (session('referrer'))
                    <p>Você foi indicado por {{ session('referrer') }}</p>
                @endif
                <form method="post" action="{{ route('register.post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Nome de usuário</label>
                        <input type="username" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirme sua senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>

                    <div>
                        @if (session('message'))
                            <div class="alert alert-danger">{{ session('message') }}</div>
                        @endif
                    </div>

                    <p>Já possui uma conta? <a href="{{ route('login') }}">Entre agora!</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection