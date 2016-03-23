@extends('layouts.app')

@section('title', 'Deposit')

@section('content')
    @include('partials.messages')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Deposit</div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('account.deposit') }}" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="currency" class="col-sm-2 control-label">Currency</label>
                                <div class="col-sm-3">
                                    <p class="form-control-static">
                                        <select name="currency">
                                            @foreach ($account as $currency)
                                                <option value="{{$currency->currency}}" >{{$currency->currency}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="amount" class="col-sm-2 control-label">Amount</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control"
                                           id="amount" name="amount" placeholder="Please enter amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Deposit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
