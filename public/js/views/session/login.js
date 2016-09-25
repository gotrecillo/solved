
$(document).ready(function() {
  $('.ui.form')
  .form({
    fields: {
      email: {
        identifier  : 'email',
        rules: [
          {
            type   : 'empty',
            prompt : 'El email no puede estar vacio'
          },
          {
            type   : 'email',
            prompt : 'Introduzca un email válido'
          }
        ]
      },
      password: {
        identifier  : 'password',
        rules: [
          {
            type   : 'empty',
            prompt : 'La contraseña no puede estar vacia'
          }
        ]
      }
    }
  });
});
