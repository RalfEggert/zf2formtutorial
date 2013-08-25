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
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * About controller
 * 
 * Handles the homepage and other pages
 * 
 * @package    Application
 */
class AboutController extends AbstractActionController
{
    /**
     * Handle about page
     */
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * Handle imprint page
     */
    public function imprintAction()
    {
        return new ViewModel();
    }
}
