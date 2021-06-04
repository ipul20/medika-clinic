@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->judul }}</td>
        <td>
            <img src='{{ asset('storage/'.$v->gambar) }}' width='250' height='100' style="object-fit:cover; object-position:center;">
        </td>
        
        <td>{{ $v->keterangan }}</td>
        <td>
            {!! Helper::btn_action($v->id) !!}
        </td>
    </tr>
@endforeach
