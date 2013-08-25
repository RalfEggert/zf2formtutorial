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
namespace Customer\Entity;

use Application\Entity\AbstractEntity;

/**
 * Address entity
 * 
 * Entity to represent an address 
 * 
 * @package    Customer
 */
class AddressEntity extends AbstractEntity
{
    protected $street;
    protected $postcode;
    protected $city;
    
    /**
     * Set street
     * 
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }
    
    /**
     * Get street
     * 
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }
    
    /**
     * Set postcode
     * 
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
    
    /**
     * Get postcode
     * 
     * @return string $postcode
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    
    /**
     * Set city
     * 
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /**
     * Get city
     * 
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }
}
