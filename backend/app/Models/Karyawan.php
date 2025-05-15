<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;

class Karyawan extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $table = 'tkaryawan_pribadi';
    public $primaryKey = 'IdKaryawan';
    protected $guarded = [
        'IdKaryawan',
    ];
    public $timestamps = false;

    public function bagian(): BelongsTo
    {
        return $this->belongsTo(Bagian::class, 'IdBagian', 'IdBagian');
    }
}
