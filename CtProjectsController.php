<?php

namespace App\Http\Controllers\Bpack;

use Illuminate\Http\Request;
use DB;
use Auth;
use Helper;
use Validator;
use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Branch_user;
use App\Model\PosProducts;
use App\Model\BranchProductDetails;

class CtProjectsController extends Controller
{
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        
        return view('bPack.ctProjects.list', $data);
    }

    public function ctProjectsListData(Request $request) {
        $data = $request->all();
        $search = $request->search;

        $data['access'] = Helper::userPageAccess($request);
        $ascDesc = Helper::ascDesc($data, ['branch_name']);
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;

        $data['ct_projects'] = Branch_user::valid()
            ->where(function($query) use ($search)
            {
                $query->where('branch_name', 'LIKE', '%'.$search.'%');
            })
            ->orderBy($ascDesc[0], $ascDesc[1])
            ->paginate($paginate->perPage);

        return view('bPack.ctProjects.listData', $data);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        return view('bPack.ctProjects.create', $data);
    }

    public function store(Request $request)
    {

   
        $output = array();
        $input =  $request->all();
        
        $validator = Validator::make($input, [
            'project_name' => 'required',
            'land_area'    => 'required',
            'owner_name'   => 'required',
            'product_id.*' => 'required',
            'quantity'     => 'required',
        ]);


        if( !empty($request->start_date) || !empty($request->end_date) ){
            $start_date =  DateTime::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
            $end_date   = DateTime::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');
        }else{
            $start_date =  date('Y-m-d');
            $end_date   = date('Y-m-d');
        }

        if ($validator->passes()) {
            Branch_user::create([
                'branch_name'    => $request->project_name,
                'land_area'      => $request->land_area,
                'owner_name'     => $request->owner_name,
                'start_date'     => $start_date,
                'end_date'       => $end_date
            ]);


            $branch_products = $request->input('product_id');

            $lastInsertId = DB::getPdo()->lastInsertId();

            $quantity = $request->input('quantity');


            foreach($branch_products as $key=>$branch_product) {

                $single_product_price = PosProducts::find($branch_product);

                if ($validator->passes()) {
                    BranchProductDetails::create([
                        'branch_id'     => $lastInsertId,
                        'product_id'    => $branch_product,
                        'quantity'      => $quantity[$key],
                        'product_price' => $single_product_price->purchase_price,
                        'total_price'   => $single_product_price->purchase_price * $quantity[$key],
                    ]);
                }

            }

            



            $output['messege'] = 'Project has been created';
            $output['msgType'] = 'success'; 

        } else {
            $output = Helper::vError($validator);
        }





        echo json_encode($output);
    }


    public function edit($id)
    {

        $data['branch_products_details'] = BranchProductDetails::where('branch_id',$id)->get();
        $data['branch_products_price_sum'] = BranchProductDetails::where('branch_id',$id)->sum('total_price');
        $data['project'] = Branch_user::valid()->find($id);

        return view('bPack.ctProjects.update', $data);
    }

    public function update(Request $request, $id)
    {
        $output = array();
        $input =  $request->all();
        
        $validator = Validator::make($input, [
            'project_name'   => 'required',
            'land_area'      => 'required',
            'owner_name'     => 'required',
            'branch_product' => 'required',
            'quantity'       => 'required',
        ]);

        if( !empty($request->start_date) || !empty($request->end_date) ){
            $start_date =  DateTime::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
            $end_date   = DateTime::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');
        }else{
            $start_date =  date('Y-m-d');
            $end_date   = date('Y-m-d');
        }


        if ($validator->passes()) {
            Branch_user::find($id)->update([
                'branch_name'    => $request->project_name,
                'land_area'      => $request->land_area,
                'owner_name'     => $request->owner_name,
                'start_date'     => $start_date,
                'end_date'       => $end_date
            ]);
            


            BranchProductDetails::valid()->where('branch_id',$id)->delete();

            $branch_products = $request->input('branch_product');
            

            $quantity = $request->input('quantity');


            foreach($branch_products as $key=>$branch_product) {

                $single_product_price = PosProducts::find($branch_product);

                if ($validator->passes()) {
                    BranchProductDetails::create([
                        'branch_id'     => $id,
                        'product_id'    => $branch_product,
                        'quantity'      => $quantity[$key],
                        'product_price' => $single_product_price->purchase_price,
                        'total_price'   => $single_product_price->purchase_price *  $quantity[$key],
                    ]);
                }

            }










            $output['messege'] = 'Project has been updated';
            $output['msgType'] = 'success'; 
        } else {
            $output = Helper::vError($validator);
        }
        echo json_encode($output);   
    }

    public function destroy($id)
    {
        Branch_user::valid()->find($id)->delete();
        BranchProductDetails::valid()->where('branch_id',$id)->delete();

        
    }

    public function pos_product_view(){
        $pos_products = PosProducts::all();
        return response()->json([
            'materials_show_pos_product'=>$pos_products,
        ]);
    }
    public function pos_product_view_single(Request $request){
     $id = $request->id;
     $pos_products = PosProducts::find($id);
     return response()->json([
        'materials_show_pos_product_single'=>$pos_products,
    ]);
    }
}
