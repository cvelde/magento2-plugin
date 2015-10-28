<?php
namespace Yotpo\Yotpo\Block;

class Conversion extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Yotpo\Yotpo\Block\Config $config,
							    \Magento\Checkout\Model\Session $checkoutSession,
							    \Magento\Framework\View\Element\Template\Context $context,
							    \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
							    array $data = [],) 
	{
		$this->_app_key = $config->getAppKey();
		$this->_checkoutSession = $checkoutSession;
		$this->_orderRepository = $orderRepository;
		parent::__construct($context, $data);
	}

	protected function _construct()
    {
        parent::_construct();
    }

	public function getAppKey() 
	{
		return $this->_app_key;
	}

	public function getOrderId()
	{
		return $this->_checkoutSession->getLastOrderId();	
	}
	public function getOrder() 
	{
		$order = $this->_orderRepository->get($this->getOrderId());
		return $order; 
	}

	public function getOrderAmount() 
    {   
        $order = $this->getOrder();
        if ($order != null) 
        {
            return intval($order->getTotalQtyOrdered());
        }
    }
    public function getOrderCurrency() 
    {
        $order = $this->getOrder();
        if ($order != null) 
        {
            return $order->getOrderCurrencyCode();
        }
	}

}