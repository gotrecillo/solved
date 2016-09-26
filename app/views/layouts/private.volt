<!-- TOP MENU -->
<div class="ui inverted attached top menu">
  <div class="ui link icon item" id="sidebarMenuToggler">
    <i class="list icon"></i>
  </div>
  <div class="right menu">
    <div class="ui dropdown pointing item">
      <img class="ui avatar image" src="img/avatars/sith.jpg">
      <span>Username</span>
      <i class="dropdown icon"></i>
      <div class="menu">
        <a href="session/logout"  class="item"><i class="user icon"></i>Mi Perfil</a>
        <div class="ui divider"></div>
        <a href="session/logout" class="item"><i class="sign out link icon"></i>Desconectarse</a>
      </div>
    </div>
  </div>
</div>
<!-- END TOP MENU -->

<div class="ui bottom attached segment">
  <!-- MAIN SIDEBAR MENU -->
  <div class="ui vertical inverted sidebar menu" id="sidebarMenu">
    <div class="item">
      <h2 class="inverted">SOLVED</h2>
    </div>
    <div class="ui vertical inverted fluid accordion menu">
      <div class="item link">
        <a class="title">
          <i class="dashboard link icon"></i>
          <b>DASHBOARD</b>
        </a>
      </div>
      <div class="item link">
        <a class="title">
          <i class="user icon"></i>
          <b>PERFIL</b>
          <i class="dropdown icon"></i>
        </a>
        <div class="content menu">
          <a class="item" href="#"> MI PERFIL <i class="left-floated user icon"></i></a>
          <a class="item" href="#"> CALENDARIO <i class="left-floated calendar icon"></i></a>
          <div class="ui divider"></div>
        </div>
      </div>
      <div class="item">
        <a class="title">
          <i class="suitcase icon"></i>
          <b>ADMINISTRACION</b>
          <i class="dropdown icon"></i>
        </a>
        <div class="content menu">
          <a class="item" href="users">USUARIOS <i class="left-floated users icon"></i></a>
          <a class="item" href="#inverted">PERMISOS <i class="left-floated privacy icon"></i></a>
          <div class="ui divider"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- END MAIN SIDEBAR MENU -->

  <div id="contentPusher" class="pusher">
    <div class="private-content-container">
      {{flash.output()}}
      {{content()}}
    </div>
  </div>
</div>
