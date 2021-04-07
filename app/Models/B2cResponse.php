<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2cResponse extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'table_b2c_response';

    protected $fillable = [
        'ConversationID',
        'OriginatorConversationID',
        'TransactionId',
        'TransactionAmount',
        'ReceiverPartyPublicName',
        'B2CUtilityAccountAvailableFunds',
        'B2CWorkingAccountAvailableFunds',
        'TransactionCompletedDateTime',
    ];

    public static function isDuplicateResponse($ConversationID)
    {
        return self::where('ConversationID', $ConversationID)
                ->get()
                ->count() > 0;
    }
}
