<div class="form-inline">
    <div class="row datatables_header">
        <div class="col-md-5 col-xs-12">
            <div class="input-group">
                <input name="search" event="enter" class="data-search form-control" id="search-input" value="{{@$search}}" kl_virtual_keyboard_secure_input="on" placeholder="Search">
                <span class="input-group-btn"><button name="search" event="click" valueFrom="#search-input" class="data-search btn btn-primary" type="button">Go</button></span>
            </div>
        </div>
        <div class="col-md-7 col-xs-12 perpage-add">
            @if($access->create)
            <button class="add-btn btn btn-primary pull-right btn-sm" id="addNew" view-type="modal" type="button" style="margin-left: 12px;"><i class="glyphicon glyphicon-plus mr5"></i>Add New</button>
            @endif
            @include("perPageBox")
        </div>
    </div>
</div>
<div id=myTabContent2 class=tab-content>
    <div class="tab-pane fade active in" id=home2>
        <div class="form-inline">
            <table cellspacing="0" class="responsive table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="3%">No.</th>
                        <th width="40%" data="1">Name</th>
                        <th width="40%" data="1">Test</th>
                        <th width="40%" data="1">Access</th>
                        <th width="40%" data="1">Stock Available</th>
                        <th>Color</th>
                        <th>Stock Publicity</th>
                        @if($access->edit || $access->destroy)
                        <th width="4%">Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Test</th>
                        <th>Access</th>
                        <th>Stock Available</th>
                        <th>Stock Publicity</th>
                        <th>Color</th>
                        @if($access->edit || $access->destroy)
                        <th>Action</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                <?php $paginate = $units; ?>
                @if(count($units)>0)  
                @foreach($units as $unit)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$unit->unit_name}}</td>
                        <td>{{$unit->test}}</td>
                        <td>
                            <button url="akashDataaccess?id={{$unit->id}}" view-type="modal" type="button" class="add-btn btn <?php if($unit->status_type == 1){echo "btn-info";}else{echo "btn-danger";}?>"><?php if($unit->status_type == 1){echo "Active";}else{echo "Inactive";}?></button>
                        </td>
                        <td>
                            
                                
                                <button id="stock_in{{$unit->id}}" get_id="{{$unit->id}}" get_val="1" type="button" class="btn btn-info stock_val" style="display:<?php if($unit->stock == 0){echo 'none';}else{echo 'block';}?>">Stock</button>
                            
                                <button id="stock_out{{$unit->id}}" get_val="0" get_id="{{$unit->id}}" type="button" class="btn btn-danger stock_val" style="display:<?php if($unit->stock == 1){echo 'none';}else{echo 'block';}?>">Stock Out</button>
                            
                           
                        </td>
                        <td>
                            <div id="stock_publish{{$unit->id}}"><?php if($unit->stock == 1) { echo "Publish";} else {echo "Unpublish";} ?></div>
                        </td>
                        <td>
                            {{$unit->colors}}
                        </td>
                        
                        @if($access->edit || $access->destroy)
                        <td>
                            @if($access->edit)
                                <i class="fa fa-edit" view-type="modal" title="Update" id="edit" data="{{$unit->id}}"></i>
                            @endif
                            @if($access->destroy)
                                <i class="fa fa-trash-o" id="delete" data="{{$unit->id}}"></i>
                            @endif
                        </td>
                        @endif
                    </tr>
                @endforeach
                @else    
                    <tr>
                        <td colspan="5" class="emptyMessage">Empty</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    @include("pagination")
                </div>
            </div>
        </div>
    </div>
</div>
<div id="recipientsDiv"></div>

<script>
    $(document).ready(function(){

        $(".stock_val").click(function(){
            // console.log(123);
            var id = $(this).attr('get_id');
            var id_val = $(this).attr('get_val');
            // alert(id_val);
            $.ajax({
                type: "get",
                url: "{{route('bPack.akash_stock_data')}}",
                data: {id:id, id_val:id_val},
                success: function(data)
                {
                    console.log(data);
                    if(data.stock == 1){
                        $("#stock_in"+id).show();
                        $("#stock_out"+id).hide();
                        $("#stock_publish"+id).text('Publish');
                    }else{
                        $("#stock_in"+id).hide();
                        $("#stock_out"+id).show();
                        $("#stock_publish"+id).text('Unpublish');

                    }
                },
                error:function(data){
                    console.log(data);
                }
            });


        });

    });
</script>