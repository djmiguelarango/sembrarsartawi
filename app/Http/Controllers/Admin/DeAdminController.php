<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\ProductParameter;
use Sibas\Entities\Retailer;
use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;

class DeAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list_parameter'){

            $sql = RetailerProduct::join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                                  ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                                  ->select('ad_retailer_products.id as id_retailer_product', 'ad_retailer_products.type', 'ad_retailer_products.billing', 'ad_retailer_products.provisional_certificate', 'ad_retailer_products.modality', 'ad_retailer_products.facultative', 'ad_retailer_products.ws', 'ad_retailer_products.active', 'ad_products.name as producto')
                                  ->where('ad_retailer_products.id', '=', $id_retailer_product)
                                  ->get();
            //dd($sql);
            return view('admin.de.parameters.list-parameter', compact('nav', 'action', 'sql', 'id_retailer_product', 'main_menu', 'array_data'));
        }
    }

    public function index_parameter($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list_parameter_additional'){
            $query = \DB::table('ad_product_parameters')
                          ->where('ad_retailer_product_id', '=', $id_retailer_product)
                          ->get();
            //dd($id_retailer_product);
            return view('admin.de.parameters.list-parameter-additional', compact('nav', 'action', 'query', 'id_retailer_product', 'main_menu','array_data'));
        }elseif($action=='new_parameter_additional'){
            //dd($id_retailer_product);
            return view('admin.de.parameters.new-parameter-additional', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data'));
        }
    }

    public function index_parameter_additional($nav, $action, $id_product_parameters, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='edit_parameter_additional'){
            //dd($id_retailer_product);
            $query = ProductParameter::where('id',$id_product_parameters)
                                     ->where('ad_retailer_product_id',$id_retailer_product)
                                     ->first();
            //dd($query);
            return view('admin.de.parameters.edit-parameter-additional', compact('nav', 'action', 'id_product_parameters', 'id_retailer_product', 'query', 'main_menu', 'array_data'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $parameter = config('base.product_parameters');
            $name = $parameter[$request->input('prod_param')];
            $id_retailer_product = $request->input('id_retailer_product');
            $query_int = new ProductParameter();
            $query_int->ad_retailer_product_id = $id_retailer_product;
            $query_int->name = $name;
            $query_int->slug = $request->input('prod_param');
            $query_int->age_min = $request->input('edad_min');
            $query_int->age_max = $request->input('edad_max');
            $query_int->amount_min = $request->input('monto_min');
            $query_int->amount_max = $request->input('monto_max');
            $query_int->expiration = $request->input('caduc');
            $query_int->detail = $request->input('num_titu');
            if ($query_int->save()) {
                return redirect()->route('admin.de.parameters.list-parameter-additional', ['nav' => 'de', 'action' => 'list_parameter_additional', 'id_retailer_product' => $id_retailer_product])->with(array('ok'=>'Se registro correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='edit_parameter'){
            $query = \DB::table('ad_retailer_products')
                ->join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                ->select('ad_retailer_products.type', 'ad_retailer_products.billing', 'ad_retailer_products.provisional_certificate', 'ad_retailer_products.modality', 'ad_retailer_products.facultative', 'ad_retailer_products.ws', 'ad_products.name as producto', 'ad_retailer_products.ad_retailer_id')
                ->where('ad_retailer_products.id', '=', $id_retailer_product)
                ->get();
            //dd($query);
            return view('admin.de.parameters.edit-parameter', compact('nav', 'action', 'query', 'id_retailer_product', 'main_menu', 'array_data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $retailer_update = RetailerProduct::find($request->input('id_retailer_product'));
            $retailer_update->billing=$request->input('fact');
            $retailer_update->provisional_certificate=$request->input('cert');
            $retailer_update->modality=$request->input('moda');
            $retailer_update->facultative=$request->input('facu');
            $retailer_update->ws=$request->input('webs');
            if($retailer_update->save()) {
                return redirect()->route('admin.de.parameters.list-parameter', ['nav' => 'de', 'action' => 'list_parameter', 'id_retailer_product'=>$request->input('id_retailer_product')])->with(array('ok'=>'Se edito correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }

    }

    public function update_data(Request $request)
    {
        try {
            $parameter = config('base.product_parameters');
            $name = $parameter[$request->input('prod_param')];
            $query_update = ProductParameter::where('id', $request->input('id_product_parameter'))->where('ad_retailer_product_id', $request->input('id_retailer_product'))->first();
            $query_update->name = $name;
            $query_update->slug = $request->input('prod_param');
            $query_update->age_min = $request->input('edad_min');
            $query_update->age_max = $request->input('edad_max');
            $query_update->amount_min = $request->input('monto_min');
            $query_update->amount_max = $request->input('monto_max');
            $query_update->expiration = $request->input('caduc');
            $query_update->detail = $request->input('num_titu');
            if ($query_update->save()) {
                return redirect()->route('admin.de.parameters.list-parameter-additional', ['nav' => 'de', 'action' => 'list_parameter_additional', 'id_retailer_product' => $request->input('id_retailer_product')])->with(array('ok'=>'Se edito correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }

        //dd($request->input('id_retailer_product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * AJAX
     **/
    public function ajax_delete($id_product_parameters, $ad_retailer_product_id)
    {
        try{
            $query_del = \DB::table('ad_product_parameters')
                ->where('id', $id_product_parameters)
                ->where('ad_retailer_product_id', $ad_retailer_product_id)
                ->delete();
            return '1|Se elimino correctamente el registro';
        }catch (QueryException $e){
            return '0|'.$e->getMessage();
        }
    }
}
