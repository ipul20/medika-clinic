@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css')
@endpush

@push('setting')
    menu-item-open menu-item-here
@endpush


@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-1">
                        <h3 class="card-title font-weight-bolder text-dark">
                            Daftar Antrian Berjalan
                        </h3>
                    </div>
                <div class="card-body">
                    @if (count($jadwal)>0)
                        <div class="row">
                        @foreach($jadwal as $data => $v)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-header p-2">
                                    <span class="justify-content-center d-flex">
                                        {{ 'Poliklinik '.$v->dokter->poli->nama }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 justify-content-center d-flex">

                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 justify-content-center d-flex">
                                                {{ $v->dokter->nama." - " }}
                                                <span id="noantrian{{ $v->dokter_id }}"> </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-1 justify-content-center d-flex">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $v->dokter_id }}" class="antrianselanjutnya">No Selanjutnya<i class="fa fa-arrow-circle-right ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    @else
                        <h3>Antrian Belum Berjalan</h3>
                    @endif
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('jsScript')
@include('admin._layouts.js.js')
<script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-firestore.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyB7hFgej7jCx0cQoaPbe4YvyexbVmcS4WQ",
        authDomain: "azzahra-klinik.firebaseapp.com",
        projectId: "azzahra-klinik",
        storageBucket: "azzahra-klinik.appspot.com",
        messagingSenderId: "172888003178",
        appId: "1:172888003178:web:dec124d9d506bf50ccf013"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    var db = firebase.firestore();

    @foreach($jadwal as $data)

    var c{{ $data->dokter_id }} = '#noantrian' + {{ $data->dokter_id }};
    var dataantrian{{ $data->dokter_id }};
    db.collection("antrian").doc("{{ $data->dokter_id }}")
        .onSnapshot((doc) => {
            dataantrian = doc.data();
            $(c{{ $data->dokter_id }}).html(dataantrian['no'])
            console.log(dataantrian['no']);
        });
    @endforeach
    //   var ref= db.collection('atrian').doc('1');
    //   ref.on('value',showData, showError);


    //   function showData(items){
    //     console.log(items);
    //   }

    //   function showError(items){
    //       console.log(items);
    //   }
    //   db.collection("atrian").get().then((querySnapshot) => {
    //     querySnapshot.forEach((doc) => {
    //         console.log(`${doc.id} => ${doc.data()}`);
    //     });
    // });

    $(document).ready(function() {
        $('body').on('click', '.antrianselanjutnya', function() {
            var id = $(this).data("id");
            Swal.fire({
                title: "Yakin ingin ke No antrian Selanjutnya",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: '/noselanjutnya/' + id,
                    });
                }
            });
        });

    });
</script>
@endpush