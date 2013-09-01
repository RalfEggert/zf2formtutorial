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
namespace Customer\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Customer form factory
 * 
 * Factory to create the form for customers 
 * 
 * @package    Customer
 */
class CustomerFormFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $formElementManager
     * @return \Customer\Form\CustomerForm|mixed
     */
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        $serviceLocator     = $formElementManager->getServiceLocator();
        $hydratorManager    = $serviceLocator->get('HydratorManager');
        $inputFilterManager = $serviceLocator->get('InputFilterManager');
        
        $form = new CustomerForm();
        $form->setHydrator($hydratorManager->get('ArraySerializable'));
        $form->setInputFilter($inputFilterManager->get('Customer\CustomerFilter'));
        return $form;
    }
}
