<?php

namespace App\Http\Controllers;

use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $invoices;

    public function __construct()
    {
        $this->invoices = new Invoice();
    }
    public function index()
    {
        $listInvoice = $this->invoices->all();

        return view("invoice.index", ['listInvoice' => $listInvoice]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generateId = $this->invoices->getProductID();
        $listPatient = Patient::all();
        $listProduct = Product::all();
        return view('invoice.create', ['generateId' => $generateId, 'listPatient' => $listPatient, 'listProduct' => $listProduct]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required',
            'idinvoice' => 'required',
            'product.*' => 'required|min:1',
            'buy.*' => 'required|min:1',
        ]);

        $reqData = $request->all();



        $total_price_all = 0;
        $total_buy_all = 0;
        $list_buy = [];

        for ($i = 0; $i < count($reqData['product']); $i++) {
            $productId = $reqData['product'][$i];
            $buyProduct = $reqData['buy'][$i];
            $productPrice = Product::where('product_id', $productId)->first()->price;
            $totalPrice = $buyProduct * $productPrice;



            $data_detail_invoice = [
                'invoice_id' => $reqData['idinvoice'],
                'product_id' => $productId,
                'patient_id' => $reqData['patient'],
                'buy_amount' => $buyProduct,
                'price_amount' => $totalPrice,
                'invoice_date' => Carbon::now(),
            ];

            array_push($list_buy, $data_detail_invoice);
            $total_price_all += $totalPrice;
            $total_buy_all += $buyProduct;
        }


        try {
            DB::beginTransaction();
            $this->invoices->create([
                'invoice_id' => $reqData['idinvoice'],
                "invoice_date" => Carbon::now(),
                'total_buy' => $total_buy_all,
                'total_price' => $total_price_all,
                "patient_id" => $reqData['patient']
            ]);

            DetailInvoice::insert($list_buy);
            DB::commit();
            return Redirect(route('invoice.index'))->with('success', 'New Transaction');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function print($id)
    {
        $data = Invoice::where('invoice_id', $id)->first();
        $pdf = Pdf::loadView('invoice.print', ['data' => $data]);
        return $pdf->stream('invoice.pdf');
    }
}
