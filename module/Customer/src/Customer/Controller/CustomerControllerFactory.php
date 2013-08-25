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
namespace Customer\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Customer controller factory
 * 
 * Factory to create the controller for customers 
 * 
 * @package    Customer
 */
class CustomerControllerFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $controllerLoader)
    {
        $serviceLocator     = $controllerLoader->getServiceLocator();
        $formElementManager = $serviceLocator->get('FormElementManager');
        
        $service    = $serviceLocator->get('Customer\Service\Customer');
        $form       = $formElementManager->get('Customer\CustomerForm');
        $controller = new CustomerController();
        $controller->setCustomerService($service);
        $controller->setCustomerForm($form);
        return $controller;
    }
}
