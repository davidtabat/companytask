<?php

namespace Devall\Tabatadze\Api;

use Devall\Tabatadze\Api\Data\CompanyInterface;
use Devall\Tabatadze\Api\Data\CompanySearchResultInterface;
use Devall\Tabatadze\Model\Company;
use Devall\Tabatadze\Model\ResourceModel\Company\Collection;
use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CompanyRepositoryInterface
{
    /**
     * @param int $id
     * @return Company
     * @throws NoSuchEntityException
     */
    public function getById(int $id): Company;

    /**
     * @param CompanyInterface $company
     * @return CompanyInterface
     * @throws AlreadyExistsException
     */
    public function save(CompanyInterface $company): CompanyInterface;

    /**
     * @param CompanyInterface $company
     * @return void
     * @throws Exception
     */
    public function delete(CompanyInterface $company): void;

    /**
     * @param int $id
     * @return array
     * @throws NoSuchEntityException
     */
    public function getByIdApi($id): array;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CompanySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CompanySearchResultInterface;

    /**
     * @return Collection[]
     * @throws NoSuchEntityException
     */
    public function getListApi(): array;
}
