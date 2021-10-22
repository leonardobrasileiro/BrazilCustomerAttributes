<?php

namespace LeonardoBrasileiro\BrazilCustomerAttributes\Plugin\Checkout;

use Magento\Checkout\Model\Session;
use Magento\Store\Model\StoreManagerInterface;

class LoginRedirection
{
    protected $_storeManager;
    protected $_customerSession;
    protected $_resultRedirectFactory;

    public function __construct(StoreManagerInterface $storeManager, Session $customerSession, \Magento\Framework\App\Action\Context $context)
    {
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        $this->_resultRedirectFactory = $context->getResultRedirectFactory();
    }

    public function afterLoadCustomerQuote(Session $_subject, $result)
    {
        $_quote = $_subject->getQuote();

        if (count($_quote->getAllItems()) > 0) {
            $this->_customerSession
                ->setBeforeAuthUrl($this->_storeManager->getStore()->getUrl('checkout/index/index'));
        }
    }

}
