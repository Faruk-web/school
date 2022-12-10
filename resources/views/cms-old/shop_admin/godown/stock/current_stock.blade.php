
@extends('cms.master')
@section('body_content')

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- Page Content -->
<div class="content">
    <div class="block block-rounded">
    <form action="{{route('admin.report.products.current.stock.print')}}" method="post" target="_blank">
            @csrf
            <div class="row p-2">
                <div class="col-md-7">
                    <h4 class="text-success" id="stock_position_title">Godowns Current Active Stocks</h4>
                    <small><b>=>To Show Details, Click Print Button</b></small>
                    <div class="text-primary pt-2 shadow rounded">
                        <h4 id="stock_position_value" class="p-1"></h4>
                    </div>
                </div>
                
                
                <div class="col-md-5 row">
                    <div class="col-md-10 row">
                        <div class="form-group col-md-5 d-none">
                            <select class="form-control active_or_empty_stock" name="active_or_empty_stock" id="active_or_empty_stock">
                                <option value="active">Active Stock</option>
                                <option value="empty">Empty Stock</option>
                            </select>
                            <!--<small class="text-success">Coming soon-> Brand & category Filter</small>-->
                        </div>
                        <div class="form-group col-md-12 d-none">
                            <select class="form-control which_stocks" name="place" id="which_stocks">
                                <option value="godown">Godowns</option>
                               
                            </select>
                        </div>
                        <div class="form-group col-md-6 d-none">
                            
                            <select class="form-control" name="brands" id="brands">
                                <option value="all">All Brands</option>
                                
                                
                            </select>
                        </div>
                        <div class="form-group col-md-6 d-none">
                            <select class="form-control" name="categories" id="categories">
                                <option value="all">All Categories</option>
                               
                                
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-2 text-left">
                         <button type="submit" class="btn btn-primary btn-sm">Print</button> 
                         <input type="hidden" name="" id="toggle_yes" value='1'>
                    </div>
                    
                </div>
            </div>
        </form>
        <div class="block-content">
            <div class="table-responsive">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Barcode</th>
                        <th>Purchase Price</th>
                        <th>Current Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- END Page Content -->

<script type="text/javascript">

    $(document).ready(function () {
        get_data('active','godown');
        get_product_stock_value('godown');
        $('select.which_stocks').on('change', function() {
            change_stock_or_place();
        });
        $('select.active_or_empty_stock').on('change', function() {
            change_stock_or_place();
        });
        
        var toggle_yes = $('#toggle_yes').val();
        if (typeof (toggle_yes) != 'undefined' && toggle_yes != null) {
            SidebarColpase();
        }
        
    });

    function change_stock_or_place() {
        
        var active_or_empty = $("#active_or_empty_stock option:selected" ).val();
        var active_or_empty_text = $("#active_or_empty_stock option:selected" ).text();
        var place = $("#which_stocks option:selected" ).val();
        var which_stocks = $("#which_stocks option:selected" ).text();
        
        if(active_or_empty == 'active') {
            $("#stock_position_title").addClass("text-success");
            $("#stock_position_title").removeClass("text-danger");
            if(place == 'godown') {
                get_data('active','godown');
                get_product_stock_value('godown');
                $('#stock_position_title').text(which_stocks+" Current "+active_or_empty_text);
            }
            else {
                get_data('active', place);
                get_product_stock_value(place);
                $('#stock_position_title').text(which_stocks+" Current "+active_or_empty_text);
            }
        }
        else if(active_or_empty == 'empty') {
            $("#stock_position_title").addClass("text-danger");
            $("#stock_position_title").removeClass("text-success");
            if(place == 'godown') {
                get_data('empty','godown');
                $('#stock_position_value').text('Stock Value: 0.00');
                $('#stock_position_title').text(which_stocks+" Current "+active_or_empty_text);
            }
            else {
                get_data('empty', place);
                $('#stock_position_value').text('Stock Value: 0.00');
                $('#stock_position_title').text(which_stocks+" Current "+active_or_empty_text);
            }
        }

    }

    function get_data(active_or_empty, place) {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            "bDestroy": true,
            ajax: {
                "url": "/admin/product/stock-data/"+place+"/"+active_or_empty,
            },
            columns: [
                {data: 'product_name', name: 'product_name'},
                {data: 'barCode', name: 'barCode'},
                {data: 'purchase_price', name: 'purchase_price'},
                {data: 'stock', name: 'stock'},
                {data: 'action', name: 'action'},
            ],
            "scrollY": "300px",
            "pageLength": 25,
            "ordering": false,
        });
    }
    
    function get_product_stock_value(place) {
        $.ajax({
            type: 'get',
            url: "/admin/product/stock-value",
            data: {
                'place': place
            },
            beforeSend: function() {
                $('#stock_position_value').html('<div class="text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success: function (data) {
                $('#stock_position_value').text(data);
            },
            
        });
    }
    
    function find_product(id) {
        
    }
    
</script>
@endsection

