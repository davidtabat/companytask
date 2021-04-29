<?php

namespace Devall\Tabatadze\Model;

use Devall\Tabatadze\Api\Data\CompanyInterface;
use Magento\Framework\Model\AbstractModel;

class Company extends AbstractModel implements CompanyInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const COUNTRY = 'country';
    const STREET = 'street';
    const NUMBER = 'street_number';
    const COMPANY_SIZE = 'size';

    /**
     * Customer attribute code
     */
    const COMPANY_ATTRIBUTE_CODE = 'customer_pan_number';

    protected function _construct()
    {
        $this->_init(\Devall\Tabatadze\Model\ResourceModel\Company::class);
    }

    public function getId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    public function setId($id)
    {
        $this->setData(self::ENTITY_ID);
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName($name)
    {
        $this->setData(self::NAME);
    }

    public function getCountry()
    {
        return $this->_getData(self::COUNTRY);
    }

    public function setCountry($country)
    {
        $this->setData(self::COUNTRY);
    }

    public function getStreet()
    {
        return $this->_getData(self::STREET);
    }

    public function setStreet($street)
    {
        $this->setData(self::STREET);
    }

    public function getNumber()
    {
        return $this->_getData(self::NUMBER);
    }

    public function setNumber($number)
    {
        $this->setData(self::NUMBER);
    }

    public function getCompanySize()
    {
        return $this->_getData(self::COMPANY_SIZE);
    }

    public function setCompanySize($size)
    {
        $this->setData(self::COMPANY_SIZE);
    }
}
