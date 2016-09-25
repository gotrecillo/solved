<?php
namespace Solved\Controllers;

use Phalcon\Http\Response;

/**
* Display the default index page.
*/
class IndexController extends ControllerBase
{

  /**
  * Default action. Set the public layout (layouts/public.volt)
  */
  public function indexAction()
  {
    $headerCollection = $this->assets->collection("header");

    if ( !is_array($this->auth->getIdentity())) {
      $this->response->redirect("session/login");
      $this->view->disable();
    }

    $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
    $this->view->setTemplateBefore('private');
  }
}
