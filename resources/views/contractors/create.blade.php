@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Create Project
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
                {{Form::open(array('route' => 'contractor.store', 'method' => 'post'))}}
            <!-- name -->
                {{ Form::label('name', 'Contractor Name') }}
                {{ Form::text('name') }}

            <!-- email -->
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email') }}

            <!-- phone_number -->
                {{ Form::label('phone_number', 'Phone Number') }}
                {{ Form::date('phone_number') }}

            <!-- city -->
                {{ Form::label('city', 'City') }}
                {{ Form::date('city') }}

            <!-- phone_number -->
                {{ Form::label('state_code', 'State Code') }}
                {{ Form::date(' state_code') }}

                {{ Form::submit('Create Contractor!') }}

                {{ Form::close() }}
        </div>
    </div>
@endsection