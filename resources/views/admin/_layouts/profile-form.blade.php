<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <label id="headForm"></label> Ganti Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="formPassword" name="formPassword" class="form" action="">
                @csrf
                <input type="hidden" name="id" id="formmidd">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" name="passwordlama" id="passwordlama" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="passwordbaru" id="passwordbaru" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="updatePassword" value="updatePassword">Update Password</button>
                </div>
            </form>


        </div>
    </div>
</div>