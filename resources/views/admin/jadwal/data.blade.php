@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->dokter->nama}}</td>
        <td>{{ $v->sesi }}</td>
        <td>{{ $v->mulai }}</td>
        <td>{{ $v->selesai }}</td>
        <td>
            {!! Helper::btn_action($v->id) !!}
        </td>
    </tr>
@endforeach
