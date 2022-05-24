@extends('layouts.app')

@section('title', 'Scan QR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Scan QR /</span> Scan QR Code</h4>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div id="reader" width="600px"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Hasil Scan</h5>
                                    <table>
                                        <tbody id="result">
                                            {{--  --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="card-img card-img-right"
                                    src="{{ asset('') }}/public/template/assets/img/illustrations/man-with-laptop-light.png"
                                    alt="Card image" />
                            </div>
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

            empty_table();

            function empty_table() {
                $(".mahasiswa").remove();
                html = '<tr class="mahasiswa">';
                html +=
                    '<td colspan="5" class="text-center">Tidak ada data.</td>';
                html += '</tr>';
                $("#result").html(html);
            }

            function onScanSuccess(decodedText, decodedResult) {
                empty_table();

                csrf_token = $('meta[name="csrf-token"]').attr("content");
                qr_code = decodedText;

                if (qr_code === null) {
                    qr_code = null;
                } else {
                    $.ajax({
                        url: "{{ route('scan.search') }}",
                        type: "POST",
                        data: {
                            "_method": "POST",
                            "_token": csrf_token,
                            "qr_code": qr_code
                        },
                        success: function(response) {
                            if (response.kelas_detail) {
                                $(".mahasiswa").remove();
                                html =
                                    '<tr class="mahasiswa"><td>NPM</td><td>:</td><td>' + response
                                    .kelas_detail.mahasiswa.npm +
                                    '</td></tr>';
                                html +=
                                    '<tr class="mahasiswa"><td>Nama</td><td>:</td><td>' + response
                                    .kelas_detail.mahasiswa.nama +
                                    '</td></tr>';
                                html +=
                                    '<tr class="mahasiswa"><td>Jenis Kelamin</td><td>:</td><td>' +
                                    response
                                    .kelas_detail.mahasiswa.jk +
                                    '</td></tr>';
                                html +=
                                    '<tr class="mahasiswa"><td>Matakuliah</td><td>:</td><td>' + response
                                    .kelas.matkul.nama +
                                    '</td></tr>';
                                html +=
                                    '<tr class="mahasiswa"><td>Dosen Pengajar</td><td>:</td><td>' +
                                    response
                                    .kelas.user.nama +
                                    '</td></tr>';
                                $("#result").append(html);
                            } else {
                                $(".mahasiswa").remove();
                                html = '<tr class="mahasiswa">';
                                html +=
                                    '<td colspan="5" class="text-center text-danger">' + response
                                    .failed + '</td>';
                                html += '</tr>';
                                $("#result").append(html);
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
