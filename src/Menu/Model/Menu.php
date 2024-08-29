<?php

namespace Main\Menu\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property Collection|MenuHasResource[] $menuHasResources
 * @property Collection|MenuItem[] $menuItems
 */
class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu';

    protected $fillable = [
        'title',
        'name',
        'description',
    ];

    /**
     * @return HasMany<MenuHasResource>
     */
    public function menuHasResources(): HasMany
    {
        return $this->hasMany(MenuHasResource::class);
    }

    /**
     * @return HasMany<MenuItem>
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
