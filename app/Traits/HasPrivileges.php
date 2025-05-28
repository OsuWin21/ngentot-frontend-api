<?php

namespace App\Traits;

trait HasPrivileges
{
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

    /**
     * Add privileges to user
     */
    public function addPrivilege(int $privilege): void
    {
        $this->privileges |= $privilege;
        $this->save();
    }

    /**
     * Remove privileges from user
     */
    public function removePrivilege(int $privilege): void
    {
        $this->privileges &= ~$privilege;
        $this->save();
    }

    /**
     * Check if user has specific privilege
     */
    public function hasPrivilege(int $privilege): bool
    {
        return ($this->privileges & $privilege) === $privilege;
    }

    /**
     * Check if user has any of the specified privileges
     */
    public function hasAnyPrivilege(int $privileges): bool
    {
        return ($this->privileges & $privileges) !== 0;
    }

    /**
     * Get all privileges as array
     */
    public function getPrivileges(): array
    {
        $privileges = [];
        $reflection = new \ReflectionClass(__CLASS__);

        foreach ($reflection->getConstants() as $name => $value) {
            if (is_int($value)) {
                if ($this->hasPrivilege($value)) {
                    $privileges[] = $name;
                }
            }
        }

        return $privileges;
    }
}