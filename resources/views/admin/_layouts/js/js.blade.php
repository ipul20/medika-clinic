<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->

<!-- jQuery 3 -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('') }}theme/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('') }}theme/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="{{ asset('') }}theme/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->

<script src="{{ asset('') }}twbs-pagination/jquery.twbsPagination.min.js"></script>

<!--begin::Page Vendors(used by this page)-->
{{--<script src="{{ asset('') }}theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>--}}
{{--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>--}}
{{--<script src="{{ asset('') }}theme/assets/plugins/custom/gmaps/gmaps.js"></script>--}}
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('') }}theme/assets/js/pages/widgets.js"></script>
<!--end::Page Scripts-->

<!--form-->
<script src="{{ asset('theme/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="{{ asset('theme/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>
<script src="{{ asset('theme/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
<script>
    function munculkanModalProfile() {
            $("#headForm").empty();
            $("#headForm").append("Form Input");
            $('#saveBtn').show();
            $('#updateBtn').hide();
            $('#formId').val('');
            $('#formInput').trigger("reset");
            $('#profileModal').modal('show');
        }
    $(document).ready(function () {
        $('#updatePassword').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#formPassword').serialize(),
                url: "{{route('password.ganti')}}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data.status==true){
                    $('#formPassword').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    toastr.success("Successful update data!");
                    }else{
                        toastr.warning(data.message);
                    }
                },
                error: function (data) {
                    $('#ajaxModel').modal('hide');
                    toastr.warning("ganti Password Gagal");
                }
            });
        });
    });

</script>
