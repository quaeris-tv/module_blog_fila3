<?php

declare(strict_types=1);

function sum($a, $b) {
   return $a + $b;
}

it('sum', function () {
   $result = sum(1, 2);
 
   expect($result)->toBe(3);
});
