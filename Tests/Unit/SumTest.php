<?php

declare(strict_types=1);

function sum($a, $b): float|int|array
{
    return $a + $b;
}

it('sum', function (): void {
    $result = sum(1, 2);

    expect($result)->toBe(3);
});
