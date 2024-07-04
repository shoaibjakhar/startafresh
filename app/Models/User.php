<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ClientIncome;
use App\Models\ClientExpenditure;
use App\Models\ClientDetail;
use App\Models\ClientDebt;
use App\Models\CreditorOffice;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clientIncomes() {
        return $this->hasMany(ClientIncome::class);
    }

    public function clientExpenditures() {
        return $this->hasMany(ClientExpenditure::class);
    }

    public function clientDetails() {
        return $this->hasOne(ClientDetail::class);
    }

    public function clientDebts() {
        return $this->hasMany(ClientDebt::class);
    }

    public function creditorOffice() {
        return $this->hasOne(CreditorOffice::class, 'creditor_office_id', 'id');
    }




}
