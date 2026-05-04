@extends('layouts.admin')
@section('conteudo')
    <h1 class="text-2xl font-black uppercase">Tela de {{ request()->segment(2) }}</h1>
    <p class="text-gray-500">Em breve, a listagem completa aqui.</p>
@endsection