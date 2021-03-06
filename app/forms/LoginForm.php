<?php
namespace Solved\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{

  public function initialize()
  {
    // Email
    $email = new Text('email', [
      'placeholder' => 'Email'
    ]);

    $email->addValidators([
      new PresenceOf([
        'message' => 'Por favor introduzca el email'
      ]),
      new Email([
        'message' => 'El email no es válido'
      ])
    ]);

    $this->add($email);

    // Password
    $password = new Password('password', [
      'placeholder' => 'Password'
    ]);

    $password->addValidator(new PresenceOf([
      'message' => 'Por favor introduzca la contraseña'
    ]));

    $password->clear();

    $this->add($password);

    // Remember
    $remember = new Check('remember', [
      'value' => 'yes'
    ]);

    $remember->setLabel('Recuérdame');

    $this->add($remember);

    // CSRF
    $csrf = new Hidden('csrf');

    $csrf->addValidator(new Identical([
      'value' => $this->security->getSessionToken(),
      'message' => 'Ataque CSRF'
    ]));

    $csrf->clear();

    $this->add($csrf);

    $this->add(new Submit('Entrar', [
      'class' => 'ui fluid large teal submit button'
    ]));
  }
}
