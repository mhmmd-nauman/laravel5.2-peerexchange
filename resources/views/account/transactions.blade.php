@extends('layouts.app')

@section('title', 'Account Transactions')

@section('content')
    @include('partials.messages')

    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Transactions</div>

                    <div class="panel-body">
                        <table class="table" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Gateway</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->type->name }}</td>
                                        <td>{{ $transaction->gateway->name }}</td>
                                        <td>{{ $transaction->currency }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->balance }}</td>
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#transactionsTable').DataTable();
    });
</script>
@endsection

