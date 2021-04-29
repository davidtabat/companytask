<?php

namespace Devall\Tabatadze\Api\Data;

interface CompanyInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     * @return void
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     * @return void
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getNumber();

    /**
     * @param int $number
     * @return void
     */
    public function setNumber($number);

    /**
     * @return int
     */
    public function getCompanySize();

    /**
     * @param int $size
     * @return void
     */
    public function setCompanySize($size);
}
