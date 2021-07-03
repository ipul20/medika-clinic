@foreach ($data as $key => $v)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->tanggal }}</td>
        <td>@php
            date('h:i',$v->created_at)
        @endphp</td>
        <td>{{ $v->pasien->nama }}</td>
        <td>{{ $v->keluhan }}</td>
        <td>{{ $v->poli->nama }}</td>
        <td>{{ $v->diagnosa }}</td>
        <td>@php                  
            $d = App\Models\Resep::where('pemeriksaan_id',$v->id)->get();
            foreach ($d as $d) {
              echo "- ".$d->obat." ".$d->aturan."<br>";
            }   
          @endphp</td>
        <td>{{ $v->dokter->nama }}</td>
    </tr>
@endforeach
