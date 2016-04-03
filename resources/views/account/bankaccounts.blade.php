@extends('layouts.app')

@section('title', 'Bank Accounts')

@section('content')
    @include('partials.messages')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Bank Accounts</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-heading col-md-12"><h4>Existing Bank Account</h4></div>
                        </div>
                        <div class="row">
                            <table class="table" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Bank Name</th>
                                    <th>Account Title</th>
                                    <th>Account Number</th>
                                    <th>Currency</th>
                                    <th>Country</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bankaccounts as $bankaccount)
                                    <tr>
                                        <td>{{ $bankaccount->id }}</td>
                                        <td>{{ \Carbon\Carbon::instance($bankaccount->created_at)->toDateString() }}</td>
                                        <td>{{ $bankaccount->bank_name }}</td>
                                        <td>{{ $bankaccount->bank_account_title }}</td>
                                        <td>{{ $bankaccount->bank_account_number }}</td>
                                        <td>{{ $bankaccount->currency_code }}</td>
                                        <td>{{ $bankaccount->country_code }}</td>
                                        <td>
                                        @if ($bankaccount->is_primary ==1)
                                            Personal
                                        @else
                                            Family
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="panel-heading"><h4>Add Mew  Bank Account</h4></div>
                        <form class="form-horizontal" action="{{ route('account.bankaccount') }}" method="post">
                        <?php echo csrf_field(); ?>
                            
                        <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"> Bank Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="bank_name" value="">

                                @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bank_account_title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"> Account Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="bank_account_title" value="">

                                @if ($errors->has('bank_account_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank_account_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bank_account_number') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Account Number</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="bank_account_number" value="">

                                @if ($errors->has('bank_account_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Account Currency</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="currency_code" value="">
                            <select class="form-control" id="is_primary" name="currency_code">
                                <option value="SGD">SGD</option>
                                <option value="MYR">MYR</option>
                            </select>
                            @if ($errors->has('currency_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('currency_code') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Bank Account Country</label>

                            <div class="col-md-6">
                                <select class="form-control" id="is_primary" name="country_code">
                                    <option value="SG">Singapore</option>
                                    <option value="MY">Malaysia</option>
                                </select>
                                @if ($errors->has('country_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Account Type</label>

                            <div class="col-md-6">
                                <select class="form-control" id="is_primary" name="is_primary">
                                    <option value="1">Personal</option>
                                    <option value="0">Family</option>
                                </select>
                                
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-6">
                                    <button type="submit" class="btn btn-default">Save New Account</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
