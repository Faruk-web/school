
	<!-- core:js -->
	<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
     <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-light.js') }}"></script>
	<!-- End custom js for this page -->

    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    @if(session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
            className: "success",
        }).showToast();
    </script>
    @endif

    @if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
            className: "error",
        }).showToast();
    </script>
    @endif

<script>
    function form_submit(number) {
        if (document.getElementById("form_"+number).checkValidity()) { 
            $('#submit_button_'+number).hide();
            $('#processing_button_'+number).show();
        }
        else {
            Toastify({
                text: "Something is missing!",
                backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
                className: "error",
            }).showToast();
        }
    }

    function error(info) {
        Toastify({
            text: info,
            backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
            className: "error",
        }).showToast();
    }

    function success(info) {
        Toastify({
            text: info,
            backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
            className: "success",
        }).showToast();
    }
</script>

@yield('script')