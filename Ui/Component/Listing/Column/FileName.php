<?php
///*
// * bgarnier
// * useless class, was used to give the data of table sales_order for column 'file_name' instead of table sales_order_grid, on admin view,
// * but doing it does not allow the grid to trim the fields or even export them properly (sorting the grid and exporting the orders on csv
// * was still based on sales_order_grid data)
// */
//namespace Ethos\FileNameExtension\Ui\Component\Listing\Column;
//
//use \Magento\Sales\Api\OrderRepositoryInterface;
//use \Magento\Framework\View\Element\UiComponent\ContextInterface;
//use \Magento\Framework\View\Element\UiComponentFactory;
//use \Magento\Ui\Component\Listing\Columns\Column;
//use \Magento\Framework\Api\SearchCriteriaBuilder;
//
//class FileName extends Column
//{
//    protected $logs;
//    protected $_orderRepository;
//    protected $_searchCriteria;
//
//    public function __construct(\Ethos\FileNameExtension\Helper\Logs $logs,
//                                ContextInterface $context,
//                                UiComponentFactory $uiComponentFactory,
//                                OrderRepositoryInterface $orderRepository,
//                                SearchCriteriaBuilder $criteria,
//                                array $components = [],
//                                array $data = [])
//    {
//        $this->logs = $logs;
//        $this->_orderRepository = $orderRepository;
//        $this->_searchCriteria = $criteria;
//        parent::__construct($context, $uiComponentFactory, $components, $data);
//    }
//
//    public function prepareDataSource(array $dataSource)
//    {
//        if (isset($dataSource['data']['items'])) {
//            foreach ($dataSource['data']['items'] as & $item) {
//                $order = $this->_orderRepository->get($item["entity_id"]);
//                $fileName = $order->getData("file_name");
//                $this->logs->info("[Status][prepareDataSource] getdata =  $fileName");
//                // $this->getData('name') returns the name of the column so in this case it would return export_status
//                $item['file_name'] = $fileName;
//            }
//        }
//        return $dataSource;
//    }
//
//    public function aroundGetReport(
//        \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject,
//        \Closure $proceed,
//        $requestName
//    )
//    {
//        $result = $proceed($requestName);
//        if ($requestName == 'sales_order_grid_data_source') {
//            if ($result instanceof \Magento\Sales\Model\ResourceModel\Order\Grid\Collection) {
//                //don't know what to do....
//                $this->logs->info("[Status][aroundGetReport]  $result");
//            }
//        }
//        return $result;
//    }
//}