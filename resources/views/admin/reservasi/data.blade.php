@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->pasien->nama }}</td>
        <td>{{ $v->poli->nama }}</td>
        <td>{{ $v->dokter->nama }}</td>
        <td>{{ $v->dokter->nama . "-" . sprintf("%03d", $v->no_antrian)}}</td>
        <td>{{ $v->jadwal->mulai . " - " . $v->jadwal->selesai }}</td>
        <td>
            @if (auth()->user()->role =='dokter')
            <a href='/pemeriksaan/{{ $v->id }}' class="btn btn-icon btn-primary btn-sm">
                <span class="svg-icon menu-icon">
                    <i class="flaticon-suitcase "></i>
                </span>
            </a> 
            @endif
            @if (auth()->user()->role =='admin')
            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $v->id }}"
               title="Delete" class="btn btn-icon btn-danger btn-sm deleteData">
                <span class="svg-icon menu-icon">
                    <i class="flaticon2-delete"></i>
                </span>
            </a>
            @endif
        </td>
    </tr>
@endforeach
