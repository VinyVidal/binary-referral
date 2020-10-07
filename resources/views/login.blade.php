@extends('templates/master')

@section('title')
    Entrar na sua conta
@endsection

@section('content')
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-6 border p-4">
                <h2 class="text-center">Entrar na sua conta</h2>
                <form method="post" action="{{ route('login.post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>

                    <div>
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>

                    <p>Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se!</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection