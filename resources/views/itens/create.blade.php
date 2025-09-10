@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Item</h1>

    <form action="{{ route('itens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('itens.partials.form', ['item' => null])
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
