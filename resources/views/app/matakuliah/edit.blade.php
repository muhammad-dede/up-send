@extends('layouts.app')

@section('title', 'Ubah Matakuliah')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Matakuliah /</span> Ubah Matakuliah</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Form Ubah Matakuliah</h5>
                    <div class="card-body">
                        <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode"
                                    placeholder="FT1111" value="{{ $matakuliah->kode ?? old('kode') }}" name="kode" />
                                @error('kode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="John Doe" value="{{ $matakuliah->nama ?? old('nama') }}" name="nama" />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
