<?php
namespace Devall\Tabatadze\Block;

use Devall\Tabatadze\Model\Company;
use Devall\Tabatadze\Model\ResourceModel\Company\Collection;
use Magento\Framework\View\Element\Template;
use Devall\Tabatadze\Model\CompanyRepository;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CompanyList extends Template
{
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepositoryInterface;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;
    /**
     * @var CustomerSession
     */
    private $customerSession;


    /**
     * CompanyList constructor.
     * @param CustomerSession $customerSession
     * @param CompanyRepository $companyRepository
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        CustomerSession $customerSession,
        CompanyRepository $companyRepository,
        CustomerRepositoryInterface $customerRepositoryInterface,
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return Collection
     */
    public function getCompanies(){
        return $this->collection;
    }

    /**
     * Return the save action Url.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getUrl('devall/company/editpost');
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerSession->getId();
    }

    /**
     * returns company id of current customer or false if company is not assigned yet.
     * @return false|int
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentCompany(){
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE);
        if (!empty($companyId)) {
            return $companyId->getValue();
        }
        return false;
    }

    /**
     * @return \Devall\Tabatadze\Model\Company
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCompany(){
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE)->getValue();
        $company = $this->companyRepository->getById($companyId);
        return $company;
    }
}
