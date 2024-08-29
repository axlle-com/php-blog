<?php

namespace Main\Ip\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Main\History\Model\History;

/**
 * Class Ip
 *
 * @property int $id
 * @property string $ip
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|History[] $histories
 */
class Ip extends Model
{
    use SoftDeletes;

    protected $table = 'ip';

    protected $casts = [
        'status' => 'bool',
    ];

    protected $fillable = [
        'ip',
        'status',
    ];

    /**
     * @return HasMany<History>
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
