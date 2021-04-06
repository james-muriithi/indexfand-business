<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $table = 'business_withdraw_requests';

    public $timestamps = false;

    protected $fillable = [
        'ConversationID',
        'OriginatorConversationID',
        'amount',
        'business_id',
        'status'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public static function isDuplicateWithdraw($businessId, $amount)
    {
        return self::where('business_id', $businessId)
                ->where('amount', $amount)
                ->where('date', '>',Carbon::now()->subSeconds(90)->toDateTimeString())
                ->get()
                ->count() > 0;
    }
}
