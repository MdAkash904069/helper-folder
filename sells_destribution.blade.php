<?php $panelTitle = "Customer Replace"; ?>
    
<div class="col-md-12 col-sm-12 sortable-layout" id="customer_display">
    <div class="panel panel-default chart">
        <div class="panel-body" style="border: 2px dashed#333; font-weight:bold;color: #333;">
            <div class="simple-chart" style="line-height: 25px;">
                <div class="row" style="text-align: center;"><span style="font-size: 14px; border-bottom: 1px solid #333;">Region Sales Target Details</span></div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-5">Region Name</div>
                            <div class="col-md-9 col-sm-8 col-xs-7">: 
                                <span class="customer_name" style="color:#333"> {{$clientCategories->regionName}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-5">RSM Name</div>
                            <div class="col-md-9 col-sm-8 col-xs-7">: 
                                <span class="phone" style="color:#333">{{$clientCategories->serviceHolderName}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-5">Month</div>
                            <div class="col-md-9 col-sm-8 col-xs-7">: 
                                <span class="phone" style="color:#333">{{@helper::getMonthName($clientCategories->monthly)}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-5">Year</div>
                            <div class="col-md-9 col-sm-8 col-xs-7">: 
                                <span class="phone" style="color:#333">{{$clientCategories->yearly}}</span>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-5">Sells Target Limit</div>
                            <div class="col-md-8 col-sm-8 col-xs-7">: <span id="credit_limit">{{$clientCategories->sales_target}}</span> Tk
                                <span class="phone" style="color:#333"></span>
                            </div>
                            <input type="hidden" value="" name="credit_limit" />
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-5">Rest Balance</div>
                            <div class="col-md-8 col-sm-8 col-xs-7">:<span>  <span id="current_amount">{{$clientCategories->sales_target}}</span> Tk <br>
                                <span id="errMsg" style="color: red;display:none">Area Target Not greater then Sells Target</span>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form type="create" action="" id="productInvoiceFrom" class="form-load form-horizontal mt0" callback="refreshArea" autocomplete="off"  panelTitle="Sells Destribution">
    {{csrf_field()}}
    <div class="col-lg-12 col-md-12 col-sm-12 sortable-layout mb10" style="padding: 0">
        <div class=" panel-default chart">
           <br>
            <div class="col-md-12 col-sm-12 sortable-layout">
                <div class="panel panel-default chart">
                    <div class="">
                        <div class="simple-chart" style="line-height: 25px;">
                            <div class="row" style="text-align: center;"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="dtHorizontalExample" class="table table-bordered table-sm input-table">
                                        <thead>
                                            <tr>
                                                <th width="2%">SL.No.</th>
                                                <th width="45%">Employee Area</th>
                                                <th width="15%">Transfer Target Price</th>
                                                <th width="3%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="opportunity_product_plus" class="amountPurpose">
                                            <tr class="new_product_row">
                                                <td class="td-sn">1</td>
                                                <td>
                                                    <input type="hidden" id="customer">
                                                    <div id="product_src" class="row advance-search" search-url="" search-title="Product Search">
                                                        <div class="form-group pl10 mb0">
                                                            <div class="col-sm-11 pl15 pr5" id="product_id_view">
                                                                <select required name="region_area_id[]" id="product_id" data-fv-row=".col-sm-11" data-fv-icon="false" class="product_id select2 form-control adv-search product_select append_option">
                                                                    <option value="">Select Area</option>
                                                                    @foreach($region_areas as $region_area)
                                                                        <option value="{{$region_area->id}}">{{$region_area->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                            <div style="color:red;display: none;" class="fomr-control" id="hidemassge" > *Allready Selected
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="quantity_td">
                                                    <div class="form-group pl10 pr10 mb0">
                                                        <input required name="tranfer_region_sells_amount[]" id="quantity" class="form-control quantity tranfer_region_sells_amount" placeholder="Input Amount">
                                                        
                                                    </div>
                                                </td>
                                                
                                                <td class="pub-plus-minus first_plus">
                                                    <i class="fa fa-plus-square hand pub-plus"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                
                                    <div class="row purchase_bottom">
                                        <div class="row">
                                            <div class="col-md-7 col-lg-7">
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <div class="form-group col-md-6 col-lg-6">
                                                    <h4 style="font-size: 15px">Total Price:</h4>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6">
                                                    <div class="form-group col-md-12 col-lg-12" style="text-align: right;">
                                                        <h4 style="font-weight: 300 !important; font-size: 14px;">
                                                            <span class="color" id="subTotalAmount" class="subTotalAmount">00</span><span>(Tk)</span>
                                                            <input type="hidden" name="product_subtotal_price" class="product_subtotal_price">
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    <div style="display:inline-block;" class="pull-left">
        <button type="submit" id="submitbutton" class="btn btn-success submitbutton" data="0">Save</button>
    </div>
</form>
{{-- Clone Table --}}
<table style="display:none;">
    <tbody id="opportunity_product_plus_clone" class="amountPurpose">
        <tr class="new_product_row">
            <td class="td-sn">1</td>
            <td>
                <div id="product_src" class="row advance-search" search-url="" search-title="Product Search">
                    <div class="form-group pl10 mb0">
                        <div class="col-sm-11 pl15 pr5" id="product_id_view">
                            <select required name="region_area_id[]" id="product_id" data-fv-row=".col-sm-11" data-fv-icon="false" class="select2 clone form-control adv-search product_select remove_option product_id">
                            <option value="">Select Area</option>
                            @foreach($region_areas as $region_area)
                                <option value="{{$region_area->id}}">{{$region_area->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="color:red;display: none;" class="fomr-control" id="hidemassge" >
                        *Allready Selected
                    </div>
                </div>
            </td>
            <td id="quantity_td">
                <div class="form-group pl10 pr10 mb0">
                    <input required name="tranfer_region_sells_amount[]" id="quantity" class="form-control quantity  tranfer_region_sells_amount" placeholder="Input Amount">
                    
                </div>
            </td>
            
            <td class="pub-plus-minus">
                <i class="fa fa-minus-square hand pub-minus"></i>
                <i class="fa fa-plus-square hand pub-plus"></i>
            </td>
        </tr>
    </tbody>
</table>




<script type="text/javascript">
    $(document).ready(function() {
        
        //scrollable table start
        var x = window.matchMedia("(max-width: 800px)")
        mediaQuery(x) // Call listener function at run time
        x.addListener(mediaQuery) // Attach listener function on state changes
        $('#productInvoiceFrom').formValidation('addField', $("#customer_id"));
        //scrollable table end

        $("select.select2").not(".clone, .pro").select2({
            placeholder: "Select"
        });

        //$(".dtpicker").datepicker({format: 'dd/mm/yyyy'});
        $(".dtpicker").datepicker({ format: 'dd-mm-yyyy', changeMonth: true,changeYear: true,yearRange: '-70:+10',constrainInput: false,duration: '',gotoCurrent: true}).datepicker('setDate',"0");

        $('#opportunity_product_plus').on('click', '.pub-plus', function(){
            productTrAdd('opportunity_product_plus'); 
        });
        $('#opportunity_product_plus').on('click', '.pub-minus', function(){
            productTrRemove('opportunity_product_plus', $(this));
        });

       

       
        //duplicate product
         function countInArray(array, what) {
            var count = 0;
            for (var i = 0; i < array.length; i++) {
                if (array[i] === what) {
                    count++;
                }
            }
            return count;
        }

        // Product's Details
        $("#productInvoiceFrom").on('change', '.product_select', function(e) {

            var branch_id                 = $('#productInvoiceFrom #branch_id').val();
            var productId                 = $(this).children("option:selected").val();
            var customer_id               = $('#customer_id').val();
            var $selector                 = $(this).closest(".new_product_row");
            var quantity                  = $selector.find("input[name='quantity[]']");
            var product_sn                = $selector.find("input[name='product_sn[]']");
            var ctn_qty_selector          = $selector.find("input[name='ctn_qty[]']");
            var unit_selector             = $selector.find("input[name='unit[]']");
            var perProTotalPriceShowField = $selector.find("input[name='per_product_total[]']");
            var qtyFeedback               = $selector.find("div.qtyFeedback");
            var qtyFeedbackStatus         = $selector.find("div.qtyFeedbackStatus");
            var qtyFeedbackStatusvalue    = $selector.find("div.qtyFeedbackStatusvalue");
            var productPrice              = $selector.find(".product_price");
            var sales_price               = $selector.find(".sales_price");
            var productTotalPrice         = $selector.find(".product_total_price");
            var perProTotalPriceInpField  = $selector.find("input[name='per_product_total_amount[]']");

            $('#purchaseReceiveForm').formValidation('removeField', $("#product_id"));
            $('#purchaseReceiveForm').formValidation('removeField', $("#branch_id"));

            var productSn = $selector.find("input[name='product_sn[]']");
            $selector.find("select[name='size[]']").html(" ");

            var stored  = [];
            $('#productInvoiceFrom #product_id').each(function(index) {
                var value = $(this).val();
                stored.push(value);
            });

            $('.quantity').on('keyup', function(){
                    var price = $(this).closest("tr").find('.sales_price').val(); 
                    ctn = (Number($(this).val())*price);
                    $(this).closest("tr").find('#per_product_total').val(ctn);
                    $(this).closest("tr").find('.single_product_total_amount').val(ctn);
                });


                $('.sales_price').on('keyup', function(){
                    var quantity = $(this).closest("tr").find('.quantity').val(); 
                    ctn = (Number($(this).val())*quantity);


                    $(this).closest("tr").find('#per_product_total').val(ctn);
                    $(this).closest("tr").find('.single_product_total_amount').val(ctn);
                    
                    // alert($('.per_product_total_amount').val());

                }); 

            var times = countInArray(stored, productId);

            if(times > 1)
            {
                var business_type = $('#business_type').val();
                var customerId = (customer_id)? customer_id : 0;
                var ref_no=false;
                var form_type=false;
                $.ajax({
                    url: appUrl.baseUrl('/bPack/get-user-products'),
                    type: "GET",
                    data: {modalType:8, businessType:business_type, customerId:customerId, branch_id:branch_id, ref_no:ref_no, form_type:form_type},
                    dataType: 'html',

                    success: function (data) 
                        {
                            console.log(data);
                            dataFilter(data);
                            $selector.find("#product_id_view").html(data);
                            $selector.find("#product_id_view #product_id").select2({placeholder:"Select Product"});
                            // $("#product_id_view #product_id").select2({placeholder:"Select Product"});
                            //$selector.find("#hidemassge").show();
                            $selector.find('#hidemassge').show();
                            setTimeout(function(){
                                $selector.find('#hidemassge').hide();
                            },1500);
                        }
                });

                return false;

            }
            else{
                if (productId ==0 || productId == '') {
                    product_sn.val('');
                    quantity.val('');
                    perProTotalPriceShowField.val(0);
                    perProTotalPriceInpField.val(0);
                    qtyFeedback.hide();
                    qtyFeedbackStatus.hide();
                    grandTotalProductsPrice(); 
                }
                else{
                    $.ajax({
                        mimeType: 'text/html; charset=utf-8',
                        url: '{{route("bPack.productSortDetails")}}',
                        data: {productId:productId, customer_id:customer_id, business_type:business_type, branch_id:branch_id},
                        type: 'GET',
                        dataType: "json",
                        success: function(data) {
                            
                            console.log(data.data.whole_sale_price);

                            unit_selector.val(data.data.carton_unit_name);
                            qtyFeedbackStatusvalue.text(data.quantity);


                            quantity.val(0);
                            sales_price.val(data.data.whole_sale_price);
                            
                            if (data.product_sn == null) {
                                product_sn.val(0);
                            } else {
                                product_sn.val(data.product_sn);
                            }

                            $('.quantity').on('keyup', function(){

                                var sum = 0;
                                var ctn_qty = data.data.carton_qty;
                
                                var quantity = $(this).val(); 
                                var ctn = (Number(quantity)/ctn_qty).toFixed(2);
                                ctn_qty_selector.val(ctn);

                                $('.quantity').each(function(){
                                    sum += Number($(this).val());
                                });
                            });                   
                        }
                    });
                }
            }
        });

        
    });

    function mediaQuery(x) {
        if (x.matches) { // If media query matches
            $('#dtHorizontalExample').DataTable({
                "scrollX": true
            });
            $('.dataTables_length').addClass('bs-select');
        }
    }

   

   

    function productTrAdd(selector) {
        var sn = parseInt($('#'+selector).find('.td-sn').last().html())+1;
        $('#'+selector).append($('#'+selector+'_clone').html());
        var $lastChild = $('#'+selector).find('tr').last();
        $lastChild.find("select.select2").select2({placeholder: "Select"});
        $lastChild.find("#color").select2({placeholder: "Select Color"});
        $lastChild.find("#size").select2({placeholder: "Select Size"});
        $lastChild.find(".dtpicker").datepicker({format: 'dd/mm/yyyy'});
        advanceSearch($lastChild.find("#product_src"));
        
        //FV
        $('#productInvoiceFrom').formValidation('addField', $lastChild.find("#product_id"));
        $('#productInvoiceFrom').formValidation('addField', $lastChild.find("#product_sn"));
        $('#productInvoiceFrom').formValidation('addField', $lastChild.find("#quantity"));
        $('#productInvoiceFrom').formValidation('addField', $lastChild.find("#ctn_qty"));
        $('#'+selector).find('.pub-plus').not($('#'+selector+' .pub-plus').last()).remove();
        $('#'+selector).find('.td-sn').last().html(sn);

        var businessType = $('#business_type').val();
        var branch_id = $('#branch_id').val();
        var customer_id = $('#customer_id').val();

        userProducts(businessType, customer_id, branch_id, '', '', 2);
    }

    function productTrRemove(selector, $that) {
        var $row = $that.parents('tr');

        $row.remove();
        if($('#'+selector+' .pub-plus-minus').length==1) {
            $('#'+selector+' .pub-plus-minus').html('<i class="fa fa-plus-square hand pub-plus"></i>');
        } else {
            $('#'+selector+' .pub-plus-minus').last().html('<i class="fa fa-minus-square hand pub-minus"></i> <i class="fa fa-plus-square hand pub-plus"></i>');
        }
        //Serial
        $('#'+selector).find('.td-sn').each(function(index){ $(this).html(index+1); });
        var netTotalAmount = 0;
        $('.custon_single_p_amount').each(function(){
            var value = Number($(this).val());
            netTotalAmount += value;
        });

        $('#subTotalAmount').text(netTotalAmount.toFixed(2));
        var subTotalAmount = $('#subTotalAmount').text();
        $('.product_subtotal_price').val(subTotalAmount);

    }

   

    


    function refreshArea() {
        $('.panel-refresh').trigger('click');
    }


    $(document).on('keyup','.tranfer_region_sells_amount', function(){

        var amount_values = [];
        $('.tranfer_region_sells_amount').each(function () {
            amount_values.push($(this).val());
        });
        // console.log(amount_values);
        sum = 0;
        $.each(amount_values,function(){
            sum+=parseInt(this) || 0;
        });
        // console.log(sum);
        
        $current_amount = $("#credit_limit").text();
        if(($current_amount - sum) > 0){
            $("#current_amount").text($current_amount - sum);
            $("#subTotalAmount").text(sum);
            $("#errMsg").hide();
        }else{
            $("#errMsg").show();
          
            $("#submitbutton").attr("disabled", "disabled");
        }
        // console.log($current_amount);
        

    });

   
</script>
