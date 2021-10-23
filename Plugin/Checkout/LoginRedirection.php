<?php

namespace LeonardoBrasileiro\BrazilCustomerAttributes\Plugin\Checkout;

use Magento\Checkout\Model\Session;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\Context;
use Magento\Store\Model\StoreManagerInterface;

class LoginRedirection
{
    protected $_storeManager;
    protected $_session;
    protected $_resultRedirectFactory;
    protected $_customerSession;

    public function __construct(
        StoreManagerInterface $storeManager,
        Session $session,
        CustomerSession $customerSession,
        Context $context)
    {
        $this->_storeManager = $storeManager;
        $this->_session = $session;
        $this->_customerSession = $customerSession;
        $this->_resultRedirectFactory = $context->getResultRedirectFactory();
    }

    public function afterLoadCustomerQuote(Session $_subject, $result)
    {
        $_quote = $_subject->getQuote();

        if (count($_quote->getAllItems()) > 0) {
            $this->_session
                ->setBeforeAuthUrl($this->_storeManager->getStore()->getUrl('checkout/index/index'));
        }
    }

}
