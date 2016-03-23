@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>Currency</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        @foreach ($accounts as $currency)
                        <tr>
                            <td>
                                {{$currency->currency}}
                            </td>
                            <td>
                                {{$currency->balance}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                    
                    <div class="jumbotron">
                        <h3>Deposit Money to Get Started!</h3>
                        <p><a class="btn btn-primary" href="{{ route('account.deposit') }}" role="button">Deposit</a></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
