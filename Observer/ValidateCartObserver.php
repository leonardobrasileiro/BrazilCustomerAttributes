<?php

namespace LeonardoBrasileiro\BrazilCustomerAttributes\Observer;

use LeonardoBrasileiro\BrazilCustomerAttributes\Helper\Data as Helper;
use Magento\Checkout\Model\Session;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\Observer;

class ValidateCartObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    protected $_messageManager;

    /**
     * @var RedirectInterface
     */
    protected $_redirect;

    /**
     * @var Cart
     */
    protected $_cart;

    protected $_customerSession;

    /**
     * @var Helper
     */
    protected $_helper;

    /**
     * @param ManagerInterface $messageManager
     * @param RedirectInterface $redirect
     * @param CustomerCart $cart
     */
    public function __construct(
        ManagerInterface $messageManager,
        RedirectInterface $redirect,
        Helper $helper,
        Session $customerSession
    ) {
        $this->_messageManager = $messageManager;
        $this->_redirect = $redirect;
        $this->_customerSession = $customerSession;
        $this->_helper = $helper;
    }

    /**
     * Validate Cart Before going to checkout
     * - event: controller_action_predispatch_checkout_index_index
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $controller = $observer->getControllerAction();

        $customer = $this->_customerSession->getQuote()->getCustomer();
        if ($customer && $this->_helper->isCpfCnpjRequired() &&
            !$customer->getCustomAttribute('cpf') &&
            !$customer->getCustomAttribute('cnpj')) {
            $this->_messageManager->addNoticeMessage(
                __('Informe o documento para finalizar a compra.')
            );
            $this->_redirect->redirect($controller->getResponse(), 'customer/account/edit');
        }
    }
}
