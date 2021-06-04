@extends('admin._layouts.index')

@push('cssScript')
    @include('admin._layouts.css.css')
@endpush

@push('data-master')
    menu-item-open menu-item-here
@endpush

@push('aktif-user-setting')
    text-primary
@endpush


@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tables</h5>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <span class="text-muted font-weight-bold mr-4">Data</span>
                    <!--end::Actions-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::List Widget 8-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-1">
                                <h3 class="card-title font-weight-bolder text-dark">
                                    {{ Helper::head($title) }}
                                </h3>
                                <div class="card-toolbar">
                                    <div class="example-tools justify-content-center">
                                        {!! Helper::btn_create() !!}
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Item-->
                                <div class="mb-1">
                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group" role="group">
                                            <select class="form-control" style="" name="" id="jumlah">
                                                <option selected="selected">5</option>
                                                <option> 10</option>
                                                <option> 25</option>
                                                <option> 50</option>
                                                <option> 100</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-icon input-icon-right">
                                                <input type="text" name="" placeholder="Search..."
                                                       class="form-control" id="pencarian">
                                                <span><i class="flaticon2-search-1 icon-md"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="8%">No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th scope="col" width="12%">Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody class="datatabel">
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex flex-wrap py-2 mr-3">
                                                <div class="text-center pagination">
                                                    <div id="contentx"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center py-3">
                                                <ul class="pagination twbs-pagination">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end: Card-->
                        <!--end::List Widget 8-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    @include('admin.'.$title.'._form')

@endsection

@push('jsScript')
    @include('admin._layouts.js.js')

    <script type="text/javascript">

        $(document).ready(function () {

            loadpage('',5);

            var $pagination = $('.twbs-pagination');
            var defaultOpts = {
                totalPages: 1,
                prev: '&#8672;',
                next: '&#8674;',
                first: '&#8676;',
                last: '&#8677;',
            };
            $pagination.twbsPagination(defaultOpts);

            function loaddata(page, cari, jml) {
                $.ajax({
                    url: '{{route($title.'.data')}}',
                    data: { "page": page, "cari": cari, "jml": jml },
                    type: "GET",
                    datatype: "json",
                    success: function (data) {
                        $(".datatabel").html(data.html);
                    }
                });
            }

            function loadpage(cari, jml) {
                $.ajax({
                    url: '{{route($title.'.data')}}',
                    data: { "cari": cari, "jml": jml },
                    type: "GET",
                    datatype: "json",
                    success: function (response) {
                        console.log(response);
                        if ($pagination.data("twbs-pagination")) {
                            $pagination.twbsPagination('destroy');
                            $(".datatabel").html('<tr><td colspan="8">Data not found</td></tr>');
                        }
                        $pagination.twbsPagination($.extend({}, defaultOpts, {
                            startPage: 1,
                            totalPages: response.total_page,
                            visiblePages: 8,
                            prev: '&#8672;',
                            next: '&#8674;',
                            first: '&#8676;',
                            last: '&#8677;',
                            onPageClick: function (event, page) {
                                if(page == 1){
                                    var to = 1;
                                }else{
                                    var to = page * jml - (jml -1);
                                }
                                if(page == response.total_page){
                                    var end = response.total_data;
                                }else{
                                    var end = page * jml;
                                }
                                $('#contentx').text('Showing '+to+' to '+end+' of '+
                                    response.total_data +' entries');
                                loaddata(page, cari, jml);
                            }
                        }));
                    }
                });
            }

            // $("#pencarian, #show").keyup(function (event) {
            $("#pencarian, #jumlah").on('keyup change',function (event) {
                let cari = $('#pencarian').val();
                let jml = $('#jumlah').val();
                loadpage(cari, jml);
            });

            // proses simpan
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route($title.'.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#formInput').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        loadpage('',5);
                        toastr.success("Successful save data!");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#formInput').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        toastr.danger("Failed to save data!");
                    }
                });
            });

            // proses update
            $('#updateBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#formInput').serialize(),
                    url: "{{ route($title.'.update') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#formInput').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        loadpage('',5);
                        toastr.success("Successful update data!");
                    },
                    error: function (data) {
                        $('#formInput').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        toastr.danger("Failed to update data!");
                    }
                });
            });

            $('body').on('click', '.deleteData', function () {
                var id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure to Delete?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url($title) }}" + '/delete/' + id,
                            success: function (data) {
                                loadpage('',5);
                                toastr.success("Successful delete data!");
                            },
                            error: function (data) {
                                toastr.success("Failed delete data!");
                            }
                        });
                    }
                });
            });

        });

    </script>

@endpush
