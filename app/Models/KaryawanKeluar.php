<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

class KaryawanKeluar extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $table = 'tkaryawan_keluar';
    public $primaryKey = 'IdKeluar';
    protected $guarded = [
        'IdKeluar',
    ];
    public $timestamps = false;

    public function karyawan(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'IdKaryawan', 'IdKaryawan');
    }
}
