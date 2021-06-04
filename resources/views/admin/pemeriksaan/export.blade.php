<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>

    <style type="text/css">
        body {
            font-family: Arial;

        }

        td {
            padding-left: 2px;
            padding-right: 2px;
        }

        table {}
    </style>
</head>
<body>
    <table border="1" cellspacing=0 width=100%>
            <head>

                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Resep</th>
                    <th>Dokter</th>
                </tr>
            </head>
            @foreach ($data as $key => $v)
                <tr>
                    <td style='width:3%'>
                        {{ ++$key }}
                    </td>
                    <td style='width:12%'>{{ $v->tanggal }}</td>
                    <td style='width:16%'>{{ $v->pasien->nama }}</td>
                    <td style='width:13%'>{{ $v->keluhan }}</td>
                    <td>{{ $v->diagnosa }}</td>
                    <td style='width:25%'>@php                  
                        $d = App\Models\Resep::where('pemeriksaan_id',$v->id)->get();
                        foreach ($d as $d) {
                        echo "- ".$d->obat." ".$d->aturan."<br>";
                        }   
                    @endphp</td>
                    <td style='width:15%'>{{ $v->dokter->nama }}</td>
                </tr>
            @endforeach
    </table>
</body>
</html>