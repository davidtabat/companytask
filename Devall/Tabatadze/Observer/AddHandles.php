<?php

namespace Devall\Tabatadze\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddHandles implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if($product->hasData('expiry_date')) {
            if ($product->getData('expiry_date') < date('Y-m-d H:m:s')) {
                $product->setData('is_salable', false);
            }
        }
    }
}
