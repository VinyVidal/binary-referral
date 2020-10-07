@extends('templates/master')
<div class="container">
    <div class="row mt-md-3">
        <div class="col">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{ session('success') }}<p>
            </div>
        @endif
        </div>
    </div>
    <div class="row mt-md-3">

        <div class="col ">
            <h2> Bem-vindo ao seu dashboard, {{ $user->username }}!</h2>
        </div>
    </div>

    <div class="row mt-md-3">
        <div class="col border bg-danger text-light pt-3">
            <h4>Indique seus amigos e ganhe pontos!</h4>
                <p>Seu link de indicação: <b>{{ $user->referral_link }}</b></p>
        </div>
    </div>

    <div class="row mt-md-3">
        <div class="col border bg-secondary text-light py-3">
            <h4>Usuários que você indicou</h4>
            <div class="container">
                <div class="row">
                @foreach ($referrals as $r)
                    <div class="col">
                        <div class="media">
                            <img src="{{ asset('img/avatar.jpg') }}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="my-auto">{{ $r->username }}</h5>
                                <p>Pontos adquiridos: {{ $r->points }} pts</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-md-3">
        <div class="col border bg-info text-light py-3">
            <h4>Sua pontuação</h4>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h6>Lado esquerdo: {{ $user->left_points }}pts</h6>
                    </div>
                    <div class="col">
                        <h6>Lado direito: {{ $user->right_points }}pts</h6>
                    </div>
                    <div class="col">
                        <h6>Pontuação pessoal: {{ $user->points }} pts</h6>
                    </div>
                    <div class="col">
                        <h6>Grande total: {{ $user->left_points + $user->right_points + $user->points }} pts</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-md-3">
        <div class="col border bg-warning text-light py-3">
            <h4>Ganhe Pontos Agora!</h4>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('earnPoints') }}" class="btn btn-success">Ganhar Pontos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>