<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private $products;

    public function __construct()
    {
        $this->products = new Product();
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listProduct = $this->products->all();
        return view("product.index", ['listProduct' => $listProduct]);
    }


    public function create()
    {
        $generateId = $this->products->getProductID();
        return view('product.create', ['generateId' => $generateId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idproduct' => 'required',
            'nameproduct' => 'required',
            'stockproduct' => 'required',
            'priceproduct' => 'required'
        ]);


        $productRequest = $request->all();
        try {
            DB::beginTransaction();
            $this->products->create([
                'product_id' => $productRequest['idproduct'],
                'name' => $productRequest['nameproduct'],
                'stock' => $productRequest['stockproduct'],
                'price' => $productRequest['priceproduct'],
            ]);
            DB::commit();
            return Redirect::to(route('product.index'))->with('success', 'Success add new data');
        } catch (Exception $e) {
            DB::rollBack();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $dataProduct = $this->products->where('product_id', $id)->first();
        return view('product.update', ['data' => $dataProduct]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nameproduct' => 'required',
            'stockproduct' => 'required',
            'priceproduct' => 'required'
        ]);


        $productRequest = $request->all();
        try {
            DB::beginTransaction();
            $this->products->where('product_id', $id)->update([
                'name' => $productRequest['nameproduct'],
                'stock' => $productRequest['stockproduct'],
                'price' => $productRequest['priceproduct'],
            ]);
            DB::commit();
            return Redirect::to(route('product.index'))->with('success', "Success update product $id");
        } catch (Exception $e) {
            DB::rollBack();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->products->where('product_id', $id)->delete();
            DB::commit();
            return Redirect(route('product.index'))->with('success', 'Data has been deleted');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
