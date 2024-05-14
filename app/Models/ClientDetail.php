<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class ClientDetail extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
