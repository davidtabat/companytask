<?php

namespace Devall\Tabatadze\Api\Data;

interface CompanyInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $country
     * @return void
     */
    public function setCountry(string $country);

    /**
     * @return string
     */
    public function getStreet(): string;

    /**
     * @param string $street
     * @return void
     */
    public function setStreet(string $street);

    /**
     * @return int
     */
    public function getNumber(): int;

    /**
     * @param int $number
     * @return void
     */
    public function setNumber(int $number);

    /**
     * @return int
     */
    public function getCompanySize(): int;

    /**
     * @param int $size
     * @return void
     */
    public function setCompanySize(int $size);
}
