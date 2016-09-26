<?php
namespace Solved\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Solved\Forms\ChangePasswordForm;
use Solved\Forms\UsersForm;
use Solved\Models\Users;
use Solved\Models\PasswordChanges;
use \DataTables\DataTable;

/**
* Solved\Controllers\UsersController
* CRUD to manage users
*/
class UsersController extends ControllerBase
{

  public function initialize()
  {
    parent::initialize();
    $this->view->setTemplateBefore('private');
  }

  /**
  * Default action, shows the datatable with the users
  */
  public function indexAction()
  {
    $this->headerCssCollection->addCss("//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.css", false);

    $this->footerCollection->addJs("lib/DataTables/datatables.min.js");
    $this->footerCollection->addJs("https://cdn.datatables.net/1.10.12/js/dataTables.semanticui.min.js", false);
    $this->footerCollection->addJs("js/views/users/index.js");

    if ($this->request->isAjax()) {
      $builder = $this->modelsManager
                      ->createBuilder()
                      ->columns('id, name, email, active')
                      ->from('Solved\Models\Users');

      $dataTables = new DataTable();
      $dataTables->fromBuilder($builder)->sendResponse();
    }
  }

  /**
  * Searches for users
  */
  public function searchAction()
  {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, 'Solved\Models\Users', $this->request->getPost());
      $this->persistent->searchParams = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = [];
    if ($this->persistent->searchParams) {
      $parameters = $this->persistent->searchParams;
    }

    $users = Users::find($parameters);
    if (count($users) == 0) {
      $this->flash->notice("The search did not find any users");
      return $this->dispatcher->forward([
        "action" => "index"
      ]);
    }

    $paginator = new Paginator([
      "data" => $users,
      "limit" => 10,
      "page" => $numberPage
    ]);

    $this->view->page = $paginator->getPaginate();
  }

  /**
  * Creates a User
  */
  public function createAction()
  {
    if ($this->request->isPost()) {

      $user = new Users([
        'name' => $this->request->getPost('name', 'striptags'),
        'profilesId' => $this->request->getPost('profilesId', 'int'),
        'email' => $this->request->getPost('email', 'email')
      ]);

      if (!$user->save()) {
        $this->flash->error($user->getMessages());
      } else {

        $this->flash->success("User was created successfully");

        Tag::resetInput();
      }
    }

    $this->view->form = new UsersForm(null);
  }

  /**
  * Saves the user from the 'edit' action
  */
  public function editAction($id)
  {
    $user = Users::findFirstById($id);
    if (!$user) {
      $this->flash->error("User was not found");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    if ($this->request->isPost()) {

      $user->assign([
        'name' => $this->request->getPost('name', 'striptags'),
        'profilesId' => $this->request->getPost('profilesId', 'int'),
        'email' => $this->request->getPost('email', 'email'),
        'banned' => $this->request->getPost('banned'),
        'suspended' => $this->request->getPost('suspended'),
        'active' => $this->request->getPost('active')
      ]);

      if (!$user->save()) {
        $this->flash->error($user->getMessages());
      } else {

        $this->flash->success("User was updated successfully");

        Tag::resetInput();
      }
    }

    $this->view->user = $user;

    $this->view->form = new UsersForm($user, [
      'edit' => true
    ]);
  }

  /**
  * Deletes a User
  *
  * @param int $id
  */
  public function deleteAction($id)
  {
    $user = Users::findFirstById($id);
    if (!$user) {
      $this->flash->error("No existe usuario en el sistema con ese id");
      return $this->dispatcher->forward([
        'action' => 'index'
      ]);
    }

    if (!$user->delete()) {
      $this->flash->error($user->getMessages());
    } else {
      $this->flash->success("Usuario borrado");
    }

    return $this->dispatcher->forward([
      'action' => 'index'
    ]);
  }

  /**
  * Users must use this action to change its password
  */
  public function changePasswordAction()
  {
    $form = new ChangePasswordForm();

    if ($this->request->isPost()) {

      if (!$form->isValid($this->request->getPost())) {

        foreach ($form->getMessages() as $message) {
          $this->flash->error($message);
        }
      } else {

        $user = $this->auth->getUser();

        $user->password = $this->security->hash($this->request->getPost('password'));
        $user->mustChangePassword = 'N';

        $passwordChange = new PasswordChanges();
        $passwordChange->user = $user;
        $passwordChange->ipAddress = $this->request->getClientAddress();
        $passwordChange->userAgent = $this->request->getUserAgent();

        if (!$passwordChange->save()) {
          $this->flash->error($passwordChange->getMessages());
        } else {

          $this->flash->success('Your password was successfully changed');

          Tag::resetInput();
        }
      }
    }

    $this->view->form = $form;
  }
}
