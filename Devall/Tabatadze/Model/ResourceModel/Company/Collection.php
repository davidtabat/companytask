<?php


namespace Devall\Tabatadze\Model\ResourceModel\Company;


use Devall\Tabatadze\Model\Company;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Company::class,\Devall\Tabatadze\Model\ResourceModel\Company::class);
    }
}
