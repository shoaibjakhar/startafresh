<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function application() {
        return $this->belongsTo(Application::class);
    }
}
