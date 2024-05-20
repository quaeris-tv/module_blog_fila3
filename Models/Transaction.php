<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

<<<<<<< HEAD
=======
use Modules\Rating\Models\RatingMorph;

>>>>>>> 2286e596f2d0857a17859f5c7534d9885275d33f
class Transaction extends BaseModel
{
    /** @var string */
    protected $connection = 'blog';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['date', 'model_type', 'model_id', 'user_id', 'credits', 'note'];
<<<<<<< HEAD
=======

    public function getRatingMorph(): RatingMorph
    {
        $rating_morph = RatingMorph::where('rating_id', $this->model_id)->first();

        return $rating_morph;
    }
>>>>>>> 2286e596f2d0857a17859f5c7534d9885275d33f
}
