@php
    $user = Auth::user();
    $school_info = DB::table('school_settings')->where('code', $user->s_code)->first();
    /*
    $renew_date = optional($user->shop_info)->renew_date;
    $renew_date_str = strtotime($renew_date);
    $today = strtotime(date("Y-m-d"));
    $date_diff = $renew_date_str - $today;
    */
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="author" content="Ridoy Paul">
	<title>@yield('title')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="../../../css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('assets/css/demo1/style.min.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/toastify.min.css') }}">
  
  @include('partials.style')
  @yield('style')
</head>

<body class="sidebar-dark">

	<div class="main-wrapper">

		<!--sidebar -->
        {{-- super admin link  --}}
        @if($user->type == 'super_admin')

            @include('partials.super_admin_sidebar')

        {{-- reseller admin link --}}
        @elseif($user->type == 'reseller')

            @include('partials.reseller_sidebar')

        {{-- teacher admin link  --}}
        @elseif($user->type == 'teacher')

            @include('partials.teacher_sidebar')

        {{-- Owner / Crm / branch user sidebar link  --}}
        @else
            @include('partials.owner_crm_branch_user_sidebar')
        @endif

        
		<div class="page-wrapper">
					
            <!-- Header -->
            @include('partials.header')
            <!-- END Header -->
			
			<div class="page-content">

                <!--Body Start-->
                @yield('body_content')
                <!--Body end-->

			</div>

			<!-- footer -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
				<p class="text-muted mb-1 mb-md-0">Copyright © {{date("Y")}} <a href="#" target="_blank">{{optional($school_info)->name}}</a>.</p>
				<p class="text-muted">Design & Developed <i class="mb-1 text-primary ms-1 icon-sm text-danger mr-2" data-feather="heart"></i> by <a href="https://faraitltd.com">FARA IT Limited</a></p>
			</footer>
			<!-- partial -->
		
		</div>
	</div>


    <!-- Scripts start -->
    @include('partials.scripts')
    <!-- Scripts End -->
</body>
</html>    