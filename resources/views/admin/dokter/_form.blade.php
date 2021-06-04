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
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="col-lg-6">
                            <label>Jenis Kelamin</label>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control select2" id="kt_select2_1" name="jenis_kelamin"
                                            style="width:100%">
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>No Handphone</label>
                            <input type="text" class="form-control" name="nohp" id="nohp"/>
                        </div>
                        <div class="col-lg-6">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Poliklinik</label>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control" id="poli_id" name="poli_id"
                                            style="width:100%">
                                            @foreach(Helper::get_data('poli') as $v)
                                            <option value="{{$v->id}}">{{$v->nama}}</option>
                                            @endforeach
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
                    $('#nohp').val(data.nohp);
                    $('#selesai').val(data.selesai);
                    $('#kt_select2_1').val(data.jenis_kelamin).trigger('change');
                },
                error: function () {
                    toast("Tidak dapat menampilkan data", "error", 1500);
                }
            });
        }

    </script>
@endpush
