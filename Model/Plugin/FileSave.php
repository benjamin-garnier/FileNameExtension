<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ethos\FileNameExtension\Model\Plugin;

use Magento\Framework\Exception\CouldNotSaveException;

class FileSave
{
    protected $logs;
    private static $_alreadyCalled = false;


    public static function isAlreadyCalled()
    {
        return self::$_alreadyCalled;
    }

    public static function setAlreadyCalled($alreadyCalled)
    {
        self::$_alreadyCalled = $alreadyCalled;
    }

    public function __construct(\Ethos\FileNameExtension\Helper\Logs $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Save gift message
     *
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderInterface $resultOrder
     * @return \Magento\Sales\Api\Data\OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws CouldNotSaveException
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        if (!self::isAlreadyCalled()) {
            try {
                self::setAlreadyCalled(true);
                $extensionAttributes = $resultOrder->getExtensionAttributes();
                if (
                    null !== $extensionAttributes &&
                    null !== $extensionAttributes->getFileName()
                ) {
                    $fileNameExt = $extensionAttributes->getFileName();
                    $resultOrder->setData('file_name', $fileNameExt);
                    $subject->save($resultOrder);
                }
            } catch (\Exception $e) {
                $this->logs->error("[FileSave][afterSave] ERROR : " . $e->getMessage());
            }
        } else
            self::setAlreadyCalled(false);
        return $resultOrder;
    }
}
