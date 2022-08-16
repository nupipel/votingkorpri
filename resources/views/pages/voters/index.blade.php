@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
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
                                            {{ $voter->candidate ?? 'Belum Memilih' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('voter.edit', $voter->id) }}">
                                                Edit
                                            </a>
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
@endpush
