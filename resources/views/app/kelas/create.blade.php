@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Kelas-Ku /</span> Tambah</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Form Tambah Kelas</h5>
                    <div class="card-body">
                        <form action="{{ route('kelas.store') }}" method="POST" class="form_tambah_kelas"
                            id="form_tambah_kelas">
                            @csrf
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                    placeholder="Contoh: Teknik Industri(S-1) Siang-2-01" value="{{ old('kelas') }}"
                                    name="kelas" />
                            </div>
                            <div class="mb-3">
                                <label for="id_matkul" class="form-label">Matakuliah</label>
                                <select class="form-select @error('id_matkul') is-invalid @enderror select2" id="id_matkul"
                                    aria-label="Pilih Matakuliah" name="id_matkul">
                                    <option value="" selected>Pilih</option>
                                    @foreach (get_matakuliah() as $matkul)
                                        <option value="{{ $matkul->id }}"
                                            {{ old('id_matkul') == $matkul->id ? 'selected' : '' }}>
                                            {{ $matkul->kode }} - {{ $matkul->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <p>
                                    <small>
                                        Jika matakuliah tidak ada, Anda dapat menambahkannya
                                        <a href="{{ route('matakuliah.create') }}" target="_blank"
                                            class="text-primary"><strong>disini</strong></a> dan lakukan refresh.
                                    </small>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" class="form-control @error('semester') is-invalid @enderror"
                                    id="semester" placeholder="Contoh: 2" value="{{ old('semester') }}" name="semester" />
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks"
                                    placeholder="Contoh: 2" value="{{ old('sks') }}" name="sks" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data Mahasiswa</label>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NPM</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data_mahasiswa">
                                            {{--  --}}
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-sm btn-primary mt-3 mb-2 btn_tambah_mahasiswa"
                                    id="btn_tambah_mahasiswa">Tambah</button>
                                <p><small>Klik tombol tambah untuk menambahkan data
                                        mahasiswa!</small></p>
                            </div>
                            <hr>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2 btn_simpan">Simpan</button>
                                <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary">Kembali</a>
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

            var count_data_mahasiswa = 0;

            data_mahasiswa(count_data_mahasiswa);

            function data_mahasiswa(number) {
                if (number > 0) {
                    html = '<tr>';
                    html += '<td><input type="text" name="npm[]" class="form-control" /></td>';
                    html += '<td><input type="text" name="nama[]" class="form-control" /></td>';
                    html +=
                        '<td><select name="jenis_kelamin[]" class="form-select"><option value=""></option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></td>';
                    html +=
                        '<td><select name="aktif[]" class="form-select"><option value="N">Tidak</option><option value="Y">Ya</option></select></td>';
                    html +=
                        '<td><button type="button" id="btn_hapus_mahasiswa" class="btn btn-sm btn-danger btn_hapus_mahasiswa">Hapus</button></td>';
                    html += '</tr>';
                    $('.data_mahasiswa').append(html);
                } else {
                    html = '<tr id="id_mahasiswa">';
                    html +=
                        '<td colspan="5" class="text-center">Tidak ada data.</td>';
                    html += '</tr>';
                    $('.data_mahasiswa').html(html);
                }
            }

            $(document).on('click', '.btn_tambah_mahasiswa', function(event) {
                event.preventDefault();
                $('#id_mahasiswa').remove();
                count_data_mahasiswa++;
                data_mahasiswa(count_data_mahasiswa);
            });

            $(document).on('click', '.btn_hapus_mahasiswa', function() {
                event.preventDefault();
                count_data_mahasiswa--;
                $(this).closest("tr").remove();
                if (count_data_mahasiswa == 0) {
                    html = '<tr id="id_mahasiswa">';
                    html +=
                        '<td colspan="5" class="text-center">Tidak ada data.</td>';
                    html += '</tr>';
                    $('.data_mahasiswa').html(html);
                }
            });

            $('.form_tambah_kelas').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: $('input[name=_method]').val() == undefined ? 'POST' : 'POST',
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('.text_error').text('');
                        $('.btn_simpan').attr('disabled', 'disabled');
                    },
                    success: function(response) {
                        if (response.error) {
                            $.each(response.error, function(key, val) {
                                if (key.indexOf(".") != -1) {
                                    var arr = key.split(".");
                                    name = $("[name='" + arr[0] + "[]']:eq(" + arr[
                                        1] + ")");
                                } else {
                                    var name = $('[name=' + key + ']');
                                }
                                name.parent().append(
                                    '<small class="text-danger text_error">' + val[
                                        0] + '</small>');
                                $('html, body').animate({
                                    scrollTop: name.offset().top - 200
                                }, 'slow');
                                return false;
                            });
                        } else if (response.success) {
                            form.unbind().submit();
                        }
                        $('.btn_simpan').removeAttr('disabled', 'disabled');
                    },
                    error: function(jqXHR, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Error!',
                            text: thrownError,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        })
                    }
                });
            });
        });
    </script>
@endpush
