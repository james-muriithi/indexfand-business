<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StkRequest extends Model
{
    protected $table = 'tbl_stk_request';

    public $timestamps = false;

    protected $fillable = [
        'RequestId',
        'MSISDN',
        'BillRefNumber',
        'Amount',
        'paid',
        'RequestDate',
        'business_callback_url'
    ];

//    public function response()
//    {
//        return $this->hasOne(StkResponse::class, 'request_id');
//    }
}
