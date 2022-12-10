@extends('cms.master')
@section('body_content')
<?php
   
    $shop_info = DB::table('shop_settings')->where('shop_code', Auth::user()->shop_id)->first();
?>

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/toastify-js.js') }}"></script>
<style>
    @media print {
        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
        .text_color {
            color: #252A37 !important;
        }
        .background_color {
            background-color: #FFFFFF !important;
        }
    }

</style>
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded">
        <div class="row p-2">
            <div class="col-md-6">
                <h4 class="mb-0">Sales Reports</h4>
                <span>{{optional($shop_info)->shop_name}}<br>{!!optional($shop_info)->address!!}</span>
            </div>
            
            <div class="col-md-2 hidden-print"><input type="date" value="{{date('Y-m-d')}}" name="" class="form-control d-none" id="single_day_date"></div>
            <div class="col-md-3 hidden-print">
                <div class="dropdown push">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" id="dropdown-content-rich-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Date Range</button>
                    <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-content-rich-primary">
                        <form class="p-2" action="javascript:void(0)" method="">
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> Start Date</label>
                                <input type="date" class="form-control" id="date_range_start_date">
                            </div>
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> End Date</label>
                                <input type="date" class="form-control" id="date_range_end_date">
                            </div>
                            <button type="button" onclick="date_range_sales_report_by_product()" class="btn btn-success btn-sm">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1 hidden-print"><button id="btnPrint" type="button" class="btn btn-primary btn-sm">Print</button></div>
            <input type="hidden" name="" id="toggle_yes" value='1'>
        </div>
        
        <div class="block-content">
            <div class="pb-30">
                <div class="" id="sales_report_data_body">
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="_today_" value="{{date('Y-m-d')}}">
</div>
<!-- END Page Content -->


<script type="text/javascript">
    $(document).ready(function () {
        var toggle_yes = $('#toggle_yes').val();
        if (typeof (toggle_yes) != 'undefined' && toggle_yes != null) {
            SidebarColpase();
        }
        var today = $('#_today_').val();
        sales_report_data('all', 0, 0);
        
    });

    function date_range_sales_report_by_product() {
        var date_range_start_date = $('#date_range_start_date').val();
        var date_range_end_date = $('#date_range_end_date').val();
        
        if(date_range_start_date != '' && date_range_end_date != '') {
            sales_report_data('date_wise', date_range_start_date, date_range_end_date);
        }
        else {
            Toastify({
                text: "Select Date!",
                backgroundColor: "linear-gradient(to right, #F50057, #2F2E41)",
                className: "error",
            }).showToast();
            document.getElementById('error').play();
        }
    }

  

    function sales_report_data(type, first_date, last_date) {
        $.ajax({
            type: 'get',
            url: '/admin/sales_report_date_range',
            data: {
                'type': type,
                'first_date': first_date,
                'last_date': last_date,
            },
            beforeSend: function() {
                $('#sales_report_data_body').html('<div class="text-center"><div class="spinner-border text-dark mb-5" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success: function (data) {
                $('#sales_report_data_body').html(data);
            }
        });
    }

    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });

</script>
@endsection
