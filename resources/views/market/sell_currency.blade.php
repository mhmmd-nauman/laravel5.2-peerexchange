@extends('layouts.app')

@section('title', 'Sell')

@section('content')
    @include('partials.messages')

    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Sell</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>Balance</th>
                                            <th>Action</th>
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
                                        <td>
                                            <a class="btn btn-primary" href="{{ url('/sell-currency/'.$currency->id) }}">Sell</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                              
                            </div>
                         
                        </div>
                        <div class="row">
                            <h4>My Sell Transactions</h4>
                       
                           <table class="table" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Currency</th>
                                        <th>Sold</th>
                                        <th>To Whom</th>
                                        <th>Amount</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($moneySells as $moneySell1)
                                    @foreach ($moneySell1 as $moneySell2)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::instance($moneySell2->created_at)->toDateString() }}</td>
                                        <td>{{ $moneySell2->from_currency }} -> {{ $moneySell2->to_currency }}</td>
                                        <td>@if ($moneySell2->sold ==1)
                                                Yes
                                            @else
                                                No
                                            @endif</td>
                                        <td>
                                            {{ $moneySell2->moneybuy->account->user->first_name }}
                                        </td>
                                        <td>{{ $moneySell2->from_currency }}$ {{ $moneySell2->amount }}</td>
                                        <td>{{ $moneySell2->rate }}</td>
                                        <td>{{ $moneySell2->to_currency }}$ {{ round($moneySell2->amount * $moneySell2->rate, 2) }}</td>
                                    </tr> 
                                     @endforeach
                                     @endforeach
                                </tbody>
                           </table>
                        </Div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

    function updateTargetCurrency()
    {
        var amountVal = $('#amount').val().trim();
        if (amountVal != '') {
            var rateVal = $('#rate').val().trim();
            if (rateVal) {
                var amount = parseFloat(amountVal);
                var rate = parseFloat(rateVal);
                var toAmount = (amount * rate).toFixed(2);
                $('#toAmount').val(toAmount.toLocaleString());
            }
        }
    }

    $(document).ready(function() {
        $('#amount').on('input', function(){
            updateTargetCurrency();
        });
        $('#rate').on('input', function(){
            updateTargetCurrency();
        });
    });
</script>
@endsection
