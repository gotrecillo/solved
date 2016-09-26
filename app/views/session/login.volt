<div class="ui middle aligned center aligned grid">
  <div class="column">
		<h2 class="ui teal image header">
			{{image("img/logo.png", "class":"image")}}
	    <div class="content">
	      Inicia sesión
	    </div>
	  </h2>

		{{ form('class': 'ui large form') }}
	    <div class="ui stacked segment">
        {{flash.output()}}
				{{ MyTags.iconField(['icon':'mail', 'element':'email', 'form': form])}}
				{{ MyTags.iconField(['icon':'lock', 'element':'password', 'form': form])}}

				{{ form.render('Entrar') }}

        <div class="ui divider"></div>

				{{ MyTags.checkbox(['element':'remember', 'form': form])}}

			</div>

			{{ form.render('csrf', ['value': security.getToken()]) }}
      <div class="ui error message"></div>
		</form>

		<div class="ui message">
			{{ link_to("session/forgotPassword", "¿Olvido la contraseña?") }}
	  </div>

	</div> <!-- END COLUM -->
</div> <!-- END GRID -->
