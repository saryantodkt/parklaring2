@extends('layouts.admin')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Settings</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ url('/admin/parklaring') }}" class="btn btn-primary">Back</a>
    </div>
</div>
<!-- Entity -->
<div class="card shadow-sm mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Entities</h3>
            </div>
            <div class="col-md-6 text-end">
                <!-- <a href="{{ url('/admin/setting/create') }}" class="btn btn-primary">Add New Entity</a> -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Entity Name</th>
                        <th>Logo</th>
                        <th>Stamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entities as $entity)
                        <tr>
                            <td>{{ $entity->id }}</td>
                            <td>{{ $entity->entity_name }}</td>
                            <td><img src="{{ asset('images/'.$entity->logo) }}" alt="Logo" width="50"></td>
                            <td><img src="{{ asset('images/'.$entity->stamp) }}" alt="Stamp" width="50"></td>
                            <td>
                                <!-- Add button when click then display modal id editEntityModal -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEntityModal{{$entity->id}}" data-id="{{$entity->id}}">Edit</button>
                                <!-- Click Edit Entity, then display form as popup -->
                                <div class="modal fade" id="editEntityModal{{$entity->id}}" tabindex="-1" aria-labelledby="editEntityModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editEntityModalLabel{{$entity->id}}">Edit Entity</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/admin/setting/'.$entity->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="entity_name" class="form-label">Entity Name</label>
                                                        <input type="text" class="form-control" id="entity_name" name="entity_name" value="{{ $entity->entity_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="logo" class="form-label">Logo</label>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img src="{{ asset('images/'.$entity->logo) }}" alt="Logo" width="50">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="file" class="form-control" id="logo" name="logo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stamp" class="form-label">Stamp</label>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img src="{{ asset('images/'.$entity->stamp) }}" alt="Stamp" width="50">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="file" class="form-control" id="stamp" name="stamp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <form action="{{ url('/admin/setting/'.$entity->id) }}" method="POST" class="d-inline-block form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No records found. Click 'Add New Entity' to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End Entity -->

<!-- Department -->
<div class="card shadow-sm mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Departments</h3>
            </div>
            <div class="col-md-6 text-end">
                <!-- <a href="{{ url('/admin/setting/create') }}" class="btn btn-primary">Add New Department</a> -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Department Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->department_name }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDepartmentModal{{$department->id}}" data-id="{{$department->id}}">Edit</button>
                                <!-- Click Edit Entity, then display form as popup -->
                                <div class="modal fade" id="editDepartmentModal{{$department->id}}" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editDepartmentModalLabel{{$department->id}}">Edit Department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="department_name" class="form-label">Department Name</label>
                                                        <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $department->department_name }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <!-- <form action="{{ url('/admin/setting/'.$department->id) }}" method="POST" class="d-inline-block form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                        <!-- on click button edit, show modal  -->

                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No records found. Click 'Add New Department' to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Department -->

<!-- Approver -->
<div class="card shadow-sm">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Approvers</h3>
            </div>
            <div class="col-md-6 text-end">
                <!-- <a href="{{ url('/admin/setting/create') }}" class="btn btn-primary">Add New Approver</a> -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Entity</th>
                        <th>Approver Name</th>
                        <th>Position</th>
                        <th>Signature</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvers as $approver)
                        <tr>
                            <td>{{ $approver->id }}</td>
                            <td>{{ $approver->entity->entity_name }}</td>
                            <td>{{ $approver->approver_name }}</td>
                            <td>{{ $approver->approver_position }}</td>
                            <td><img src="{{ asset('images/'.$approver->signature) }}" alt="Signature" width="50"></td>
                            <td>

                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editApproverModal{{$approver->id}}" data-id="{{$approver->id}}">Edit</button>
                                <!-- Click Edit Entity, then display form as popup -->
                                <div class="modal fade" id="editApproverModal{{$approver->id}}" tabindex="-1" aria-labelledby="editApproverModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editApproverModalLabel{{$approver->id}}">Edit Approver</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="entity_id" class="form-label">Entity</label>
                                                        <!-- Form select dropdown from entities -->
                                                        <select name="entity_id" id="entity_id" class="form-select">
                                                            @foreach($entities as $entity)
                                                            <option value="{{ $entity->id }}" {{ $entity->id == $approver->entity_id ? "selected" : ""}}>{{ $entity->entity_name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="approver_name" class="form-label">Approver Name</label>
                                                        <input type="text" class="form-control" id="approver_name" name="approver_name" value="{{ $approver->approver_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="approver_position" class="form-label">Approver Position</label>
                                                        <input type="text" class="form-control" id="approver_position" name="approver_position" value="{{ $approver->approver_position }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="logo" class="form-label">Signature</label>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img src="{{ asset('images/'.$approver->signature) }}" alt="Signature" width="50">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="file" class="form-control" id="signature" name="signature">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <form action="{{ url('/admin/setting/'.$approver->id) }}" method="POST" class="d-inline-block form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No records found. Click 'Add New Approver' to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Approver -->

@endsection

@section('script')
<script>
</script>
@endsection
