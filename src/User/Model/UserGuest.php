<?php

namespace Main\User\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserGuest
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class UserGuest extends Model
{
    use SoftDeletes;

    protected $table = 'user_guest';

    protected $fillable = [
        'email',
        'name',
    ];
}
