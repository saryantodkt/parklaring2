@extends('layouts.admin')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Parklaring Data</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ url('/admin/parklaring/create') }}" class="btn btn-primary">Add New Record</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Template</th>
                        <th>Document No</th>
                        <th>Employee Name</th>
                        <th>Last Position</th>
                        <th>Department</th>
                        <th>Entity</th>
                        <th>Date Approved</th>
                        <th>Publish</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parklarings as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->template->template_name }}</td>
                            <td>{{ $item->document_no }}</td>
                            <td>{{ $item->employee_name }}</td>
                            <td>{{ $item->last_position }}</td>
                            <td>{{ $item->department->department_name }}</td>
                            <td>{{ $item->entity->entity_name }}</td>
                            <td>{{ $item->date_approved }}</td>
                            <td>
                                @if($item->publish == 1)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-danger">Not Published</span>
                                @endif
                            </td>
                            <td>
                                @if($item->publish == 1)
                                    <a href="{{ url('/'.$item->unique_code) }}" target="_blank" class="btn btn-sm btn-info text-white">View</a>
                                @else
                                    <button class="btn btn-sm btn-secondary text-white" disabled>View</button>
                                @endif
                                
                                <a href="{{ url('/admin/parklaring/'.$item->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                @if($item->publish == 1)
                                @else
                                    <form action="{{ url('/admin/parklaring/'.$item->id) }}" method="POST" class="d-inline-block form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                </form>
                                @endif
                                
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No records found. Click 'Add New Record' to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $parklarings->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record? Process will be canceled if No.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, continue',
                cancelButtonText: 'No, cancel it'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
