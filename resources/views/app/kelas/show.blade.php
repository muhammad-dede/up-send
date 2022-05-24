@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Kelas /</span> Detail Kelas-Ku</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Kelas-Ku</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 mb-0 mb-xl-0">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $kelas->kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Matakuliah</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $kelas->matkul ? $kelas->matkul->kode : '-' }}&nbsp;-&nbsp;{{ $kelas->matkul ? $kelas->matkul->nama : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Semester</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $kelas->semester }}</td>
                                        </tr>
                                        <tr>
                                            <td>SKS</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $kelas->sks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dosen</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $kelas->user ? $kelas->user->nama : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-3 mb-0 mb-xl-0">
                                <img src="{{ asset('') }}/public/template/assets/img/illustrations/man-with-laptop-light.png"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">Data Mahasiswa</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Mahasiswa</th>
                                        <th class="text-center">Aktif</th>
                                        <th class="text-center">QR Code</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas->kelas_detail as $kelas_detail)
                                        <tr class="{{ $kelas_detail->aktif == 'N' ? 'text-danger' : '' }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <span>{{ $kelas_detail->mahasiswa ? $kelas_detail->mahasiswa->npm : '-' }}</span>
                                                &nbsp;-&nbsp;
                                                <span>{{ $kelas_detail->mahasiswa ? $kelas_detail->mahasiswa->nama : '-' }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $kelas_detail->aktif == 'Y' ? 'Ya' : 'Tidak' }}
                                            </td>
                                            <td>
                                                <div class="visible-print text-center">
                                                    @if ($kelas_detail->qr_code)
                                                        {!! QrCode::size(50)->generate($kelas_detail->qr_code) !!}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($kelas_detail->qr_code)
                                                    <a href="{{ route('kelas.cetak', $kelas_detail->qr_code) }}"
                                                        class="btn btn-sm btn-primary" target="_blank">Cetak QR Code</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
            $('#dataTable').DataTable({
                paging: false,
                ordering: false,
                info: false,
            });
        });
    </script>
@endpush
