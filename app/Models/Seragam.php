<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seragam extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $table = 'tseragam_karyawan';
    public $primaryKey = 'IdSeragam';
    protected $guarded = [
        'IdSeragam',
    ];
    public $timestamps = false;
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'IdKaryawan', 'IdKaryawan');
    }
}
