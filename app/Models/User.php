<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [ 'is_admin' ];

    /**
     * Check if user is admin.
     *
     * @return bool
     */
    public function isAdmin() {
        return true;
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function orders() {
        return $this->hasMany('App\Models\Order', 'email', 'email');
    }

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessToken() {
        return $this->hasMany('App\Models\OauthAccessToken');
    }

    /**
     * @return mixed
     */
    public function logout() {
        return $this->accessToken()->delete();
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute() {
        return $this->hasRole('admin');
    }
}
