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
                {{Form::open(array('route' => 'project.store', 'method' => 'post'))}}
            <!-- name -->
                {{ Form::label('name', 'Project Name') }}
                {{ Form::text('name') }}

            <!-- address -->
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address') }}

            <!-- completion_date -->
                {{ Form::label('completion_date', 'Completion Date') }}
                {{ Form::date('completion_date') }}

                {{ Form::submit('Create Project!') }}

                {{ Form::close() }}
        </div>
    </div>
@endsection