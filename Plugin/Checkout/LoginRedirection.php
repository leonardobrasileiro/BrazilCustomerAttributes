<?php

namespace LeonardoBrasileiro\BrazilCustomerAttributes\Plugin\Checkout;

use Magento\Checkout\Model\Session;
use Magento\Store\Model\StoreManagerInterface;

class LoginRedirection
{
    protected $_storeManager;
    protected $_customerSession;

    public function __construct(StoreManagerInterface $storeManager, Session $customerSession)
    {
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
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
