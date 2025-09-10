@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Item</h1>

    <form action="{{ route('itens.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('itens.partials.form', ['item' => $item])
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
