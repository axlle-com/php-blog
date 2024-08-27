<?php
namespace Main\Post\Model;

use App\Models\InfoBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PostHasInfoBlock
 *
 * @property int $post_id
 * @property int $info_block_id
 * @property int $sort
 *
 * @property InfoBlock $info_block
 * @property Post $post
 *
 * @package App\Models
 */
class PostHasInfoBlock extends Model
{
	protected $table = 'post_has_info_block';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'post_id' => 'int',
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

	public function post(): BelongsTo
    {
		return $this->belongsTo(Post::class);
	}
}
