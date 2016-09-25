<?php
namespace Solved\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
* Solved\Models\Users
* All the users registered in the application
*/
class Users extends Model
{

  /**
  *
  * @var integer
  */
  public $id;

  /**
  *
  * @var string
  */
  public $name;

  /**
  *
  * @var string
  */
  public $email;

  /**
  *
  * @var string
  */
  public $password;

  /**
  *
  * @var string
  */
  public $mustChangePassword;

  /**
  *
  * @var string
  */
  public $profilesId;

  /**
  *
  * @var string
  */
  public $banned;

  /**
  *
  * @var string
  */
  public $suspended;

  /**
  *
  * @var string
  */
  public $active;

  /**
  * Before create the user assign a password
  */
  public function beforeValidationOnCreate()
  {
    if (empty($this->password)) {

      // Generate a plain temporary password
      $tempPassword = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(12)));

      // The user must change its password in first login
      $this->mustChangePassword = 'Y';

      // Use this password as default
      $this->password = $this->getDI()
      ->getSecurity()
      ->hash($tempPassword);
    } else {
      // The user must not change its password in first login
      $this->mustChangePassword = 'N';
    }

    // The account must be confirmed via e-mail
    $this->active = 'N';

    // The account is not suspended by default
    $this->suspended = 'N';

    // The account is not banned by default
    $this->banned = 'N';
  }

  /**
  * Send a confirmation e-mail to the user if the account is not active
  */
  public function afterSave()
  {
    if ($this->active == 'N') {

      $emailConfirmation = new EmailConfirmations();

      $emailConfirmation->usersId = $this->id;

      if ($emailConfirmation->save()) {
        $this->getDI()
        ->getFlash()
        ->notice('Un email de confirmacion a sido enviado a: ' . $this->email);
      }
    }
  }

  /**
  * Validate that emails are unique across users
  */
  public function validation()
  {
    $validator = new Validation();

    $validator->add('email', new Uniqueness([
      "message" => "El email ya esta en uso"
    ]));

    return $this->validate($validator);
  }

  public function initialize()
  {
    $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
      'alias' => 'profile',
      'reusable' => true
    ]);

    $this->hasMany('id', __NAMESPACE__ . '\SuccessLogins', 'usersId', [
      'alias' => 'successLogins',
      'foreignKey' => [
        'message' => 'El usuario no se puede borrar porque tiene actividad en el sistema'
      ]
    ]);

    $this->hasMany('id', __NAMESPACE__ . '\PasswordChanges', 'usersId', [
      'alias' => 'passwordChanges',
      'foreignKey' => [
        'message' => 'El usuario no se puede borrar porque tiene actividad en el sistema'
      ]
    ]);

    $this->hasMany('id', __NAMESPACE__ . '\ResetPasswords', 'usersId', [
      'alias' => 'resetPasswords',
      'foreignKey' => [
        'message' => 'El usuario no se puede borrar porque tiene actividad en el sistema'
      ]
    ]);
  }
}