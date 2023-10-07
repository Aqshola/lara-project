<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;
    protected $table = 'detail_invoices';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'patient_id',
        'invoice_date',
        'buy_amount',
        'price_amount',
        'patient_id',
    ];


    public function detailProduct()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }

    public function detailPatient()
    {
        return $this->hasOne(Patient::class, 'patient_id');
    }

    public function detailInvoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id');
    }
}
