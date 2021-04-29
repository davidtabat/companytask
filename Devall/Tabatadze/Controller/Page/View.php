<?php

declare(strict_types=1);

namespace Devall\Tabatadze\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Result\Page;

class View extends Action
{
    public function execute()
    {
        /** @var Page $resultPage */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $block = $page->getLayout()->getBlock('devall.first.layout.example');
        $block->setData('custom_parameter', 'Data from the Controller');
        return $page;
    }
}

