<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

class AbsenHarianJam extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $table = 'tabsen_jam';
    public $primaryKey = 'IdAbsenJam';
    protected $guarded = [
        'IdAbsenJam',
    ];
    public $timestamps = false;

    public function karyawan(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'IdKaryawan', 'IdKaryawan');
    }

    public function bagian(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'IdBagian', 'IdBagian');
    }
}
