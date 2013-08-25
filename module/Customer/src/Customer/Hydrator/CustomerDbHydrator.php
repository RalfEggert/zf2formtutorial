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
namespace Customer\Hydrator;

use Zend\Stdlib\Hydrator\ArraySerializable;
use Zend\Serializer\Serializer;

/**
 * Customer database hydrator entity
 * 
 * @package    Customer
 */
class CustomerDbHydrator extends ArraySerializable
{
    /**
     * Extract values from the provided object
     *
     * Extracts values via the object's getArrayCopy() method.
     *
     * @param  object $object
     * @return array
     * @throws Exception\BadMethodCallException for an $object not implementing getArrayCopy()
     */
    public function extract($object)
    {
        $data = parent::extract($object);
        
        if (isset($data['address']) && is_array($data['address'])) {
            $data['address'] = Serializer::serialize($data['address']);
        }
        
        return $data;
    }
    
    /**
     * Hydrate an object
     *
     * Hydrates an object by passing $data to either its exchangeArray() or
     * populate() method.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     * @throws Exception\BadMethodCallException for an $object not implementing exchangeArray() or populate()
     */
    public function hydrate(array $data, $object)
    {
        if (isset($data['address']) && is_string($data['address'])) {
            $data['address'] = Serializer::unserialize($data['address']);
        }
        
        return parent::hydrate($data, $object);
    }
}
