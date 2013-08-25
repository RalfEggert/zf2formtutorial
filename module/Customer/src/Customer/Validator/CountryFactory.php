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
namespace Customer\Validator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Country validator factory
 * 
 * Factory to create the country validator 
 * 
 * @package    Customer
 */
class CountryFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return \Customer\Validator\Country|mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $validator = new Country();
        $validator->setCountries(array('1', '2', '3'));
        return $validator;
    }
}
