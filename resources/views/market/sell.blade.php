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
                                <form class="form-horizontal" action="{{ route('market.sell') }}" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="fromCurrency" class="col-sm-4 control-label">Balance Currency</label>
                                        <div class="col-sm-4">
                                            <p class="form-control-static">{{ $account->currency }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="balance" class="col-sm-4 control-label">Balance</label>
                                        <div class="col-sm-4">
                                            <p class="form-control-static">{{ $account->balance }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Amount</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control"
                                                   id="amount" name="amount" placeholder="Please enter amount">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="toCurrency" class="col-sm-4 control-label">Target Currency</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="toCurrency" name="toCurrency">
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->code }}">{{ $currency->code }}: {{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rate" class="col-sm-4 control-label">Exchange Rate</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                   id="rate" name="rate" placeholder="Please enter rate">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="toAmount" class="col-sm-4 control-label">Target Currency Amount</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control"
                                                   id="toAmount" name="toAmount" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Sell</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @if (count($moneySells) > 0)
                                    <h4>Current Money Being Sold</h4>
                                    <table class="table" id="moneySellsTable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Currency</th>
                                                <th>Amount</th>
                                                <th>Rate</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($moneySells as $moneySell)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::instance($moneySell->created_at)->toDateString() }}</td>
                                                    <td>{{ $moneySell->from_currency }} -> {{ $moneySell->to_currency }}</td>
                                                    <td>{{ $moneySell->from_currency }}$ {{ $moneySell->amount }}</td>
                                                    <td>{{ $moneySell->rate }}</td>
                                                    <td>{{ $moneySell->to_currency }}$ {{ round($moneySell->amount * $moneySell->rate, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
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
