<?php

namespace Main\Post\Data;

use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public string $title,
        public string $alias,
        public string $url,
        public ?int $template_id = null,
        public ?int $post_category_id = null,
        public ?string $meta_title = null,
        public ?string $meta_description = null,
        public ?bool $is_published = true,
        public ?bool $is_favourites = false,
        public ?bool $has_comments = false,
        public ?bool $show_image_post = true,
        public ?bool $show_image_category = true,
        public ?bool $make_watermark = true,
        public ?bool $in_sitemap = true,
        public ?string $media = null,
        public ?string $title_short = null,
        public ?string $description = null,
        public ?string $description_short = null,
        public ?bool $show_date = true,
        public ?string $date_pub = null,
        public ?string $date_end = null,
        public ?string $image = null,
        public ?int $hits = 0,
        public ?int $sort = 0,
        public ?float $stars = 0.0,
    ) {
    }

    /**
     * @return array<string, array<string>>
     */
    public static function rules(): array
    {
        return [
            'template_id' => ['nullable', 'integer', 'exists:template,id'],
            'post_category_id' => ['nullable', 'integer', 'exists:post_category,id'],
            'meta_title' => ['nullable', 'string', 'max:100'],
            'meta_description' => ['nullable', 'string', 'max:200'],
            'alias' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:500'],
            'is_published' => ['nullable', 'boolean'],
            'is_favourites' => ['nullable', 'boolean'],
            'has_comments' => ['nullable', 'boolean'],
            'show_image_post' => ['nullable', 'boolean'],
            'show_image_category' => ['nullable', 'boolean'],
            'make_watermark' => ['nullable', 'boolean'],
            'in_sitemap' => ['nullable', 'boolean'],
            'media' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'title_short' => ['nullable', 'string', 'max:155'],
            'description' => ['nullable', 'string'],
            'description_short' => ['nullable', 'string'],
            'show_date' => ['nullable', 'boolean'],
            'date_pub' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_end' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'image' => ['nullable', 'string', 'max:255'],
            'hits' => ['nullable', 'integer', 'min:0'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'stars' => ['nullable', 'numeric', 'min:0', 'max:5'],
        ];
    }
}
