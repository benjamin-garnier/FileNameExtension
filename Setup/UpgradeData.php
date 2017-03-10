<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 07/03/2017
 * Time: 11:58
 */

namespace Ethos\FileNameExtension\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class UpgradeData implements UpgradeDataInterface
{
    protected $_log;

    /**
     * @param \Ethos\FileNameExtension\Helper\Logs $log
     */
    public function __construct(
        \Ethos\FileNameExtension\Helper\Logs $log
    )
    {
        $this->_log = $log;
    }
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->_log->info("[UpgradeData/upgrade] : start, version =". $context->getVersion());
        if (version_compare($context->getVersion(), '0.2.0', '<')) {
            $connection = $setup->getConnection();
            $grid = $setup->getTable('sales_order_grid');
            $affiliate = $setup->getTable('sales_order');
            $connection->query(
                $connection->updateFromSelect(
                    $connection->select()
                        ->join(
                            $affiliate,
                            sprintf('%s.entity_id = %s.entity_id', $grid, $affiliate),
                            'file_name'
                        ),
                    $grid
                )
            );
        }

        $setup->endSetup();
    }
}