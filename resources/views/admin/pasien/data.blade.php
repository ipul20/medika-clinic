@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->no_regis }}</td>
        <td>{{ $v->nik }}</td>
        <td>{{ $v->nama }}</td>
        <td>{{ $v->tanggal_lahir }}</td>
        <td>{{ $v->alamat }}</td>
        <td>
            {!! Helper::btn_action($v->id) !!}
        </td>
    </tr>
@endforeach
