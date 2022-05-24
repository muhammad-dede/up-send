@forelse ($data as $absensi_detail)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>
            <span>{{ $absensi_detail->mahasiswa->npm }}</span>
            &nbsp;-&nbsp;
            <span>{{ $absensi_detail->mahasiswa->nama }}</span>
        </td>
        <td class="text-center">
            {{ $absensi_detail->jam_masuk }}
        </td>
        <td class="text-center">
            {{ $absensi_detail->keterangan }}
        </td>
        <td class="text-center">
            <form id="form-delete-detail" action="{{ route('absensi.destroy.detail', $absensi_detail->id) }}"
                method="POST">
                @csrf
                @method('delete')
                <button id="btn-delete-detail" class="btn btn-danger btn-sm" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No data available in table.</td>
    </tr>
@endforelse
