<?php
namespace Solved\Models;

use Phalcon\Mvc\Model;

/**
* Solved\Models\Profiles
* All the profile levels in the application. Used in conjenction with ACL lists
*/
class Profiles extends Model
{

  /**
  * ID
  * @var integer
  */
  public $id;

  /**
  * Name
  * @var string
  */
  public $name;

  /**
  * Define relationships to Users and Permissions
  */
  public function initialize()
  {
    $this->hasMany('id', __NAMESPACE__ . '\Users', 'profilesId', [
      'alias' => 'users',
      'foreignKey' => [
        'message' => 'El perfin no puede ser borrardo porque esta siendo usado en Usuarios'
      ]
    ]);

    $this->hasMany('id', __NAMESPACE__ . '\Permissions', 'profilesId', [
      'alias' => 'permissions'
    ]);
  }
}
