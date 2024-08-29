<?php

namespace Main\History\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Main\Ip\Model\Ip;
use Main\User\Model\User;

/**
 * Class History
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $ip_id
 * @property string $resource
 * @property int $resource_id
 * @property string $event
 * @property string|null $body
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Ip|null $ip
 * @property User|null $user
 */
class History extends Model
{
    use SoftDeletes;

    protected $table = 'history';

    protected $casts = [
        'user_id' => 'int',
        'ip_id' => 'int',
        'resource_id' => 'int',
    ];

    protected $fillable = [
        'user_id',
        'ip_id',
        'resource',
        'resource_id',
        'event',
        'body',
        'description',
    ];

    /**
     * @return BelongsTo<Ip, History>
     */
    public function ip(): BelongsTo
    {
        return $this->belongsTo(Ip::class);
    }

    /**
     * @return BelongsTo<User, History>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
