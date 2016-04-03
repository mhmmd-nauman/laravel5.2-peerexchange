@extends('layouts.app')

@section('content')
@include('partials.messages')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/savesetttings') }}">
                        
                        {!! csrf_field() !!}

                        
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile" value="{{$current_user->mobile}}">

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nationalid') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">National ID</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nationalid" value="{{$current_user->nationalid}}">

                                @if ($errors->has('nationalid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nationalid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                              <input type="text" class="form-control" name="dob" value="{{$current_user->dob}}">
                                        
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                              <input type="text" class="form-control" name="address" value="{{$current_user->address}}">
                                        
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{$current_user->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--
                        <div class="form-group{{ $errors->has('personal_bank_account') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Personal Bank Account</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="personal_bank_account" value="{{$current_user->personal_bank_account}}">

                                @if ($errors->has('personal_bank_account'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('personal_bank_account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Country Code</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="country_code" value="{{$current_user->country_code}}">

                                @if ($errors->has('country_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('receiver_bank_account') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Receiver Bank Account Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="receiver_bank_account_name" value="{{$current_user->receiver_bank_account_name}}">

                                @if ($errors->has('receiver_bank_account_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver_bank_account_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('receiver_bank_account') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Receiver Bank Account</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="receiver_bank_account" value="{{$current_user->receiver_bank_account}}">

                                @if ($errors->has('receiver_bank_account'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver_bank_account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('receiver_country_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Receiver Bank Account Country</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="receiver_country_code" value="{{$current_user->receiver_country_code}}">

                                @if ($errors->has('receiver_country_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver_country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
