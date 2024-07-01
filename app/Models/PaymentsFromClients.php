<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application;
use App\Models\CreditorOffice;

class PaymentsFromClients extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function application() {
        return $this->belongsTo(Application::class);
    }

    public function creditorOffice() {
        return $this->belongsTo(CreditorOffice::class, 'creditor_office_id');
    }
}
