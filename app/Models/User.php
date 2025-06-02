<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPrivileges;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPrivileges;
    
    // Privilege Constants
    const UNRESTRICTED    = 1 << 0;   // is an unbanned player.
    const VERIFIED        = 1 << 1;   // has logged in to the server in-game.
    const WHITELISTED     = 1 << 2;   // bypass anti-cheat.
    const SUPPORTER       = 1 << 4;   // donator tier.
    const PREMIUM         = 1 << 5;   // donator tier.
    const ALUMNI          = 1 << 7;   // notable users.
    const TOURNEY_MANAGER = 1 << 10;  // manage match state without host.
    const NOMINATOR       = 1 << 11;  // manage maps ranked status.
    const MODERATOR       = 1 << 12;  // manage users (level 1).
    const ADMINISTRATOR   = 1 << 13;  // manage users (level 2).
    const DEVELOPER       = 1 << 14;  // manage full server state.

    // Combined Privileges
    const DONATOR = self::SUPPORTER | self::PREMIUM;
    const STAFF = self::MODERATOR | self::ADMINISTRATOR | self::DEVELOPER;

    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'priv', // atau 'privileges' tergantung nama kolom di database
        'pw_bcrypt',
        'country'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pw_bcrypt',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'priv' => 'integer', // atau 'privileges' tergantung nama kolom
        'pw_bcrypt' => 'hashed',
    ];

    /**
     * Untuk kompatibilitas dengan trait HasPrivileges
     * Jika kolom di database bernama 'priv' tapi trait menggunakan 'privileges'
     */
    public function getPrivilegesAttribute()
    {
        return $this->priv;
    }

    public function setPrivilegesAttribute($value)
    {
        $this->attributes['priv'] = $value;
    }
}