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
namespace Application\Service;

use Zend\EventManager\EventManagerInterface;
use Application\Entity\AbstractEntity;

/**
 * Abstract model service
 * 
 * @package    Application
 */
abstract class AbstractModelService
{
    /**
     * @var EventManagerInterface
     */
    protected $eventManager = null;
    
    /**
     * @var string
     */
    protected $message = null;
    
    /**
     * Retrieve the event manager
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
    
    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }
    
    /**
     * Get service message
     * 
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Clear service message
     */
    public function clearMessage()
    {
        $this->message = null;
    }
    
    /**
     * Add service message
     * 
     * @param string new message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Save data
     *
     * @param array $data input data
     * @param integer $id id of entry
     * @return AbstractEntity
     */
    abstract public function save(array $data, $id = null);
    
    /**
     * Delete existing entity
     *
     * @param integer $id id
     * @return boolean
     */
    abstract public function delete($id);
}
