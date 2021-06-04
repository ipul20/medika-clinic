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
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name" required />
                        </div>
                        <div class="col-lg-6">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id=""/>
                        </div>
                        <div class="col-lg-6">
                            <label>Role User</label>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <select class="form-control select2" id="kt_select2_1" name="role"
                                            style="width:100%">
                                        <option value="" selected disabled hidden>Choose here</option>
                                        <option value="admin">Admin</option>
                                        <option value="dokter">Dokter</option>
                                        <option value="pasien">Pasien</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            
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
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#kt_select2_1').val(data.role).trigger('change');
                },
                error: function () {
                    toast("Tidak dapat menampilkan data", "error", 1500);
                }
            });
        }

    </script>
@endpush
