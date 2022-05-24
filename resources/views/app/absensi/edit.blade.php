@extends('layouts.app')

@section('title', 'Ubah Absensi Kelas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Absensi Kelas /</span> Ubah</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Form Ubah Absensi Kelas</h5>
                    <div class="card-body">
                        <form action="{{ route('absensi.update', $absensi->id) }}" method="POST" class="form_ubah_absensi"
                            id="form_ubah_absensi">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select @error('id_kelas') is-invalid @enderror select2" id="id_kelas"
                                    aria-label="Pilih Kelas" name="id_kelas">
                                    <option value="" selected>Pilih</option>
                                    @foreach (get_kelas_user(auth()->id()) as $kelas)
                                        <option value="{{ $kelas->id }}"
                                            {{ old('id_kelas') ?? $absensi->id_kelas == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->matkul->kode }} - {{ $kelas->matkul->nama }}
                                            | {{ $kelas->kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p>
                                    <small>
                                        Jika kelas tidak ada, Anda dapat menambahkannya
                                        <a href="{{ route('kelas.create') }}" target="_blank"
                                            class="text-primary"><strong>disini</strong></a> dan lakukan refresh.
                                    </small>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="pertemuan_ke" class="form-label">Pertemuan Ke</label>
                                <input type="number" class="form-control @error('pertemuan_ke') is-invalid @enderror"
                                    id="pertemuan_ke" placeholder="Contoh: 2"
                                    value="{{ $absensi->pertemuan_ke ?? old('pertemuan_ke') }}" name="pertemuan_ke" />
                                @error('pertemuan_ke')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                    value="{{ $absensi->tanggal ?? old('tanggal') }}" name="tanggal" />
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="materi_kuliah" class="form-label">Materi Kuliah</label>
                                <textarea class="form-control @error('tanggal') is-invalid @enderror" name="materi_kuliah" id="materi_kuliah" cols="30"
                                    rows="3">{{ $absensi->materi_kuliah ?? old('materi_kuliah') }}</textarea>
                                @error('materi_kuliah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2 btn_simpan">Simpan</button>
                                <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap-5",
            });
        });
    </script>
@endpush
