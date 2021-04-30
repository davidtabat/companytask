<?php

namespace Devall\Tabatadze\Controller\Company;

use Devall\Tabatadze\Model\Company;
use Exception;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\AddressRegistry;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Action;

class EditPost extends Action
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepositoryInterface;

    /**
     * @var AddressRegistry
     */
    private $addressRegistry;

    const COMPANY_KEY = 'company';
    const DOMAIN_NAME = 'http://localhost';


    /**
     * EditPost constructor.
     * @param Context $context
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Validator $formKeyValidator
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     * @param AddressRegistry|null $addressRegistry
     */
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepositoryInterface,
        Validator $formKeyValidator,
        Session $customerSession,
        PageFactory $resultPageFactory,
        AddressRegistry $addressRegistry = null
    ) {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->formKeyValidator = $formKeyValidator;
        $this->session = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->addressRegistry = $addressRegistry;
        parent::__construct($context);
    }

    public function execute() {
        $validFormKey = $this->formKeyValidator->validate($this->getRequest());
        if($validFormKey) {
            $data = $this->getRequest()->getParam(self::COMPANY_KEY);
        }
        try {
            if ($data) {
                $customerId = $this->session->getCustomerId();
                $customer = $this->customerRepositoryInterface->getById($customerId);
                $this->disableAddressValidation($customer);
                $customer->setCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE, $data);
                $this->customerRepositoryInterface->save($customer);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl(self::DOMAIN_NAME . '/customer/account');
        return $resultRedirect;

    }

    /**
     * Disable Customer Address Validation
     *
     * @param CustomerInterface $customer
     * @throws NoSuchEntityException
     */
    private function disableAddressValidation(CustomerInterface $customer) {
        foreach ($customer->getAddresses() as $address) {
            $addressModel = $this->addressRegistry->retrieve($address->getId());
            $addressModel->setShouldIgnoreValidation(true);
        }
    }
}
