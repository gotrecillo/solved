<?php
namespace Solved\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

/**
* ControllerBase
* This is the base controller for all controllers in the application
*/
class ControllerBase extends Controller
{
  /**
  * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
  * public controller that is open to all.
  *
  * @param Dispatcher $dispatcher
  * @return boolean
  */
  public function beforeExecuteRoute(Dispatcher $dispatcher)
  {
    $headerCssCollection = $this->assets->collection("headerCss");
    $headerJsCollection = $this->assets->collection("headerJs");
    $footerCollection = $this->assets->collection("footer");

    $headerCssCollection->addCss("css/semantic/dist/semantic.min.css");

    $footerCollection->addJs("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false);
    $footerCollection->addJs("css/semantic/dist/semantic.min.js");

    $controllerName = $dispatcher->getControllerName();

    // Only check permissions on private controllers
    if ($this->acl->isPrivate($controllerName)) {

      // Get the current identity
      $identity = $this->auth->getIdentity();

      // If there is no identity available the user is redirected to index/index
      if (!is_array($identity)) {
        $this->flash->notice('No tienes acceso a esta sección');

        $dispatcher->forward([
          'controller' => 'index',
          'action' => 'index'
        ]);
        return false;
      }

      // Check if the user have permission to the current option
      $actionName = $dispatcher->getActionName();
      if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {
        $this->flash->notice('No tienes acceso a esta sección: ' . $controllerName . ':' . $actionName);

        if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
          $dispatcher->forward([
            'controller' => $controllerName,
            'action' => 'index'
          ]);
        } else {
          $dispatcher->forward([
            'controller' => 'user_control',
            'action' => 'index'
          ]);
        }
        return false;
      }
    }

    $headerCssCollection->addCss("css/views/menu/menu.css");
    $footerCollection->addJs("js/views/menu/menu.js");

  }
}
