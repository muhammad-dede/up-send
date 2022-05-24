<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Jam Masuk</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absensi_detail as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>'{{ $data->mahasiswa->npm }}</td>
                <td>{{ $data->mahasiswa->nama }}</td>
                <td>{{ $data->jam_masuk }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
