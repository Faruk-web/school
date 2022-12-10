<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Invoice | {{$supplier_returned_invoice_info->supp_invoice_id}}</title>
</head>
<style>
    @page {
        header: page-header;
        footer: page-footer;
        margin-top: 30mm;


    }

    body {
        font-family: 'examplefont', nikosh;
    }

    li {
        list-style: none;
        float: left;
        overflow: hidden;
    }

    p {
        font-size: 13px;
    }

    .customar_info {
        width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid black;
        text-align: left;
        padding: 5px;
        font-size: 13px;
    }

    .invoiceIDandDate {
        text-align: right;

    }

    .clientInfo {
        background-color: red;
    }

</style>

<body>
    <htmlpageheader name="page-header">
        <div>
            <table style="margin-top: 10px;">
            <tr>
                <td style="border: 0px solid white;">
                    <div>
                        <img src="{{asset(optional($shop_info)->shop_logo)}}" alt="">
                    </div>
                </td>
                <td style="text-align: right; border: 0px solid white;">
                    <div>
                    <p style="font-size: 13px; text-align: right; overflow: hidden;"><span style="font-size: 15px; font-weight: bold;">
                        {{$shop_info->shop_name}}</span><br>
                            {{$shop_info->address}},<br>
                            {{$shop_info->phone}}, </b><br>
                            {{$shop_info->email}}<br>
                            {{$shop_info->shop_website}}
                        </p>
                        </div>
                </td>
            </tr>
        </table>
        
            <hr style="border: 1px solid #81d4fa;">
        </div>
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        <table width="100%">
            <tr>
                <td width="5%" align="center" style="border: 0px solid white;">{PAGENO}/{nbpg}</td>
                <td width="90%" style="text-align: center; border: 0px solid white;">
                    <p style="font-size: 13px; text-align: center; font-family: Arial;">This Software Created by <b>FARA
                            IT Fusion</b>(www.faraitfusion.com)</p>
                </td>
                <td width="5%" style="text-align: right; border: 0px solid white;"></td>
            </tr>
        </table>
    </htmlpagefooter>
    @php($supplier_info = $supplier_returned_invoice_info->supplier_name)
    <div>
        <table>
            <tr>
                <th style="border: 0px solid white;">
                    <div>
                        <p>
                            Supplier Name: {{$supplier_info->name}}<br>
                            Company Name: {{optional($supplier_info)->company_name}}<br>
                            Address: {{optional($supplier_info)->address}}<br>
                            Phone: {{optional($supplier_info)->phone}}<br>
                            Email: {{optional($supplier_info)->email}}<br>
                        </p>
                    </div>
                </th>
                <th style="text-align: right; border: 0px solid white;">
                    <p class="invoiceIDandDate" style="font-family: Arial;">
                        <span style="font-size: 18px; font-weight: bold; color: #F50057;">Supplier Product Return Invoice</span>
                        <br>Invoice # {{str_replace("_","/", $supplier_returned_invoice_info->supp_invoice_id)}}
                        <br>Current Return Times: {{$supplier_returned_invoice_info->how_many_times_edited}}
                        <br>Date: {{date('d M, Y', strtotime(optional($supplier_returned_invoice_info)->date))}}</p>
                </th>
            </tr>
        </table>
    </div>
    <br />
    <div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr style="text-align: right; background-color: #dddddd;">
                    <th scope="col" style="text-align: center;">SN</th>
                    <th width="50px" style="text-align: left;">Product Name</th>
                    <th scope="col" style="text-align: center;">Quantity</th>
                    <th scope="col" style="text-align: center;">Price</th>
                    <th scope="col" style="text-align: center;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($returned_products as $product)
                <?php
                    $variation_name = '';
                    if($product->variation_id != 0 || $product->variation_id != '') {
                        $variation_info = DB::table('product_variations')->where(['id'=>$product->variation_id])->first();
                        $variation_name =  ' ('.optional($variation_info)->title.')';
                    }
                ?>
                <tr style="text-align: right;">
                    <th scope="row" style="text-align: center;">{{$i}}</th>
                    <td width="350px" style="text-align: left;">{{$product->product_info->p_name}} {{$variation_name}}</td>
                    <td style="text-align: center;">{{$product->quantity}}
                        {{$product->product_info->unit_type_name->unit_name}}</td>
                    <td style="text-align: center;">{{$product->price}}</td>
                    <td style="text-align: center;">{{$product->total_price}}</td>
                </tr>
                @php($i += 1)
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top: 8px; text-align: right;">
        <table>
            <tbody style="text-align: right;">
                <tr style="text-align: right;">
                    <td
                        style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                        <b>Total Gross</b></td>
                    <td style="text-align:right; width:100px !important;">
                        {{number_format($supplier_returned_invoice_info->total_gross, 2)}}</td>
                </tr>
                
                <tr style="text-align: right;">
                    <td
                        style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                        <b>Supplier Previous Balance</b></td>
                    <td style="text-align: right;">{{number_format($supplier_returned_invoice_info->supp_Due, 2)}}</td>
                </tr>
                <tr style="text-align: right;">
                    <td
                        style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                        <b>Supplier Current Balance</b></td>
                    <td style="text-align: right;">{{number_format($supplier_returned_invoice_info->supp_Due - $supplier_returned_invoice_info->total_gross, 2)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <p><b>Note:</b></p>
        {{optional($supplier_returned_invoice_info)->note}}
    </div>
</body>
</html>
