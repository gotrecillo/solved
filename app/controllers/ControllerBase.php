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

  public function initialize()
  {
    $this->headerCssCollection = $this->assets->collection("headerCss");
    $this->headerJsCollection = $this->assets->collection("headerJs");
    $this->footerCollection = $this->assets->collection("footer");

    $this->headerCssCollection->addCss("css/semantic/dist/semantic.min.css");

    $this->footerCollection->addJs("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false);
    $this->footerCollection->addJs("css/semantic/dist/semantic.min.js");

    $this->headerCssCollection->addCss("css/views/menu/menu.css");
    $this->footerCollection->addJs("js/views/menu/menu.js");
    $this->footerCollection->addJs("js/views/layouts/index.js");

    $this->headerJsCollection->addJs("js/constants.js");
    $this->headerJsCollection->addJs("js/templates.js");
  }

  /**
  * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
  * public controller that is open to all.
  *
  * @param Dispatcher $dispatcher
  * @return boolean
  */
  public function beforeExecuteRoute(Dispatcher $dispatcher)
  {
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



  }
}
