<!-- The add Activity Modal -->
<div class="modal fade" id="createActivityModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Activity</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

            {{Form::open(array('route' => 'activity.store', 'method' => 'post'))}}

            <!-- resource_id -->
                    {{ Form::hidden('resource_id',$value = null, array('class' => 'form-control')) }}
                    {{ Form::hidden('resource_type',$value = null, array('class' => 'form-control')) }}


                <!-- description -->
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description',$value = null, array('class' => 'form-control', 'required'=>'required')) }}
                </div>

                <!-- reminder -->
                <div class="form-group">
                    {{ Form::label('reminder', 'Reminder') }}
                    {{ Form::text('reminder',$value = null, array('class' => 'form-control')) }}
                </div>

                <!-- remind_on -->
                <div class="form-group">
                    {{ Form::label('remind_on', 'Remind on') }}
                    {{ Form::date('remind_on',$value = null, array('class' => 'form-control')) }}
                </div>

                <!-- action_taken -->
                <div class="form-group">
                    {{ Form::label('action_taken', 'Action taken') }}
                    {{ Form::text('action_taken',$value = null, array('class' => 'form-control')) }}
                </div>

                <!-- customer_remarks -->
                <div class="form-group">
                    {{ Form::label('customer_remarks', 'Customer Remarks') }}
                    {{ Form::text('customer_remarks',$value = null, array('class' => 'form-control')) }}
                </div>

                <!-- bde_remarks -->
                <div class="form-group">
                    {{ Form::label('bde_remarks', 'BDE Remarks') }}
                    {{ Form::text('bde_remarks',$value = null, array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Add Activity!', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    "use strict";
    function showAddActivityModal(btn) {
        var resourceId = btn.getAttribute('data-resource-id');
        var resourceType = btn.getAttribute('data-resource-type');
        $("#createActivityModal input[name='resource_id']").val(resourceId);
        $("#createActivityModal input[name='resource_type']").val(resourceType);
        $('.modal').modal('hide');
        $('#createActivityModal').modal('show');
    }
</script>
