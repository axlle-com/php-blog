<?php

namespace Main\User\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Main\History\Model\History;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property string|null $phone
 * @property string $email
 * @property bool $is_email
 * @property bool $is_phone
 * @property int $status
 * @property string|null $avatar
 * @property string $password_hash
 * @property string|null $remember_token
 * @property string|null $auth_token
 * @property string|null $auth_key
 * @property string|null $password_reset_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|History[] $histories
 * @property Collection|UserToken[] $userTokens
 */
class User extends Model
{
    use SoftDeletes;

    protected $table = 'user';

    protected $casts = [
        'is_email' => 'bool',
        'is_phone' => 'bool',
        'status' => 'int',
    ];

    protected $hidden = [
        'remember_token',
        'auth_token',
        'password_reset_token',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'email',
        'is_email',
        'is_phone',
        'status',
        'avatar',
        'password_hash',
        'remember_token',
        'auth_token',
        'auth_key',
        'password_reset_token',
    ];

    /**
     * @return HasMany<History>
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return HasMany<UserToken>
     */
    public function userTokens(): HasMany
    {
        return $this->hasMany(UserToken::class);
    }
}
