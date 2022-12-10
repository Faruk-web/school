@extends('cms.master')
@section('body_content')
<!-- Page Content -->
<div class="content">
    <!-- Overview -->
    <div class="row">
    <div class="col-sm-12 col-xl-12 col-md-12">
            <!-- Pending Orders -->
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <div class="col-lg-12 col-xl-12">
                    <form action="{{url('/admin/update-product/'.$product_info->id)}}" method="post" enctype="multipart/form-data" id="form_1">
                    @csrf
                    <div class="row">
                    <div class="col-md-12">
                        
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span> Product Title</label>
                                <textarea name="p_name" id="" cols="30" rows="2" class="form-control" required>{{$product_info->p_name}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input-alt">Product Brand</label>
                                <select id="" name="p_brand" class="form-control select4" data-live-search="true">
                                    <option value="">-- Select Brand --</option>
                                    @foreach($brands as $brand)
                                    <option @if($product_info->p_brand == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span>Product Category</label>
                                <select id="" name="p_cat" class="form-control select2" required data-live-search="true">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $categroy)
                                    <option @if($product_info->p_cat == $categroy->id) selected @endif value="{{$categroy->id}}">{{$categroy->cat_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span>Unit Type</label>
                                <select id="" name="p_unit_type" class="form-control select3" required data-live-search="true">
                                    <option value="">-- Select Unit Type --</option>
                                    @foreach($unit_types as $type)
                                    <option @if($product_info->p_unit_type == $type->id) selected @endif value="{{$type->id}}">{{$type->unit_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span>Purchase Price</label>
                                <input type="number" class="form-control " step=any id="" value="{{$product_info->purchase_price}}" name="purchase_price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span>Selling Price</label>
                                <input type="number" class="form-control "  step=any id="" value="{{$product_info->selling_price}}" name="selling_price" required>
                            </div>
                        </div>
                        <div class="row col-md-12 shadow rounded p-2 border mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Discount Status</label>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-success">
                                        <input type="radio" @if($product_info->discount == 'flat') checked @endif class="custom-control-input" id="discount_tk" value="flat" required name="discount">
                                        <label class="custom-control-label" for="discount_tk">Flat</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-info">
                                        <input type="radio" @if($product_info->discount == 'percent') checked @endif class="custom-control-input" id="discount_percent" value="percent" name="discount">
                                        <label class="custom-control-label" for="discount_percent">Percent</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-danger">
                                        <input type="radio" @if($product_info->discount == 'no') checked @endif class="custom-control-input" id="discount_no" value="no" name="discount">
                                        <label class="custom-control-label" for="discount_no">No</label>
                                    </div>
                                    <div class="form-group @if($product_info->discount == 'no') d-none @endif " id="discount_rate_parent_div">
                                        <br>
                                        <input type="number" class="form-control" id="discount_amount" value="{{$product_info->discount_amount}}" placeholder="Discount Rate" name="discount_amount" step=any>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Vat Status</label>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-success">
                                        <input type="radio" class="custom-control-input" @if($product_info->vat_status == 'yes') checked @endif id="vat_status_percent" value="yes" name="vat_status">
                                        <label class="custom-control-label" for="vat_status_percent">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline custom-control-danger">
                                        <input type="radio" class="custom-control-input" @if($product_info->vat_status == 'no') checked @endif id="vat_status_no" value="no" name="vat_status">
                                        <label class="custom-control-label" for="vat_status_no">No</label>
                                    </div>
                                    <div class="form-group @if($product_info->vat_status == 'no') d-none @endif " id="vat_rate_parent_div">
                                        <br>
                                        <input type="number" class="form-control" id="vat_rate" value="{{$product_info->vat_rate}}" placeholder="Vat Rate" name="vat_rate" step=any>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input-alt">New Image (80 X 80)</label>
                                <input type="file" class="form-control "  onchange="preview()" name="image">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input-alt">Old Image</label><br>
                                <input type="hidden" name="old_image" value="{{$product_info->image}}">
                                <img src="{{asset($product_info->image)}}" class="rounded" id="" width="80px" height="80px" alt="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="example-text-input-alt">New Image View</label><br>
                                <img src="" class="rounded" id="product_image" width="80px" height="80px" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input-alt">Description</label>
                                <textarea name="p_description" id="" cols="30" rows="3" class="form-control">{{$product_info->p_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-alt"><span class="text-danger">*</span>Product Type</label>
                                <select id="" name="type" class="form-control" onchange="javascript:select_type(this)" required>
                                    <option value="">-- Select Product Type --</option>
                                    <option @if(optional($product_info)->is_variable == 'simple') class="text-light bg-success" selected @endif value="simple">Simple</option>
                                    <option @if(optional($product_info)->is_variable == 'variable') class="text-light bg-success" selected @endif value="variable">Variable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="example-text-input-alt">New Barcode</label>
                                <input type="text" onchange="product_barcode()" onkeyup="product_barcode()" class="form-control"  id="product_barcode_val" name="barCode">
                            </div>
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-body rounded shadow text-center" id="barcode_result">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card rounded">
                                    <div class="card-header bg-dark">
                                        <h4 class="text-light"><b>Current Barcode</b></h4>
                                    </div>
                                    <div class="card-body rounded shadow text-center">
                                        @if(!empty($product_info->barCode))
                                        <img src="{{asset('barcode/barcode.php')}}?codetype=Code39&size=40&text={{$product_info->barCode}}&print=true">
                                        @else
                                        <h2 class="text-danger"><b>Has No Barcode</b></h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 p-2 mb-4" id="variation_info_div" @if(optional($product_info)->is_variable == 'variable')  @else style="display: none;" @endif  >
                            <div class="row shadow rounded">
                                <div class="col-md-3 p-2">
                                    <div class="shadow rounded p-2">
                                    @foreach($variations as $variation)
                                    <?php
                                        $variation_lists = $variation->variation_lists;
                                    ?>
                                    <div class="form-check mb-1">
                                        <label class="form-check-label text-info">{{$variation->title}}</label>
                                    </div>
                                    <div class="row ml-3">
                                        @foreach($variation_lists as $list)
                                        @if($list->is_active == 1)
                                        @php( $check = $product_with_variations->where('variation_list_id', $list->id)->first() )
                                        <div class="col-md-12">
                                            <button type="button" @if(!is_null($check)) disabled class="btn btn-primary btn-sm btn-block mb-2 btn-rounded" @else onclick="checkVariation('{{$list->list_title}}', '{{$list->id}}')" class="variation_button btn btn-primary btn-sm btn-block mb-2 btn-rounded" @endif id="list_id{{$list->id}}"   >{{$list->list_title}}</button>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="col-md-9 p-2">
                                    <div class="shadow rounded p-2">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th width="20%" scope="col">Variations</th>
                                          <th scope="col">P Price</th>
                                          <th scope="col">S Price</th>
                                          <th scope="col">Action / Status</th>
                                        </tr>
                                      </thead>
                                      <tbody id="variation_tbody">
                                         @foreach($product_with_variations as $variation)
                                        <tr>
                                            <td><input type="text" class="form-control" value="{{optional($variation->variation_list_info)->list_title}}" name="" readonly=""><input type="hidden" class="form-control" value="{{optional($variation)->variation_list_id}}" name="variation_id[]"></td>
                                            <td><input type="number" class="form-control" required="" placeholder="P Price" value="{{optional($variation)->purchase_price}}" name="variation_purchase_price[]" step="any"></td>
                                            <td><input type="number" class="form-control" placeholder="S Price" required=""  value="{{optional($variation)->selling_price}}" name="variation_sell_price[]" step="any"></td>
                                            <td>
                                                <select name="is_active[]" class="form-control" required>
                                                    <option @if(optional($variation)->is_active == 1) class="text-light bg-success" selected @endif value="1">Active</option>
                                                    <option @if(optional($variation)->is_active == 0) class="text-light bg-success" selected @endif value="0">Deactive</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                      
                        
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success" onclick="form_submit(1)" id="submit_button_1">Save</button>
                            <button type="button" disabled class="btn btn-outline-success" style="display: none;" id="processing_button_1">Processing....</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Overview -->

</div>
<!-- END Page Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>

    function select_type(type) {
        if(type.value == 'simple') {
            $('.variation_tr').html('');
            $('#variation_info_div').hide();
            $('.variation_button').prop('disabled', false);
        }
        else if(type.value == 'variable') {
            $('#variation_info_div').show();
        }
        else {
            $('.variation_tr').html('');
            $('#variation_info_div').hide();
            $('.variation_button').prop('disabled', false);
        }
    }
    
    
    function checkVariation(list_title, list_id) {
        
        $('#variation_tbody').append('<tr id="variation_tr_'+list_id+'" class="variation_tr"><td><input type="text" class="form-control" value="'+list_title+'" name="" readonly><input type="hidden" class="form-control" value="'+list_id+'" name="variation_id[]"></td><td><input type="number" class="form-control" required placeholder="P Price" name="variation_purchase_price[]" step=any></td><td><input type="number" class="form-control"  placeholder="S Price"  required name="variation_sell_price[]" step=any></td><td><button type="button" class="btn btn-danger" onclick="delete_variation('+list_id+')" >X</button></td></tr>');
        
        $('#list_id'+list_id).prop('disabled', true);
        
        
        
    }
    
    function delete_variation(id) {
        $('#variation_tr_'+id).remove();
        $('#list_id'+id).prop('disabled', false);
    }


    $('input[type=radio][name=discount]').on('change', function() {
        var discount_rate_parent = document.getElementById("discount_rate_parent_div");

        if($(this).val() == 'flat' || $(this).val() == 'percent') {
            discount_rate_parent.classList.remove("d-none");
            //$('#discount_amount').val('');
            $("#discount_amount").prop('required', true);
        }
        else {
            discount_rate_parent.classList.add("d-none");
            //$('#discount_amount').val('');
            $("#discount_amount").prop('required', false);
        }
    });

    $('input[type=radio][name=vat_status]').on('change', function() {
        var vat_rate_div = document.getElementById("vat_rate_parent_div");
        if($(this).val() == 'yes') {
            vat_rate_div.classList.remove("d-none");
            //$('#vat_rate').val('');
            $("#vat_rate").prop('required', true);
        }
        else {
            vat_rate_div.classList.add("d-none");
            //$('#vat_rate').val('');
            $("#vat_rate").prop('required', false);
        }
    });

    
//Begin:: Check Product Barcode
function product_barcode() {
    code = $('#product_barcode_val').val();
    var code_img = document.getElementById("barcode_image");
    if(code == '') {
        //code_img.classList.add("d-none");
    }
    $.ajax({
        url: '/admin/check-product-barcode',
        method:"GET",
        data:{ 
            code:code,
        },
        success: function (response) {
          if(response['exist'] == 'yes') {
            $("#barcode_result").html('<img id="barcode_image" class="" src="{{asset('barcode/barcode.php')}}?codetype=Code39&size=40&text='+code+'&print=true"/>');
          }
          else if(response['exist'] == 'no'){
            $("#barcode_result").html('<h4 class="text-danger"><b>Sorry this code is used in <span class="text-dark">'+response['product']+'</span></b></h4>');
          }
        }
      });
}
//End:: Check Product Barcode

//Begin:: product image preview
function preview() {
    product_image.src=URL.createObjectURL(event.target.files[0]);
}
//End:: product image preview

 
 $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
});
 
</script>


@endsection
