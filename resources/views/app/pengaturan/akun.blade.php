@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Pengaturan Akun /</span> Akun</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Akun</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('') }}public/assets/image/user-avatar/{{ auth()->user()->avatar }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Ubah</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    {{-- <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" name="avatar" /> --}}
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1024K</p>
                            </div>
                        </div>
                        @error('avatar')
                            <p class="text-danger">
                                <small>{{ $message }}</small>
                            </p>
                        @enderror
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('pengaturan.akun.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"
                                name="avatar" />
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama"
                                        name="nama" value="{{ auth()->user()->nama ?? old('nama') }}" autofocus />
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text" id="email"
                                        name="email" value="{{ auth()->user()->email ?? old('email') }}"
                                        placeholder="john.doe@example.com" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Ubah Password <small
                                            class="text-danger">(Abaikan jika tidak
                                            ingin diubah)</small></label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        id="password" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password
                                        Baru <small class="text-danger">(Abaikan jika tidak
                                            ingin diubah)</small></label>
                                    <input class="form-control" type="password" id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('') }}public/template/assets/js/pages-account-settings-account.js"></script>
@endpush
