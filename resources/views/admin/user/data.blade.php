@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->name}}</td>
        <td>{{ $v->username }}</td>
        <td>{{ $v->role}}</td>
        <td>
            {!! Helper::btn_action($v->id) !!}
        </td>
    </tr>
@endforeach
