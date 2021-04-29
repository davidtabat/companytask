<?php

declare(strict_types=1);

namespace Devall\Tabatadze\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class StringViewModel implements ArgumentInterface
{
    public function getMessage()
    {
        return 'Data passed from viewmodel';
    }
}
