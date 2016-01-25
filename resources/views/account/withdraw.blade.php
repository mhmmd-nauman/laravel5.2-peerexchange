@extends('layouts.app')

@section('title', 'Withdraw')

@section('content')
    @include('partials.messages')

    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Withdraw</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <form class="form-horizontal" action="{{ route('account.withdraw') }}" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="currency" class="col-sm-4 control-label">Currency</label>
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
                                                   id="amount" name="amount" placeholder="Please enter amount"
                                                   value="{{ old('amount') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-4">
                                            <button type="submit" class="btn btn-default">Withdraw</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h4>Current Money Bought</h4>
                                <table class="table" id="moneyBoughtTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($moneyBuys as $moneyBuy)
                                            <td>{{ \Carbon\Carbon::instance($moneyBuy->created_at)->toDateTimeString() }}</td>
                                            <td>{{ $moneyBuy->moneySell->from_currency }}</td>
                                            <td>{{ $moneyBuy->moneySell->amount }}</td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
