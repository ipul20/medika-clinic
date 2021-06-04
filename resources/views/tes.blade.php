@extends('admin._layouts.index')
@push('cssScript')
    @include('admin._layouts.css.css')
@endpush
@section('content')
<table border="1">
    <tr>
        <td>nama</td>
        <td>jenis kelamin</td>
        <td>Tanggal lahir</td>
    </tr>
</table>
@endsection
@push('jsScript')
@include('admin._layouts.js.js')

<script>
        $('#saveBtn').click(function (e) {
        e.preventDefault();
        db.collection("atrian").doc("222").set({
               
                    noantrian : $('#nama').val(),
                    status : true,
               
        })
        .then(() => {
            console.log("Document successfully written!");
        })
        .catch((error) => {
            console.error("Error writing document: ", error);
        });
    })
    
</script>
@endpush