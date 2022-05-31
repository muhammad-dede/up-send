@extends('layouts.app')

@section('title', 'Data Absensi')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Absensi /</span> Data</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            </div>
            <div class="table-responsive py-3 px-4">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Matakuliah</th>
                            <th>Pertemuan Ke</th>
                            <th>Tanggal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data_absensi as $absensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $absensi->kelas->kelas }}</td>
                                <td>
                                    {{ $absensi->kelas->matkul->kode }} -
                                    {{ $absensi->kelas->matkul->nama }}
                                </td>
                                <td>{{ $absensi->pertemuan_ke }}</td>
                                <td>{{ date('d-m-Y', strtotime($absensi->tanggal)) }}</td>
                                <td>
                                    <a href="{{ route('absensi.edit', $absensi->id) }}"
                                        class="btn btn-sm btn-warning">Ubah</a>
                                    <a href="{{ route('absensi.show', $absensi->id) }}"
                                        class="btn btn-sm btn-info">Absensi</a>
                                    <form class="d-inline" action="{{ route('absensi.destroy', $absensi->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
