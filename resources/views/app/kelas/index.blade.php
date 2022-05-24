@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Kelas-Ku /</span> Data</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Kelas Data Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            </div>
            <div class="table-responsive py-3 px-4">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Matakuliah</th>
                            <th>SMST</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>Jml MHS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data_kelas as $kelas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kelas->kelas }}</td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-0"></i>
                                    <strong>{{ $kelas->matkul->kode }} - {{ $kelas->matkul->nama }}</strong>
                                </td>
                                <td>{{ $kelas->semester }}</td>
                                <td>{{ $kelas->sks }}</td>
                                <td>{{ $kelas->user->nama }}</td>
                                <td>{{ $kelas->kelas_detail->count() }}</td>
                                <td>
                                    <a href="{{ route('kelas.edit', $kelas->id) }}"
                                        class="btn btn-sm btn-warning">Ubah</a>
                                    <a href="{{ route('kelas.show', $kelas->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
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
