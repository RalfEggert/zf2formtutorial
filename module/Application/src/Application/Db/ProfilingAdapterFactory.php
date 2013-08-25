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
namespace Application\Db;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BjyProfiler\Db\Adapter\ProfilingAdapter;
use BjyProfiler\Db\Profiler\Profiler;
use Zend\Debug\Debug;

/**
 * Profiling adapter controller factory
 * 
 * Factory to create the Profiling adapter 
 * 
 * @package    Application
 */
class ProfilingAdapterFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config  = $serviceLocator->get('Config');
        $adapter = new ProfilingAdapter($config['db']);
        $adapter->setProfiler(new Profiler());
        $adapter->injectProfilingStatementPrototype(array('buffer_results' => true));
        return $adapter;
    }
}
