@extends('layouts.app')



@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Contractors</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contractor.create') }}"> Create New Contractor</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif
    <div class="card">
        <div class="card-header"></div>
        <div id="card_body" class="card-body">
            <table class="table" id="contractors_table">
                <thead>
                    <th>S. No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach($contractors as $contractor)
                    <tr>
                        <td>{{ $contractor->id }}</td>
                        <td>{{ $contractor->name }}</td>
                        <td>{{ $contractor->email }}</td>
                        <td>{{ $contractor->phone_number }}</td>
                        <td>
                            <a href="{{ route('contractor.show', $contractor->id) }}" class="btn btn-primary" >Show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection