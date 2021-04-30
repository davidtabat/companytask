<?php

declare(strict_types=1);

namespace Devall\Tabatadze\Model;

use Devall\Tabatadze\Api\CompanyRepositoryInterface;
use Devall\Tabatadze\Api\Data\CompanyInterface;
use Devall\Tabatadze\Api\Data\CompanySearchResultInterface;
use Devall\Tabatadze\Model\ResourceModel\Company;
use Devall\Tabatadze\Model\ResourceModel\Company\Collection;
use Devall\Tabatadze\Model\ResourceModel\Company\CollectionFactory;
use Devall\Tabatadze\Api\Data\CompanySearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var CompanyFactory
     */
    public $companyFactory;

    /**
     * @var Company
     */
    public $ResourceModel;

    /**
     * @var CollectionFactory
     */
    public $collectionFactory;

    /**
     * @var Collection
     */
    public $collection;

    /**
     * @var Company
     */
    private $companyResourceModel;

    /**
     * @var CompanySearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * CompanyRepository constructor.
     * @param CompanyFactory $companyFactory
     * @param Company $companyResourceModel
     * @param CollectionFactory $collectionFactory
     * @param Collection $collection
     * @param CompanySearchResultInterfaceFactory $companySearchResultInterfaceFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CompanyFactory $companyFactory,
        Company $companyResourceModel,
        CollectionFactory $collectionFactory,
        Collection $collection,
        CompanySearchResultInterfaceFactory $companySearchResultInterfaceFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collection;
        $this->companyFactory = $companyFactory;
        $this->companyResourceModel = $companyResourceModel;
        $this->searchResultFactory = $companySearchResultInterfaceFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $id): \Devall\Tabatadze\Model\Company
    {
        $company = $this->companyFactory->create();
        $this->companyResourceModel->load($company, $id);
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function save(CompanyInterface $company): CompanyInterface
    {
        $this->companyResourceModel->save($company);
        return $company;
    }

    /**
     * @inheritdoc
     */
    public function delete(CompanyInterface $company): void
    {
        $this->companyResourceModel->delete($company);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CompanySearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return CompanySearchResultInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function getByIdApi($id): array
    {
        return $this->getById($id)->getData();
    }

    /**
     * @inheritdoc
     */
    public function getListApi(): array
    {
        return $this->collection->getData();
    }
}
