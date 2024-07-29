<?php

declare(strict_types=1);
<<<<<<< HEAD

function sum($a, $b)
{
    return $a + $b;
}

it('sum', function () {
=======
test('sum', function () {
>>>>>>> 48f3485a273067c3f93c4ca332fb4e4ec5d5a162
    $result = sum(1, 2);

    expect($result)->toBe(3);
});
