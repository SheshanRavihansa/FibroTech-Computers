@extends('layouts.admin')
@section('title', 'Admin || Brands')
@section('main-content')
    <div class="container-fluid pt-4 px-4" style="color: var(--light)">
        <div class="">
            <div class="bg-secondary rounded table-responsive">
                <table id="brand-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if ($brand->status == 'active')
                                        <span class="b-success">{{ $brand->status }}</span>
                                    @else
                                        <span class="b-warning">{{ $brand->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <a href="{{ route('brand.edit', $brand->id) }}"
                                            class="btn btn-info btn-sm  m-1 p-1 "
                                            style="height:30px; width:50px;border-radius:10px;"><i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm dltBtn m-1 p-1"
                                            data-brand-id="{{ $brand->id }}"
                                            style="height:30px; width:50px;border-radius:10px;">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <style>
        .dataTables_wrapper {
            height: 100%;
            padding: 2rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        let table = $('#brand-table').DataTable({
            lengthMenu: [
                [15, 30, 50, -1],
                [15, 30, 50, "All"]
            ],
        })

        $(document).ready(function() {
            $('.dltBtn').click(function(e) {
                e.preventDefault();

                let id = $(this).data('brand-id');

                Swal.fire({
                    title: 'DELETE?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var url = '{{ url('admin/dashboard/brand/delete') }}' + '/' + id;

                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _method: 'DELETE', // Use the DELETE method (POST with '_method' field)
                                _token: '{{ csrf_token() }}' // Include the CSRF token
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )
                                window.location.reload()
                            },
                            error: function(response) {
                                Swal.fire(
                                    'error!',
                                    response.message,
                                    'error'
                                )
                                console.log(response);
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
