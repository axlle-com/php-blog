<?php
namespace Main\Post\Model;

use App\Models\InfoBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PostCategoryHasInfoBlock
 *
 * @property int $post_category_id
 * @property int $info_block_id
 * @property int $sort
 *
 * @property InfoBlock $infoBlock
 * @property PostCategory $postCategory
 *
 * @package App\Models
 */
class PostCategoryHasInfoBlock extends Model
{
	protected $table = 'post_category_has_info_block';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'post_category_id' => 'int',
		'info_block_id' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'sort'
	];

	public function infoBlock(): BelongsTo
    {
		return $this->belongsTo(InfoBlock::class);
	}

	public function postCategory(): BelongsTo
    {
		return $this->belongsTo(PostCategory::class);
	}
}
