@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Packages</h2>
            </div>
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#createPackageModal">Create New Package</button>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

    <!-- The cerate Package Modal -->
    <div class="modal fade" id="createPackageModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Package</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                {{Form::open(array('route' => 'package.store', 'method' => 'post'))}}

                {{ Form::hidden('redirect_to', '/package') }}
                <!-- name -->

                    <div class="form-group">
                        {{ Form::label('package_name', 'Package Name') }}
                        {{ Form::text('package_name',$value = null, array('class' => 'form-control')) }}
                    </div>

                    {{ Form::submit('Create Package!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The search Contractor Modal -->
    <div class="modal fade" id="searchContractor">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Attach Contractor</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('attachContractorToPackage') }}" method="post">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="hidden" name="package_id">
                            <input type="hidden" name="contractor_id" id="contractorId">
                            <input type="text" class="form-control" name="contractor_name" id="searchContractorInput" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Go</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The search Project Modal -->
    <div class="modal fade" id="searchProject">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Attach Project</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('attachProjectToPackage') }}" method="post">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="hidden" name="package_id">
                            <input type="hidden" name="project_id" id="projectId">
                            <input type="text" class="form-control" name="project_name" id="searchProjectInput" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Go</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <div class="card">
        <div id="card_body" class="card-body">
            <table class="table" id="packages_table">
                <thead>
                    <th>S. No</th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->package_name }}</td>
                        <td>
                            <a href="{{ route('package.show', $package->id) }}" class="btn btn-primary" >Show</a>
                            <button class="btn btn-outline-info" data-package-id="{{ $package->id }}" onclick="showSearchContractor(this)">Add to Contractor</button>
                            <button class="btn btn-outline-info" data-package-id="{{ $package->id }}" onclick="showSearchProject(this)">Add to Project</button>
                            <button class="btn btn-outline-dark">Add Activity</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        "use strict";
        var srcContractor = "{{ route('searchContractor') }}";

        function  showSearchContractor(btn) {
            $("#searchContractor input[name='package_id']").val(btn.getAttribute("data-package-id"));
            $('#searchContractor').modal('show');
        }

        $("#searchContractorInput").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: srcContractor,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function( event, ui ) {
                $("#searchContractor #contractorId").val(ui.item.id);
            },
            minLength: 3,
        });

    </script>
    <script>
        var srcProject = "{{ route('searchProject') }}";

        function  showSearchProject(btn) {
            $("#searchProject input[name='package_id']").val(btn.getAttribute("data-package-id"));
            $('#searchProject').modal('show');
        }

        $("#searchProjectInput").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: srcProject,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function( event, ui ) {
                $("#searchProject #projectId").val(ui.item.id);
            },
            minLength: 3,
        });
    </script>
@endsection