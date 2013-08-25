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
namespace Customer\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Customer service factory
 * 
 * Factory to create the model-service for customers 
 * 
 * @package    Customer
 */
class CustomerServiceFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $inputFilterManager = $serviceLocator->get('InputFilterManager');
        
        $eventManager = $serviceLocator->get('EventManager');
        $table        = $serviceLocator->get('Customer\Table\Customer');
        $filter       = $inputFilterManager->get('Customer\CustomerFilter');
        $service      = new CustomerService($eventManager, $table, $filter);
        return $service;
    }
}
