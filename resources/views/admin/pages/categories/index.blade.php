@extends('layouts.admin')
@section('title', 'Admin || Categories')
@section('main-content')
    <div class="container-fluid pt-4 px-4" style="color: var(--light)">
        <div class="">
            <div class="bg-secondary rounded table-responsive">
                <table id="cat-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>is Main Category</th>
                            <th>Main Category</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                {{-- name --}}
                                <td>{{ $category->name }}</td>
                                {{-- status --}}
                                <td>
                                    @if ($category->status == 'active')
                                        <span class="b-success">{{ $category->status }}</span>
                                    @else
                                        <span class="b-warning">{{ $category->status }}</span>
                                    @endif
                                </td>
                                {{-- description --}}
                                <td>
                                    {!! strlen($category->description) > 200
                                        ? substr($category->description, 0, 200) . '.....'
                                        : $category->description !!}
                                </td>
                                {{-- is main category --}}
                                <td>{{ $category->is_parent == 1 ? 'Yes' : 'No' }}</td>
                                {{-- main category --}}
                                <td>
                                    {{ $category->parent_info->name ?? 'N/A' }}
                                </td>
                                {{-- image --}}
                                <td>
                                    @if ($category->image)
                                        <img style="max-width: 100px;" src="{{ $category->image }}"
                                            alt="{{ $category->name }}">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- actions --}}
                                <td style="vertical-align: middle;">
                                    <div tyle="display: flex; justify-content: center; align-items: center;">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-info btn-sm  m-1 p-1 "
                                            style="height:30px; width:50px;border-radius:10px;"><i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm dltBtn m-1 p-1"
                                            data-category-id="{{ $category->id }}"
                                            style="height:30px; width:50px;border-radius:10px;">
                                            <i class="fas fa-trash-alt"></i></button>
                                        {{-- <form method="POST" action="{{ route('categories.destroy', $category->id) }}"
                                            data-category-id="{{ $category->id }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn m-1 p-1"
                                                style="height:30px; width:50px;border-radius:10px;">
                                                <i class="fas fa-trash-alt"></i></button>
                                        </form> --}}
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
        let table = $('#cat-table').DataTable({
            lengthMenu: [
                [15, 30, 50, -1],
                [15, 30, 50, "All"]
            ],
        })

        $(document).ready(function() {
            $('.dltBtn').click(function(e) {
                e.preventDefault();

                let id = $(this).data('category-id');

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

                        var url = '{{ url('admin/dashboard/category/delete') }}' + '/' + id;

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
