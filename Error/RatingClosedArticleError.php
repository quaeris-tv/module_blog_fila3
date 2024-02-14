<?php

declare(strict_types=1);

namespace Modules\Blog\Error;

class RatingClosedArticleError extends \DomainException
{
    public function __construct(string $articleId, string $userId, string $ratingId, int $credit)
    {
        parent::__construct("The article <fg=yellow>{$articleId}</>
            is closed. Rating <fg=yellow>{$ratingId}</>
            with credit <fg=yellow>{$credit}</> not allowed
            ");
    }
}
