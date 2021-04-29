<?php

namespace Devall\Tabatadze\Api;

use Devall\Tabatadze\Api\Data\CompanyInterface;
use Devall\Tabatadze\Model\ResourceModel\Company\Collection;

interface CompanyRepositoryInterface
{
    /**
     * @param int $id
     * @return \Devall\Tabatadze\Api\Data\CompanyRepository
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param CompanyInterface $company
     * @return CompanyInterface
     */
    public function save(CompanyInterface $company);

    /**
     * @param CompanyInterface $company
     * @return void
     */
    public function delete(CompanyInterface $company);

    /**
     * @param int $id
     * @return \Devall\Tabatadze\Api\Data\CompanyRepository
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByIdApi($id);

    /**
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getList();


}
