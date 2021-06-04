@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->nip}}</td>
        <td>{{ $v->nama }}</td>
        <td>{{ $v->poli->nama}}</td>
        <td>{!! Helper::cekNull($v->alamat) !!}</td>
        <td>{!! Helper::cekNull($v->nohp) !!}</td>
        <td>{!! Helper::cekStatus($v->status) !!}</td>
        {{-- <td>
            @php
                $jadwal = Helper::get_data_where('jadwal','dokter_id',$v->id)
            @endphp
            @foreach ($jadwal as $d)
            {{ $d->mulai}}-{{ $d->selesai }} <br>
            @endforeach
        </td> --}}
        <td>
            {!! Helper::btn_aktif($v->status,$v->id) !!}
            {!! Helper::btn_action($v->id) !!}
        </td>
    </tr>
@endforeach
