<?php

namespace Main\Menu\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MenuItemLanguage
 *
 * @property int $id
 * @property string $title
 * @property string $language
 * @property int $menu_item_id
 * @property MenuItem $menuItem
 */
class MenuItemLanguage extends Model
{
    protected $table = 'menu_item_language';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'menu_item_id' => 'int',
    ];

    protected $fillable = [
        'title',
        'language',
    ];

    /**
     * @return BelongsTo<MenuItem, MenuItemLanguage>
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
