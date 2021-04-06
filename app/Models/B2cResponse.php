<?php

namespace App\Models;

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
}
