@extends('layouts.app')

@section('content')

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Create PMC
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
            @if(isset($pmc))
                {{ Form::model($pmc,  ['route' => ['pmc.store', $pmc->id], 'method' => 'patch']) }}
            @else
                {{Form::open(array('route' => 'pmc.store', 'method' => 'post'))}}
            @endif…

            <!-- name -->
            {{ Form::label('name', 'PMC Name') }}
            {{ Form::text('name') }}

        <!-- email -->
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email') }}

        <!-- phone_number -->
            {{ Form::label('phone_number', 'Phone Number') }}
            {{ Form::text('phone_number') }}

            {{ Form::submit('Create PMC!') }}

            {{ Form::close() }}
        </div>
    </div>
@endsection