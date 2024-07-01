<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PaymentsFromClients;
use App\Models\paymentsToCreditors;


class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function user2() {
        return $this->belongsTo(User::class, 'user_id2');
    }

    public function paymentsFromClients() {
        return $this->hasMany(PaymentsFromClients::class);
    }

    public function paymentsToCreditors() {
        return $this->hasMany(paymentsToCreditors::class);
    }
    
}
