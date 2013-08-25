<?php
/**
 * Zend Framework 2 Beispiel
 * 
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.zendframeworkbuch.de/
 */

/**
 * namespace definition and usage
 */
namespace Application\Entity;

use Zend\Filter\StaticFilter;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Abstract entity
 * 
 * @package    Application
 */
abstract class AbstractEntity implements ArraySerializableInterface
{
    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     * @return void
     */
    public function exchangeArray(array $array)
    {
        // make sure to just set filled values and check for method
        foreach ($array as $key => $value) {
            $getMethod = $this->buildMethodName($key, 'get');
            
            if (!method_exists($this, $getMethod)) {
                continue;
            }
            
            $setMethod = $this->buildMethodName($key, 'set');
            
            if (!method_exists($this, $setMethod)) {
                continue;
            }
            
            if (is_object($this->$getMethod())) {
                $this->$getMethod()->exchangeArray($value);
            } else {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $array = array();
        
        foreach (get_object_vars($this) as $key => $value) {
            $getMethod = $this->buildMethodName($key, 'get');
            
            if (!method_exists($this, $getMethod)) {
                continue;
            }
            
            if (is_object($this->$getMethod())) {
                $array[$key] = $this->$getMethod()->getArrayCopy();
            } else {
                $array[$key] = $this->$getMethod();
            }
        }
        
        return $array;
    }

    /**
     * Build method name
     *
     * @param  string $key
     * @param  string $mode
     * @return void
     */
    public function buildMethodName($key, $mode = 'get')
    {
        return $mode . StaticFilter::execute(
                $key, 'wordunderscoretocamelcase'
        );
    }
}
