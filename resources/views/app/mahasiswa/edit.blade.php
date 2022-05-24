@extends('layouts.app')

@section('title', 'Ubah Mahasiswa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Mahasiswa /</span> Ubah Mahasiswa</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Form Ubah Mahasiswa</h5>
                    <div class="card-body">
                        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm"
                                    placeholder="11111111111" value="{{ $mahasiswa->npm ?? old('npm') }}" name="npm" />
                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="John Doe" value="{{ $mahasiswa->nama ?? old('nama') }}" name="nama" />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jk') is-invalid @enderror" id="jk"
                                    aria-label="Pilih Jenis Kelamin" name="jk">
                                    <option value="">Pilih</option>
                                    <option value="L" {{ $mahasiswa->jk == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $mahasiswa->jk == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('jk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
