<?php
//
//namespace Ethos\FileNameExtension\Observer\Sales;
//
//use Magento\Framework\Event\ObserverInterface;
//
//class OrderLoadAfter implements ObserverInterface
//{
//    protected $logs;
//
//    /**
//     * OrderLoadAfter constructor.
//     */
//    public function __construct(\Ethos\FileNameExtension\Helper\Logs $logs)
//    {
//        $this->logs = $logs;
//    }
//
//
//    public function execute(\Magento\Framework\Event\Observer $observer)
//    {
//        try {
//            $this->logs->info("[OrderLoadAfter]execute called");
//            $order = $observer->getOrder();
//            $extensionAttributes = $order->getExtensionAttributes();
//            if ($extensionAttributes === null) {
//                $extensionAttributes = $this->getOrderExtensionDependency();
//            }
//            $attr = $order->getData('file_name');
//            $extensionAttributes->setFileName($attr);
//            $order->setExtensionAttributes($extensionAttributes);
//        } catch (Exception $e) {
//            $this->logs->error("[OrderLoadAfter][execute] error = $e");
//        }
//        $observer->setData('file_name', $attr);
//    }
//
//    private function getOrderExtensionDependency()
//    {
//        $orderExtension = \Magento\Framework\App\ObjectManager::getInstance()->get(
//            '\Magento\Sales\Api\Data\OrderExtension'
//        );
//        return $orderExtension;
//    }
//}