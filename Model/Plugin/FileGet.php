<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ethos\FileNameExtension\Model\Plugin;

class FileGet
{
    /**
     * @var \Ethos\FileNameExtension\Helper\Logs
     */
    protected $logs;

    /** @var \Magento\Sales\Api\Data\OrderExtensionFactory */
    protected $orderExtensionFactory;

    /**
     * Init plugin
     * @param \Ethos\FileNameExtension\Helper\Logs $logs
     * @param \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory
     */
    public function __construct(\Ethos\FileNameExtension\Helper\Logs $logs,
                                \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory
    )
    {
        $this->logs = $logs;
        $this->orderExtensionFactory = $orderExtensionFactory;
    }

    /**
     * Get gift message
     *
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderInterface $resultOrder
     * @return \Magento\Sales\Api\Data\OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        try {           
            $extensionAttributes = $resultOrder->getExtensionAttributes();
            $data_file_name =  $resultOrder->getData('file_name');
            if ($extensionAttributes != null) {
                $extensionAttributes->setFileName($data_file_name);
                $resultOrder->setExtensionAttributes($extensionAttributes);
            }
        } catch (Exception $e) {
            $this->logs->error("[Ethos][FileGet][afterGet] error = $e\n");
        }
        return $resultOrder;
    }
    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Collection $resultOrder
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetList(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Model\ResourceModel\Order\Collection $resultOrder
    )
    {
        /** @var  $order */
        foreach ($resultOrder->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $resultOrder;
    }
}
