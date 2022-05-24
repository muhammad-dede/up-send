@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Mahasiswa /</span> Data Mahasiswa</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Mahasiswa Data Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            </div>
            <div class="table-responsive py-3 px-4">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data_mahasiswa as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-0"></i>
                                    <strong>{{ $mahasiswa->npm }}</strong>
                                </td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->jk }}</td>
                                <td>
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                                        class="btn btn-sm btn-warning">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ User Data Table -->
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
