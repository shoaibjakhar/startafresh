<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClientDebt;
use App\Models\CcjAmounts;

class CreditorOffice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clientDebts()
    {
        return $this->hasMany(ClientDebt::class, 'creditor_office_id');
    }

    public function ccjAmounts()
    {
        return $this->hasOne(CcjAmounts::class, 'creditor_office_id');
    }
}
