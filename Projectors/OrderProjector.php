<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use App\Events\ProductPurchased;
use App\Models\Order;
use App\Models\Product;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class OrderProjector extends Projector
{
    public function onaddStats(ProductPurchased $event)
    {
        dddx('order projector');

        // $product = Product::withProductId($event->productId);

        // $data = (array)$event;

        // $data['total'] = $product->price * $event->quantity;

        // Order::create($data);
    }
}
