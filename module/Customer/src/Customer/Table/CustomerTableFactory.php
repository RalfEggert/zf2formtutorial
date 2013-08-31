<?php
/**
 * Zend Framework 2 Beispiel
 * 
 * @package    Customer
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.zendframeworkbuch.de/
 */

/**
 * namespace definition and usage
 */
namespace Customer\Table;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Customer\Entity\CustomerEntity;
use Customer\Hydrator\CustomerDbHydrator;

/**
 * Customer table factory
 * 
 * Factory to create the table gateway for customers 
 * 
 * @package    Customer
 */
class CustomerTableFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Customer\Table\CustomerTable|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydratorManager = $serviceLocator->get('HydratorManager');

        $adapter    = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $entity     = $serviceLocator->get('Customer\Entity\Customer');
        $hydrator   = $hydratorManager->get('Customer\DbHydrator');

        $resultSet  = new HydratingResultSet($hydrator, $entity);
        $table      = new CustomerTable($adapter, $resultSet);
        return $table;
    }
}
