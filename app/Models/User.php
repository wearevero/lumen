<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    // Menyembunyikan kolom sensitif seperti password
    protected $hidden = ['Password'];

    // Kolom yang tidak dapat diisi massal
    protected $guarded = [
        'IdUser'
    ];

    protected $table = 'tuser';

    // Kolom primary key
    protected $primaryKey = 'IdUser';

    public function migratePasswordIfNeeded($password)
    {
        // Cek apakah password disimpan dalam MD5
        if (strlen($this->password) === 32) {
            $this->password = Hash::make($password);
            $this->save();
        }
    }
}
