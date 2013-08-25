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
namespace Application\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Show messages view helper factory
 * 
 * Generates the Show messages view helper object
 * 
 * @package    Application
 */
class ShowMessagesFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm     = $serviceLocator->getServiceLocator();
        $plugin = $sm->get('ControllerPluginManager')->get('flashMessenger');
        $helper = new ShowMessages($plugin);
        return $helper;
    }
}
