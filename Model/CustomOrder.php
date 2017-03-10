<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ethos\FileNameExtension\Model;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * bgarnier, extends Order but do nothing else, was used to have logs at some point of development.
 *
 * Supported events:
 *  sales_order_load_after
 *  sales_order_save_before
 *  sales_order_save_after
 *  sales_order_delete_before
 *  sales_order_delete_after
 *
 * @method \Magento\Sales\Model\ResourceModel\Order _getResource()
 * @method \Magento\Sales\Model\ResourceModel\Order getResource()
 * @method int getGiftMessageId()
 * @method \Magento\Sales\Model\Order setGiftMessageId(int $value)
 * @method bool hasBillingAddressId()
 * @method \Magento\Sales\Model\Order unsBillingAddressId()
 * @method bool hasShippingAddressId()
 * @method \Magento\Sales\Model\Order unsShippingAddressId()
 * @method int getShippigAddressId()
 * @method bool hasCustomerNoteNotify()
 * @method bool hasForcedCanCreditmemo()
 * @method bool getIsInProcess()
 * @method \Magento\Customer\Model\Customer getCustomer()
 * @method \Magento\Sales\Model\Order setSendEmail(bool $value)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CustomOrder extends \Magento\Sales\Model\Order implements \Magento\Sales\Api\Data\OrderInterface
{
    protected $logs;

    /**
     * CustomOrder constructor.
     * @pram  \Ethos\FileNameExtension\Helper\Logs $logs
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $orderItemCollectionFactory
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     * @param \Magento\Sales\Api\InvoiceManagementInterface $invoiceManagement
     * @param \Magento\Directory\Model\CurrencyFactory $currencyFactory
     * @param \Magento\Eav\Model\Config $eavConfig
     * @param \Magento\Sales\Model\Order\Status\HistoryFactory $orderHistoryFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory $addressCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Payment\CollectionFactory $paymentCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Status\History\CollectionFactory $historyCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory $shipmentCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $memoCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory $trackCollectionFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $salesOrderCollectionFactory
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productListFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(\Ethos\FileNameExtension\Helper\Logs $logs,
                                \Magento\Framework\Model\Context $context,
                                \Magento\Framework\Registry $registry,
                                \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
                                AttributeValueFactory $customAttributeFactory,
                                \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                \Magento\Sales\Model\Order\Config $orderConfig,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
                                \Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $orderItemCollectionFactory,
                                \Magento\Catalog\Model\Product\Visibility $productVisibility,
                                \Magento\Sales\Api\InvoiceManagementInterface $invoiceManagement,
                                \Magento\Directory\Model\CurrencyFactory $currencyFactory,
                                \Magento\Eav\Model\Config $eavConfig,
                                \Magento\Sales\Model\Order\Status\HistoryFactory $orderHistoryFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory $addressCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Payment\CollectionFactory $paymentCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Status\History\CollectionFactory $historyCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory $shipmentCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $memoCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory $trackCollectionFactory,
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $salesOrderCollectionFactory,
                                PriceCurrencyInterface $priceCurrency,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productListFactory,
                                \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
                                \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
                                array $data = [])
    {
        $this->logs = $logs;
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $timezone, $storeManager, $orderConfig, $productRepository, $orderItemCollectionFactory, $productVisibility, $invoiceManagement, $currencyFactory, $eavConfig, $orderHistoryFactory, $addressCollectionFactory, $paymentCollectionFactory, $historyCollectionFactory, $invoiceCollectionFactory, $shipmentCollectionFactory, $memoCollectionFactory, $trackCollectionFactory, $salesOrderCollectionFactory, $priceCurrency, $productListFactory, $resource, $resourceCollection, $data);
    }

    /**
     * @param string $key
     * @param int|null|string|null $index
     * @return float|mixed|null
     */
    public function getData($key = '', $index = null)
    {
        $retour = parent::getData($key, $index);
        return $retour;
    }
}
