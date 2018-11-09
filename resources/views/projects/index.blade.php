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

    @include('activity.partial_activity_modal')

    <!-- The Project Info Modal -->
    <div class="modal fade" id="projectDetails">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="projectName"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th>Address</th>
                            <td id="address" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Completion Date</th>
                            <td id="completion_date" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="status" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>PMC</th>
                            <td id="pmc" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Client</th>
                            <td id="client" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td id="created_by" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Assigned To</th>
                            <td id="assigned_to" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td id="created_at" class="text-dark"></td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td id="updated_at" class="text-dark"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div id="statusChange">

                        <div class="form-group" id="statusUpdateDiv">
                            <label for="sel1">Choose Status</label>
                            <select class="selectpicker" id="statusSelect" data-style="btn-primary" onchange="updateStatus(this)" data-max-options="1">
                                <option value="N">New</option>
                                <option value="W">Won</option>
                                <option value="R">Rejected</option>
                                <option value="H">Hot</option>
                            </select>
                        </div>


                    </div>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="view">View Full Details</a>
                            <a class="dropdown-item" href="#" onclick="$('#statusUpdateDiv').show();">Change Status</a>
                            <a class="dropdown-item" id="addActivityBtn" onclick="showAddActivityModal(this);">Add Activity</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The cerate PMC Modal -->
    <div class="modal fade" id="createPMC">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create PMC</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                        {{Form::open(array('route' => 'pmc.store', 'method' => 'post'))}}

                        <!-- Project ID -->
                        {{ Form::hidden('project_id') }}
                        {{ Form::hidden('redirect_to', '/project') }}
                    <!-- name -->

                        <div class="form-group">
                            {{ Form::label('name', 'PMC Name') }}
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


                            {{ Form::submit('Create PMC!', array('class' => 'btn btn-primary')) }}

                            {{ Form::close() }}

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The search PMC Modal -->
    <div class="modal fade" id="searchPMC">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Attach PMC</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('attachPMC') }}" method="post">
                    <div class="input-group mb-3">
                        @csrf
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="pmc_id" id="pmcId">
                        <input type="hidden" name="redirect_to" value="/project">
                        <input type="text" class="form-control" name="pmc_name" id="searchPMCInput" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Go</button>
                        </div>
                    </div>
                    </form>
                    <form>



                    </form>



                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The cerate Client Modal -->
    <div class="modal fade" id="createClient">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Client</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                {{Form::open(array('route' => 'client.store', 'method' => 'post'))}}

                <!-- Project ID -->
                {{ Form::hidden('project_id') }}
                {{ Form::hidden('redirect_to', '/project') }}
                <!-- name -->

                    <div class="form-group">
                        {{ Form::label('name', 'Client Name') }}
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


                    {{ Form::submit('Create Client!', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The search Client Modal -->
    <div class="modal fade" id="searchClient">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Attach Client</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('attachClient') }}" method="post">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="hidden" name="project_id">
                            <input type="hidden" name="client_id" id="clientId">
                            <input type="hidden" name="redirect_to" value="/project">
                            <input type="text" class="form-control" name="client_name" id="searchClientInput" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Go</button>
                            </div>
                        </div>
                    </form>
                    <form>



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
        <div class="card-header">Header</div>
        <div id="map_canvas" class="card-body" style="width:100%; height:500px;"></div>
        <div class="card-footer">Footer</div>
    </div>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_GEOCODING_API_KEY', 'YOUR_GOOGLE_MAPS_API_KEY')  }}&v=3"></script>
    <script type="text/javascript">
        function initialize_map() {

            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap',
                zoom: 6,
              //  center: new google.maps.LatLng(28.6519500, 77.2314900), // Centered
                mapTypeControl: false
            };

            // Display a map on the page
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            map.setTilt(45);


            var url = "{{ route('projectsJson') }}";
            $(document).ready(function() {
                $.ajax({
                    url: url,
                    success: function(data){
                        var markers = JSON.parse(data);
                        var totalLocations = markers.length;

                        for (var i = 0; i < totalLocations; i++) {
                            var position = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);

                            var icon = "";
                            switch (markers[i].status) {
                                case "N": // new
                                    icon = "blue";
                                    break;
                                case "W": //won
                                    icon = "green";
                                    break;
                                case "R": // rejected
                                    icon = "grey";
                                    break;
                                case "H":
                                    icon = "red";
                                    break;
                            }

                            icon = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";

                            bounds.extend(position);
                            marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                title: markers[i].name,
                                animation: google.maps.Animation.DROP,
                                icon: new google.maps.MarkerImage(icon)
                            });

                            // Process multiple info windows
                            (function(marker, i) {
                                // add click event
                                google.maps.event.addListener(marker, 'click', function() {

                                    $("#projectDetails #projectName").html( markers[i].name );
                                    $("#projectDetails #address").html( markers[i].address );
                                    $("#projectDetails #completion_date").html( markers[i].completion_date );
                                    $("#projectDetails #status").html( markers[i].status );
                                    $("#projectDetails #statusSelect").attr("data-project-id", markers[i].id);
                                    if(markers[i].pmc_id === null || markers[i].pmc_id === undefined || markers[i].pmc_id == "")
                                    {   var html = '<div class="col-xs-12">';
                                        html += '<button type="button" class="btn btn-success btn-sm attach-pmc" onclick="attachPMC(this)" data-project-id ="' + markers[i].id + '" style="margin-right:5px;">Attach existing PMC</button>';
                                        html += '<button type="button" class="btn btn-light btn-sm create-pmc" onclick="createPMC(this)" data-project-id ="' + markers[i].id + '">Create new PMC</button>';
                                        html += "</div>";
                                        $("#projectDetails #pmc").html( html );
                                    }
                                    else{
                                        $("#projectDetails #pmc").html( markers[i].pmc.name );
                                    }

                                    if(markers[i].client_id === null || markers[i].client_id === undefined || markers[i].client_id == "")
                                    {   var html = '<div class="col-xs-12">';
                                        html += '<button type="button" class="btn btn-success btn-sm attach-client" onclick="attachClient(this)" data-project-id ="' + markers[i].id + '" style="margin-right:5px;">Attach existing Client</button>';
                                        html += '<button type="button" class="btn btn-light btn-sm create-client" onclick="createClient(this)" data-project-id ="' + markers[i].id + '">Create new Client</button>';
                                        html += "</div>";
                                        $("#projectDetails #client").html( html );
                                    }
                                    else{
                                        $("#projectDetails #client").html( markers[i].client.name );
                                    }

                                    $("#projectDetails #created_by").html( markers[i].created_by );
                                    $("#projectDetails #assigned_to").html( markers[i].user.name );
                                    $("#projectDetails #created_at").html( markers[i].created_at );
                                    $("#projectDetails #updated_at").html( markers[i].updated_at );
                                    $("#projectDetails #view").attr( 'href', window.location.href + "/" + markers[i].id );
                                    $("#addActivityBtn").attr('data-resource-id', markers[i].id);
                                    $("#addActivityBtn").attr('data-resource-type', "projectActivity");
                                    $("#statusUpdateDiv").hide();
                                    $('#projectDetails').modal('show');
                                });
                            })(marker, i);

                            // Automatically center the map fitting all markers on the screen
                            map.fitBounds(bounds);
                        }
                        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
                        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                            this.setZoom(14);
                            google.maps.event.removeListener(boundsListener);
                        });

                    }
                });
            });
        }

        google.maps.event.addDomListener(window, "load", initialize_map);
    </script>

    <script>
        "use strict";
        var srcPmc = "{{ route('searchPMC') }}";
        var srcClient = "{{ route('searchClient') }}";
        var updateProjectStatus = "{{ route('updateProjectStatus') }}";

        function createPMC(btn) {
            $("#createPMC input[name='project_id']").val(btn.getAttribute("data-project-id"));
            $('#projectDetails').modal('hide');
            $('#createPMC').modal('show');
        }

        function attachPMC(btn) {
            $("#searchPMC input[name='project_id']").val(btn.getAttribute("data-project-id"));
            $('#projectDetails').modal('hide');
            $('#searchPMC').modal('show');
        }

        function createClient(btn) {
            $("#createClient input[name='project_id']").val(btn.getAttribute("data-project-id"));
            $('#projectDetails').modal('hide');
            $('#createClient').modal('show');
        }

        function attachClient(btn) {
            $("#searchClient input[name='project_id']").val(btn.getAttribute("data-project-id"));
            $('#projectDetails').modal('hide');
            $('#searchClient').modal('show');
        }

        function updateStatus(select) {

            var status = $('.selectpicker').val();
            // Make an ajax call to update the status
            $.ajax({
                url: updateProjectStatus,
                dataType: "json",
                data: {
                    status : status,
                    project_id : select.getAttribute("data-project-id")
                },
                success: function(data) {
                    $("#statusUpdateDiv").hide();
                    initialize_map();
                }
            });
        }

        $("#searchPMCInput").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: srcPmc,
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
                $("#searchPMC #pmcId").val(ui.item.id);
            },
            minLength: 3,
        });

        $("#searchClientInput").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: srcClient,
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
                $("#searchClient #clientId").val(ui.item.id);
            },
            minLength: 3,
        });



    </script>

@endsection