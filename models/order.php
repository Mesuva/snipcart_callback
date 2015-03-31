<?php
namespace Concrete\Package\SnipcartCallback\Models;

use Log;

class Order
{
    public function orderPlaced($event)
    {
        Log::addEntry(print_r($event->getEventData(), true));
    }

}
