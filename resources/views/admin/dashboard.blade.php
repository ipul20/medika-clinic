@extends('admin._layouts.index')

@push('cssScript')
    @include('admin._layouts.css.css')
@endpush

@push('dashboard')
    text-primary
@endpush

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="container">
    <div class="row">
            <!-- card 1 -->
            @if (auth()->user()->role =='admin')    
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                    @php                  
                                        $d = App\Models\User::all()->count();
                                        echo $d;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1 justify-content-center d-flex">
                        <a href="/datauser">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <!-- card 2 -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pasien</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php                  
                                        $d = App\Models\Pasien::all()->count();
                                        echo $d;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1 justify-content-center d-flex">
                        <a href="/datapasien">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <!-- card 3 -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Dokter</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php                  
                                        $d = App\Models\Dokter::all()->count();
                                        echo $d;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-md fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1 justify-content-center d-flex">
                        <a href="/datadokter">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <!-- card 5 -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Poli</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php                  
                                        $d = App\Models\Poli::all()->count();
                                        echo $d;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-plus-square fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1 justify-content-center d-flex">
                        <a href="/datapoli">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            @endif
            <!-- end card -->
            @if (auth()->user()->role =='dokter'||auth()->user()->role =='admin')    
            <!-- card 6 -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Antrian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php
                                        $now = date('Y-m-d');
                                        if(auth()->user()->role =='dokter'){
                                            $username = auth()->user()->username;
                                            $dokter = App\Models\Dokter::where('nip', $username)->first();
                                            $id = $dokter['id'];
                                            $d = App\Models\Reservasi::where([['tanggal',$now],['status',0],['dokter_id',$id]])->count();
                                        }else {
                                            $d = App\Models\Reservasi::where([['tanggal',$now],['status',0]])->count();
                                        }              
                                        echo $d;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1 justify-content-center d-flex">
                        <a href="/daftarreservasi">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            @endif
            <!-- end card -->
        </div>
    </div>
</div>

@endsection

@push('jsScript')
        @include('admin._layouts.js.js')
@endpush
