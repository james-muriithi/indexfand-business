<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Withdraw extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'business_withdraws';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'business_id',
        'phone',
        'amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public static function isDuplicateWithdraw($businessId, $amount)
    {
        return self::where('business_id', $businessId)
            ->where('amount', $amount)
            ->where('created_at', '>',Carbon::now()->subSeconds(90)->toDateTimeString())
            ->get()
            ->count() > 0;
    }
}
