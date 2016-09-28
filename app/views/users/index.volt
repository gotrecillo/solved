<!-- DATATABLE -->
<div class="ui raised segments">
  <div class="ui segment">
    USUARIOS
  </div>
  <div class="ui segment">
    <table id="example" class="ui celled table">
      <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Active</th>
        <th></th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<!-- END DATATABLE -->

{{ MyTags.confirmModal([
  'id':'deleteModal',
  'head':'Borrar usuario',
  'content':'¿Estás seguro de borrar el usuario?',
  'acceptLabel':'Borrar',
  'cancelLabel':'Cancelar'
  ])}}
