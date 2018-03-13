@extends('adminlte::page')

@section('title', 'Histórico de Movimentaçoes')

@section('content_header')
    <h1>Histórico de Movimentaçoes</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Histórico</a></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">

        </div>
        <div class="box-body">
            <table class="table table-bordered" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Date</th>
                    <th>Sender</th>
                </tr>
                </thead>
                <tbody>
                @forelse($historics as $historic)
                    <tr>
                        <td>{{ $historic->id }}</td>
                        <td>{{ number_format($historic->amount,2,',','.') }}</td>
                        <td>{{ $historic->type($historic->type) }}</td>
                        <td>{{ $historic->date }}</td>
                        <td>
                            @if($historic->user_id_transaction)
                                {{ $historic->userSender->name }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
            {!! $historics->links() !!}
        </div>
    </div>
@stop