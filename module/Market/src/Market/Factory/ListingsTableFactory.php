<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 02/04/2015
 * Time: 10:18
 */

namespace Market\Factory;


use Market\Model\ListingsTable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListingsTableFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //echo "ListingsTableFactory::createService <br/>";
        return new ListingsTable(ListingsTable::$tableName,
            $serviceLocator->get('general-adapter'));
    }

} 