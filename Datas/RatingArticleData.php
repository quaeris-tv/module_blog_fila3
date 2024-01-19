<?php

<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);
=======
>>>>>>> e600cc0 (.)
=======
declare(strict_types=1);
>>>>>>> 934879b (Lint)

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

<<<<<<< HEAD
<<<<<<< HEAD
class RatingArticleData extends Data
{
=======

class RatingArticleData extends Data{

>>>>>>> e600cc0 (.)
=======
class RatingArticleData extends Data
{
>>>>>>> 934879b (Lint)
    public string $userId;
    public string $articleId;
    public string $ratingId;
    public int $credit;
}
