@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">User /</span> Data User</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- User Data Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            </div>
            <div class="table-responsive py-3 px-4">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('') }}public/assets/image/user-avatar/{{ $user->avatar }}"
                                        class="rounded-circle" style="width: 35px;" />
                                </td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-0"></i>
                                    <strong>{{ $user->nama }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Ubah</a>
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
