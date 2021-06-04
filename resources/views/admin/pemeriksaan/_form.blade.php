<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <label id="">Export PDF</label> 
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
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="1" class="btn btn-success btn-lg btn-block exportPDF" required>Export Semua</a>
                        </div>
                        <div class="col-lg-6">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="0" class="btn btn-primary btn-lg btn-block exportPDF" required>Export Hari ini</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                </div>
            </form>


        </div>
    </div>
</div>