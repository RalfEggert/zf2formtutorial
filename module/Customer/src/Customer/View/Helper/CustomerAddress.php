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
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Customer\Entity\CustomerEntity;

/**
 * Show customer address view helper
 * 
 * @package    Customer
 */
class CustomerAddress extends AbstractHelper
{
    /**
     * Outputs customer address
     *
     * @return string 
     */
    public function __invoke(CustomerEntity $customerEntity)
    {
        $output = $customerEntity->getAddress()->getStreet() . ', ' 
                . $customerEntity->getAddress()->getPostcode() . ' ' 
                . $customerEntity->getAddress()->getCity();
        
        return $output;
    }
}
