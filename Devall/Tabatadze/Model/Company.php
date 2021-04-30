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

    protected function _construct() {
        $this->_init(ResourceModel\Company::class);
    }

    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($id): void
    {
        $this->setData(self::ENTITY_ID);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName(string $name): void
    {
        $this->setData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function getCountry(): string
    {
        return $this->_getData(self::COUNTRY);
    }

    /**
     * @inheritdoc
     */
    public function setCountry(string $country): void
    {
        $this->setData(self::COUNTRY);
    }

    /**
     * @inheritdoc
     */
    public function getStreet(): string
    {
        return $this->_getData(self::STREET);
    }

    /**
     * @inheritdoc
     */
    public function setStreet(string $street): void
    {
        $this->setData(self::STREET);
    }

    /**
     * @inheritdoc
     */
    public function getNumber(): int
    {
        return $this->_getData(self::NUMBER);
    }

    /**
     * @inheritdoc
     */
    public function setNumber(int $number): void
    {
        $this->setData(self::NUMBER);
    }

    /**
     * @inheritdoc
     */
    public function getCompanySize(): int
    {
        return $this->_getData(self::COMPANY_SIZE);
    }

    /**
     * @inheritdoc
     */
    public function setCompanySize(int $size): void
    {
        $this->setData(self::COMPANY_SIZE);
    }
}
