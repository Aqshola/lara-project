<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'invoice_id',
        'invoice_date',
        'total_buy',
        'total_price',
        'patient_id',
    ];

    public function getProductID()
    {
        $lastId = $this->select('id')->orderBy('id', 'desc')->first()->id ?? 0;
        return  sprintf('INV-%s%04d', Carbon::now()->format('ymd'), $lastId + 1);
    }

    public function detailInvoice()
    {
        return $this->hasMany(DetailInvoice::class, 'invoice_id', 'invoice_id');
    }

    public function detailPatient()
    {
        // dd($this->patient_id);
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
}
