<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Business extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'business';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'tag',
        'owner',
        'contact',
        'email',
        'industry',
        'description',
        'networth',
        'balance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function businessOwner()
    {
        return $this->belongsTo(User::class, 'owner', 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'receiver', 'tag');
    }
}
