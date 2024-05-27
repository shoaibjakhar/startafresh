<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditorOffice;

class ClientDebt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditorOffice()
    {
        return $this->belongsTo(CreditorOffice::class, 'creditor_office_id');
    }
}
