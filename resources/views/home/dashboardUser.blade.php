@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if ($account->balance > 0)
                        <div class="jumbotron">
                            <h3>Account Balance</h3>
                            <h4>{{ $account->balance }}</h4>
                            <p><a class="btn btn-primary" href="{{ route('account.transactions') }}" role="button">View Transactions</a></p>
                        </div>
                    @else
                        <div class="jumbotron">
                            <h3>Deposit Money to Get Started!</h3>
                            <p><a class="btn btn-primary" href="{{ route('account.deposit') }}" role="button">Deposit</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
