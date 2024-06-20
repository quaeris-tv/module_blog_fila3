<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Webmozart\Assert\Assert;
use Modules\Rating\Models\RatingMorph;

class Transaction extends BaseModel
{
    /** @var string */
    protected $connection = 'blog';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['date', 'model_type', 'model_id', 'user_id', 'credits', 'note'];

    public function getRatingMorph(): RatingMorph
    {
        Assert::notNull($rating_morph = RatingMorph::where('rating_id', $this->model_id)->first());

        return $rating_morph;
    }
}
