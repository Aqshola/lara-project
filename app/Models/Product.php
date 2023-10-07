<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_id',
        'name',
        'stock',
        'price',
    ];



    public function getProductID()
    {
        $lastId = $this->select('id')->orderBy('id', 'desc')->first()->id ?? 0;
        return  sprintf('P-%s%04d', Carbon::now()->format('ym'), $lastId + 1);
    }
}
