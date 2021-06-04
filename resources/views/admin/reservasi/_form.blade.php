<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <label id="headForm"></label> {{ Helper::head($title) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="formInput" name="formInput" class="form" action="">
                @csrf
                <input type="hidden" name="id" id="formId">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Nama Pasien</label>
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 ">
                                    <select class="form-control select2" id="kt_select2_1" name="pasien_id"
                                            style="width:100%">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach(Helper::get_data('pasien') as $v)
                                        <option value="{{$v->id}}">{{$v->no_regis . " " . $v->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Poliklinik</label>
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 ">
                                    <select class="form-control select2" id="kt_select2_2" name="poli_id"
                                            style="width:100%" onchange="poli()">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach(Helper::get_data('poli') as $v)
                                        <option value="{{$v->id}}">{{$v->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Keluhan</label>
                            <input type="text" class="form-control" name="keluhan" id="keluhan" required />
                        </div>
                        <div class="col-lg-6">
                            <label>Dokter</label>
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 ">
                                    <select class="form-control select2" id="kt_select2_3" name="dokter_id"
                                            style="width:100%" onchange="jadwal()" required>
                                        <option value="" selected disabled hidden>Choose here</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>jadwal</label>
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 ">
                                    <select class="form-control select2" id="kt_select2_4" name="jadwal_id"
                                            style="width:100%" required>
                                        <option value="" selected disabled hidden>Choose here</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="saveBtn" value="create">Save</button>
                    <button type="submit" class="btn btn-success" id="updateBtn" value="update">Update</button>
                </div>
            </form>


        </div>
    </div>
</div>


@push('jsScriptAjax')
    <script type="text/javascript">

        //Tampilkan form input
        function createForm() {
            $("#headForm").empty();
            $("#headForm").append("Form Input");
            $('#saveBtn').show();
            $('#updateBtn').hide();
            $('#formId').val('');
            $('#pasien_id').val('');
            $('#poli_id').val('');
            $('#formInput').trigger("reset");
            $('#ajaxModel').modal('show');
        }

        //Tampilkan form edit
        function editForm(id) {
            $.ajax({
                url: "{{ url($title) }}" + '/edit/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $("#headForm").empty();
                    $("#headForm").append("Form Edit");
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('show');
                    $('#saveBtn').hide();
                    $('#updateBtn').show();
                    $('#formId').val(data.id);
                    $('#nama').val(data.nama);
                    $('#kt_select2_1').val(data.role_id).trigger('change');
                },
                error: function () {
                    toast("Tidak dapat menampilkan data", "error", 1500);
                }
            });
        }

        function poli(){
            var id = $('#kt_select2_2').val();
            $.ajax({
                url:"{{ url($title) }}" + '/dokter/'+id,
                type:'GET',
                success:function(val){
                    $('#kt_select2_3').html(val);
                }
            })
        }

        function jadwal(){
            var id = $('#kt_select2_3').val();
            $.ajax({
                url:"{{ url($title) }}" + '/jadwal/'+id,
                type:'GET',
                success:function(val){
                    $('#kt_select2_4').html(val);
                }
            })
        }
    </script>
@endpush
