@extends('adminlte::page')

@section('title', 'Confirmar Traferência')

@section('content_header')
    <h1>Fazer Recagar</h1>

    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Traferir</a></li>
        <li><a href="#">Confirmar Traferência</a></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar Traferência</h3>
        </div>
        <div class="box-body">
            @include('admin.incluides.alert')

            <p><strong>Recebedor: </strong>{{ $sender->name }}</p>
            <form action="{{ route('transfer.store') }}" method="post">
                {!! csrf_field() !!}

                <input type="hidden" name="sender_id" value="{{ $sender->id }}">

                <div class="form-group">
                    <input type="text" name="balance" class="form-control" placeholder="Valor:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transferir</button>
                </div>
            </form>
        </div>
    </div>
@stop