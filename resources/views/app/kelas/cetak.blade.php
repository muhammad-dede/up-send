<!DOCTYPE html>
<html>

<head>
    <title>Cetak QR-Code | {{ config('app.name') }}</title>
</head>

<body>

    <div class="visible-print text-center">
        <h1>{{ $kelas_detail->kelas ? $kelas_detail->kelas->matkul->nama : '-' }}</h1>

        {!! QrCode::size(250)->generate($kelas_detail->qr_code) !!}

        <p>{{ $kelas_detail->mahasiswa ? $kelas_detail->mahasiswa->npm : '-' }} -
            {{ $kelas_detail->mahasiswa ? $kelas_detail->mahasiswa->nama : '-' }}</p>
    </div>

</body>

</html>
