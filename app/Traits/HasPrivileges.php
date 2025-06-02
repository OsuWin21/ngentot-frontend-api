<?php

namespace App\Traits;

trait HasPrivileges
{
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
        $this->priv &= ~$privilege;
        $this->save();
    }

    /**
     * Check if user has specific privilege
     */
    public function hasPrivilege(int $privilege): bool
    {
        return ($this->priv & $privilege) === $privilege;
    }

    /**
     * Check if user has any of the specified privileges
     */
    public function hasAnyPrivilege(int $privileges): bool
    {
        return ($this->priv & $privileges) !== 0;
    }

    /**
     * Get all privileges as array
     */
    public function getPrivileges(): array
    {
        $privileges = [];
        $reflection = new \ReflectionClass(\App\Models\User::class);

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