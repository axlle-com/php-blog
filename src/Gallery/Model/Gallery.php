<?php
namespace Main\Gallery\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Gallery
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int $sort
 * @property string|null $image
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|GalleryHasResource[] $galleryHasResources
 * @property Collection|GalleryImage[] $galleryImages
 *
 * @package App\Models
 */
class Gallery extends Model
{
	use SoftDeletes;
	protected $table = 'gallery';

	protected $casts = [
		'sort' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'sort',
		'image',
		'url'
	];

	public function galleryHasResources(): HasMany
    {
		return $this->hasMany(GalleryHasResource::class);
	}

	public function galleryImages(): HasMany
    {
		return $this->hasMany(GalleryImage::class);
	}
}
