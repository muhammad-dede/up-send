@extends('layouts.app')

@section('title', 'Detail Absensi')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Absensi /</span> Scan QR Code & Data</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-0 mb-xl-0">
                                <div id="reader" width="600px"></div>
                                <div class="alert alert-primary">
                                    <strong>Lakukan scan QR Code untuk melakukan Absensi!</strong>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-0 mb-xl-0">
                                <h5>Keterangan</h5>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->kelas->kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Matakuliah</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->kelas->matkul->kode }}&nbsp;-&nbsp;{{ $absensi->kelas->matkul->nama }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Semester</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->kelas->semester }}</td>
                                        </tr>
                                        <tr>
                                            <td>SKS</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->kelas->sks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dosen</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->kelas->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pertemuan Ke</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->pertemuan_ke }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Materi Kuliah</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $absensi->materi_kuliah }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-primary mt-3">
                                    <a href="{{ route('export.excel.absensi', $absensi->id) }}"
                                        class="btn btn-sm btn-success">Excel</a>
                                    <a href="{{ route('absensi.index') }}" class="btn btn-sm btn-light mx-2">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">Data Absensi Mahasiswa</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Mahasiswa</th>
                                        <th class="text-center">Jam Masuk</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="absensi_detail">
                                    {{--  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dataTable').DataTable({
                paging: false,
                ordering: false,
                info: false,
            });

            var id_absensi = {{ $absensi->id }};
            var id_kelas = {{ $absensi->id_kelas }};

            absensi_detail();

            function absensi_detail() {
                $.ajax({
                    url: "{{ route('absensi.getAbsensiDetail', $absensi->id) }}",
                    dataType: "html",
                    success: function(response) {
                        $("#absensi_detail").html(response);
                    }
                });
            }

            // Scanning Section
            function onScanSuccess(decodedText, decodedResult) {
                csrf_token = $('meta[name="csrf-token"]').attr("content");
                qr_code = decodedText;

                if (qr_code === null) {
                    qr_code = null;
                } else {
                    $.ajax({
                        url: "{{ route('absensi.scanning') }}",
                        type: "POST",
                        data: {
                            "_method": "POST",
                            "_token": csrf_token,
                            "qr_code": qr_code,
                            'id_absensi': id_absensi,
                            'id_kelas': id_kelas
                        },
                        success: function(response) {
                            if (response.success) {
                                absensi_detail();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.success
                                })
                            }
                            if (response.invalid) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.invalid
                                })
                            }
                            if (response.failed) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.failed
                                })
                            }
                            if (response.not_matched) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.not_matched
                                })
                            }
                        }
                    });
                }
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush
