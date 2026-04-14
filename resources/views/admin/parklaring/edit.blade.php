@extends('layouts.admin')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Edit Parklaring Record</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ url('/admin/parklaring') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ url('/admin/parklaring/'.$parklaring->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <p class="mb-0"><b>Document Information</b></p>
                <div class="col-md-3 mb-3">
                    <label for="template" class="form-label">Document Template</label>
                    <select name="template" id="template" class="form-select" required>
                        <option value="0">Select Template</option>
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}" {{ $parklaring->template_id == $template->id ? 'selected' : '' }}>{{ $template->template_name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="col-md-3 mb-3">
                    <label for="entity" class="form-label">Entity (Company)</label>
                    <select name="entity" id="entity" class="form-select" required>
                        <option value="0">Select Entity</option>
                        @foreach ($entities as $entity)
                            <option value="{{ $entity->id }}" {{ $parklaring->entity_id == $entity->id ? 'selected' : '' }}>{{ $entity->entity_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="document_no" class="form-label">Document No.</label>
                    <input type="text" class="form-control" id="document_no" name="document_no" value="{{ $parklaring->document_no }}" disabled>
                    <span class="text-muted small"><i>Auto generated.</i></span>
                </div>
            </div>

            <div class="row">
                <p class="mb-0"><b>Employee Information</b></p>
                <div class="col-md-3 mb-3">
                    <label for="employee_name" class="form-label">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ $parklaring->employee_name }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="nik" class="form-label">Employee No.</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $parklaring->nik }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select name="department_id" id="department_id" class="form-select">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $parklaring->department_id == $department->id ? 'selected' : '' }}>{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="last_position" class="form-label">Last Position</label>
                    <input type="text" class="form-control" id="last_position" name="last_position" value="{{ $parklaring->last_position }}" required>
                </div>
            </div>

            <div class="row" id="non-contract-row"
             @if ($parklaring->template_id == 3)
                style="display: none;"
            @endif  
            >

                <div class="col-md-12" id="non-probation"
                @if ($parklaring->template_id == 2)
                    style="display: none;"
                @endif
                >
                    <p class="mb-0"><b>Working Period</b></p>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="join_date" class="form-label">Join Date</label>
                            <input type="date" class="form-control" id="join_date" name="join_date" value="{{ $parklaring->template_id != 3 ? $parklaring->join_date : '' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="resignation_date" class="form-label">Resignation Date</label>
                            <input type="date" class="form-control" id="resignation_date" name="resignation_date" value="{{ $parklaring->template_id != 3 ? $parklaring->resignation_date : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="probation"
                 @if ($parklaring->template_id != 2)
                    style="display: none;"
                @endif
                >
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="probation_status" class="form-label">Probation Status</label>
                            <select name="probation_status" id="probation_status" class="form-select">
                                <option value="">Select Probation Status</option>
                                @foreach ($probation_status as $probation_status)
                                    <option value="{{ $probation_status->id }}" {{ $parklaring->probation_status_id == $probation_status->id ? 'selected' : '' }}>{{ $probation_status->probation_status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="contract-row"
            @if ($parklaring->template_id != 3)
                style="display: none;"
            @else
                style="display: block;"
            @endif  
            >
                <p><b>Contract Information</b></p>

                @if(count($parklaring->contracts) > 0)
                    <div class="col-md-12">
                        <div class="row">
                    @foreach ($parklaring->contracts as $contract)
                    <div class="col-md-3 mb-3">
                        <label for="contract_name" class="form-label">Contract #1</label>
                        <input type="text" class="form-control" id="contract_name" name="contract_name[]" value="{!! $contract->contract_name !!}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="contract_start_date" class="form-label">Contract Start Date</label>
                        <input type="date" class="form-control" id="contract_start_date" name="contract_start_date[]" value="{!! $contract->contract_start_date !!}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="contract_end_date" class="form-label">Contract End Date</label>
                        <input type="date" class="form-control" id="contract_end_date" name="contract_end_date[]" value="{!! $contract->contract_end_date !!}">
                    </div>
                    @endforeach

                        </div>
                    </div>
                        

                @else

                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="contract_name" class="form-label">Contract #1</label>
                                <input type="text" class="form-control" id="contract_name" name="contract_name[]" value="Kontrak 1 / First Contract">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="contract_start_date" class="form-label">Contract Start Date</label>
                                <input type="date" class="form-control" id="contract_start_date" name="contract_start_date[]">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="contract_end_date" class="form-label">Contract End Date</label>
                                <input type="date" class="form-control" id="contract_end_date" name="contract_end_date[]">
                            </div>
                        </div>
</div>

                <div class="col-md-12">
                    <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="contract_name" class="form-label">Contract #2</label>
                    <input type="text" class="form-control" id="contract_name" name="contract_name[]" value="Kontrak 2 / Second Contract">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="contract_start_date" class="form-label">Contract Start Date</label>
                    <input type="date" class="form-control" id="contract_start_date" name="contract_start_date[]">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="contract_end_date" class="form-label">Contract End Date</label>
                    <input type="date" class="form-control" id="contract_end_date" name="contract_end_date[]">
                </div>
                    </div>
                </div>

                @endif
            </div>

            <div class="row">
                <p class="mb-0"><b>Approval</b></p>
                <div class="col-md-3 mb-3">
                    <label for="date_approved" class="form-label">Date Approved <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date_approved" name="date_approved" value="{{ \Carbon\Carbon::parse($parklaring->date_approved)->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Approved By</label>
                    <p id="approvedBy">{{ $parklaring->approver->approver_name }}</p>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Approver Position</label>
                    <p id="approvedByPosition">{{ $parklaring->approver->approver_position }}</p>
                </div>
            </div>
            <div class="row">
                <p class="mb-0"><b>Upload Document</b></p>
                <div class="col-md-3 mb-3">
                    <label for="exit_clearance_form" class="form-label">Exit Clearance Form</label>
                    @if($parklaring->exit_clearance_form)
                    <p class="mb-1">Current File: <a href="{{ asset('exit_clearance_form/' . $parklaring->exit_clearance_form) }}" target="_blank">{{ $parklaring->exit_clearance_form }}</a>
                </p>
                <!-- Delete Clearance Form file -->
                     <button type="button" class="btn btn-sm btn-danger mb-1" data-id="{{ $parklaring->id }}" id="delete_exit_clearance_form">Delete</button>
                    @endif

                    <input type="file" name="exit_clearance_form" id="exit_clearance_form" class="form-control">
                    <span class="text-muted small"><i>*Mandatory for non Reissued</i></span>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="resignation_form" class="form-label">Resignation Form</label>

                    @if($parklaring->resignation_form)
                    <p class="mb-1">Current File: <a href="{{ asset('resignation_form/' . $parklaring->resignation_form) }}" target="_blank">{{ $parklaring->resignation_form }}</a>
                    </p>
                    <!-- Delete Resignation Form file -->
                    <button type="button" class="btn btn-sm btn-danger mb-1" data-id="{{ $parklaring->id }}" id="delete_resignation_form">Delete</button>
                    @endif

                    <input type="file" name="resignation_form" id="resignation_form" class="form-control">
                    <span class="text-muted small"><i>*Mandatory for Reissued</i></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="publish" class="form-label">Publish</label>
                    <div class="d-flex gap-3">
                        <input type="radio" id="publish" name="publish" value="0" {{ $parklaring->publish == 0 ? 'checked' : '' }}> No
                        <input type="radio" id="publish" name="publish" value="1" {{ $parklaring->publish == 1 ? 'checked' : '' }}> Yes
                    </div>
                    <p><small>*If <b>YES</b>, the data will be visible to the employee.</small></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p><span class="text-danger">Important!!!</span> Please make sure and double check the data above before continue process for submission.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Record</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='{{ url('/admin/parklaring') }}'">Cancel</button>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#template').change(function() {
            if ($(this).val() == 3) {
                $('#contract-row').show();
                $('#non-contract-row').hide();
            } else {
                $('#contract-row').hide();
                $('#non-contract-row').show();
                if($(this).val() == 2){
                    $('#probation').show();
                    $('#non-probation').hide();
                }else{
                    $('#probation').hide();
                    $('#non-probation').show();
                }
            }
        });
        //add ajax deletion file exit clearance form
        $('#delete_exit_clearance_form').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/parklaring/' + id + '/delete_exit_clearance_form',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Optional: display a message before reloading
                    alert(response.message); 
                    
                    // Reload the entire page
                    location.reload(); 
                }
            });
        });
        //add ajax deletion file resignation form

        $('#delete_resignation_form').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/parklaring/' + id + '/delete_resignation_form',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Optional: display a message before reloading
                    alert(response.message); 
                    
                    // Reload the entire page
                    location.reload(); 
                }
            });
        });
        $('#entity').change(function() {
            var entity_id = $(this).val();
             // 2. Define the route with a placeholder
            var urlTemplate = "{{ route('admin.parklaring.getApprover', ':id') }}";

            // 3. Replace placeholder with the actual value
            var finalUrl = urlTemplate.replace(':id', entity_id);
            $.ajax({
                url: finalUrl,
                type: 'GET',
                success: function(response) {
                    $('#approvedBy').text(response.approver_name);
                    $('#approvedByPosition').text(response.approver_position);
                }
            });
        });
    });
</script>
@endsection
