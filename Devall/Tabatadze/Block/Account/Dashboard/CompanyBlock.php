<?php
namespace Devall\Tabatadze\Block\Account\Dashboard;

use Devall\Tabatadze\Model\Company;
use \Magento\Framework\View\Element\Template;
use Devall\Tabatadze\Api\CompanyRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CompanyBlock extends Template
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepositoryInterface;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepositoryInterface;

    /**
     * CompanyBlock constructor.
     * @param CustomerSession $customerSession
     * @param CompanyRepositoryInterface $companyRepositoryInterface
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CustomerSession $customerSession,
        CompanyRepositoryInterface $companyRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->companyRepositoryInterface = $companyRepositoryInterface;
    }

    /**
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function hasCompany(){
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE);
        return !empty($companyId);
    }

    /**
     * @return int
     */
    public function getCustomerId(){
        return $this->customerSession->getId();
    }

    /**
     * @return \Devall\Tabatadze\Api\Data\CompanyRepository
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCompany(){
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE)->getValue();
        $company = $this->companyRepositoryInterface->getById($companyId);
        return $company;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getName(){
        return $this->getCompany()->getName();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCountry(){
        return $this->getCompany()->getCountry();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStreet(){
        return $this->getCompany()->getStreet();
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getNumber(){
        return $this->getCompany()->getNumber();
    }

    /**
     * @return string
     */
    public function getCompanyEditUrl(){
        return $this->getUrl('devall/company/edit/');
    }
}
