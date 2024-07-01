<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditorOffice;

class CcjAmounts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creditor_office()
    {
        return $this->belongsTo(CreditorOffice::class, 'creditor_office_id');

    }
}
