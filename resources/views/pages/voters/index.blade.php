@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('voter.index') }}">Voter</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Voter</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Voter</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('voter.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Phone</th>
                                    <th>Candidate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voters as $voter)
                                    <tr>
                                        <td>
                                            {{ $voter->name }}
                                        </td>
                                        <td>
                                            {{ $voter->slug }}
                                        </td>
                                        <td>
                                            {{ $voter->phone }}
                                        </td>
                                        <td>
                                            @if (isset($voter->candidate->name))
                                                {{ $voter->candidate->name }}
                                            @else
                                                {!! '<span class="badge rounded-pill bg-danger">-</span>' !!}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('voter.edit', $voter->id) }}">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                </a>
                                                <a onclick="del({{ $voter->id }})" href="#">
                                                    <i class="link-icon text-danger" data-feather="trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        function del(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('voter.store') }}" + "/" + id,
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                data.msg,
                                'success'
                            ).then((result) => {
                                window.location.href = "{{ route('voter.index') }}"
                            })
                        },
                    })
                }
            })
        }
    </script>
@endpush
