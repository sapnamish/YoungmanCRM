@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Create Contractor
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
                @if(isset($contractor))
                    {{ Form::model($contractor,  ['route' => ['contractor.store', $contractor->id], 'method' => 'patch']) }}
                @else
                    {{Form::open(array('route' => 'contractor.store', 'method' => 'post'))}}
                @endif

            <!-- name -->
                <div class="form-group">
                {{ Form::label('name', 'Contractor Name') }}
                {{ Form::text('name',$value = null, array('class' => 'form-control')) }}
                </div>
            <!-- email -->
                    <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email',$value = null, array('class' => 'form-control')) }}
                    </div>
            <!-- phone_number -->
                    <div class="form-group">
                {{ Form::label('phone_number', 'Phone Number') }}
                {{ Form::text('phone_number',$value = null, array('class' => 'form-control')) }}
                    </div>
            <!-- city -->
                    <div class="form-group">
                {{ Form::label('city', 'City') }}
                {{ Form::text('city',$value = null, array('class' => 'form-control')) }}
                    </div>
            <!-- phone_number -->
                    <div class="form-group">
                {{ Form::label('state_code', 'State Code') }}
                {{ Form::text(' state_code',$value = null, array('class' => 'form-control')) }}
                    </div>

                {{ Form::submit('Create Contractor!') }}

                {{ Form::close() }}
        </div>
    </div>
@endsection