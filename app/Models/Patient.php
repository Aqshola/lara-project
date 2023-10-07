<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'patient_id',
        'name',
        'phone'
    ];

    public function getPatientID()
    {
        $lastId = $this->select('id')->orderBy('id', 'desc')->first()->id ?? 0;
        return  sprintf('EM-%s%04d', Carbon::now()->format('ym'), $lastId + 1);
    }
}
