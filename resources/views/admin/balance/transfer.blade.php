@extends('adminlte::page')

@section('title', 'Deposito')

@section('content_header')
    <h1>Fazer Recagar</h1>

    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Traferir</a></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Tranferir Saldo (Informeo Recebedor</h3>
        </div>
        <div class="box-body">
            @include('admin.incluides.alert')
            <form action="{{ route('transfer.confirm') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="sender" class="form-control" placeholder="Informe o recebedor (Nome ou E-mail)">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Próximo Etapa</button>
                </div>
            </form>
        </div>
    </div>
@stop