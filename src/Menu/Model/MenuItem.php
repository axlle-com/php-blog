<?php

namespace Main\Menu\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int|null $menu_item_id
 * @property string|null $resource
 * @property int|null $resource_id
 * @property string $title
 * @property int $sort
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Menu $menu
 * @property MenuItem|null $menuItem
 * @property Collection|MenuItem[] $menuItems
 * @property Collection|MenuItemLanguage[] $menuItemLanguages
 */
class MenuItem extends Model
{
    use SoftDeletes;

    protected $table = 'menu_item';

    protected $casts = [
        'menu_id' => 'int',
        'menu_item_id' => 'int',
        'resource_id' => 'int',
        'sort' => 'int',
    ];

    protected $fillable = [
        'menu_id',
        'menu_item_id',
        'resource',
        'resource_id',
        'title',
        'sort',
        'url',
    ];

    /**
     * @return BelongsTo<Menu, MenuItem>
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return BelongsTo<MenuItem, MenuItem>
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany<MenuItem>
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(self::class);
    }

    /**
     * @return HasMany<MenuItemLanguage>
     */
    public function menuItemLanguages(): HasMany
    {
        return $this->hasMany(MenuItemLanguage::class);
    }
}
