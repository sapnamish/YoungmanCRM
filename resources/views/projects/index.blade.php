@extends('layouts.app')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Projects</h2>

            </div>

            <div class="pull-right">



                <a class="btn btn-success" href="{{ route('project.create') }}"> Create New Project</a>



            </div>

        </div>

    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

    <table class="table table-bordered table-hover table-condensed" id ="myProjects">
        <thead>
        <tr>


        </tr>
        </thead>
        <tbody>
        @foreach ($projects as $key => $project)

            <tr>







            </tr>

        @endforeach
        </tbody>
    </table>



@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#myProjects').DataTable();
        } );
    </script>
@endsection