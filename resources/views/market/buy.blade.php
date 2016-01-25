@extends('layouts.app')

@section('title', 'Buy')

@section('content')
    @include('partials.messages')

    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Buy Foreign Currencies</div>

                    <div class="panel-body">
                        <table class="table" id="moneySellsTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Currencies</th>
                                    <th>Amount</th>
                                    <th>Rate</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($moneySells as $moneySell)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::instance($moneySell->created_at)->toDateString() }}</td>
                                        <td>{{ $moneySell->from_currency }} -> {{ $moneySell->to_currency }}</td>
                                        <td>{{ $moneySell->from_currency }}$ {{ $moneySell->amount }}</td>
                                        <td>{{ $moneySell->rate }}</td>
                                        <td>{{ $moneySell->to_currency }}$ {{ round($moneySell->rate * $moneySell->amount, 2) }}</td>
                                        <td>
                                            <a href="{{ route('market.makeBuy', ['id' => $moneySell->id]) }}"
                                               class="btn btn-primary btn-sm">
                                                Buy
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
