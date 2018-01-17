@extends('adminlte::page')

@section('title', 'Deposito')

@section('content_header')
    <h1>Fazer Recagar</h1>

    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Deposito</a></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            @include('admin.incluides.alert')
            <form action="{{ route('balance.store') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="value" class="form-control" placeholder="Valor Recarga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>
            </form>
        </div>
    </div>
@stop