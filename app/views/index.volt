<!DOCTYPE html>
<html>
	<head>
		<title>Solved | Admin Panel</title>
		<meta charset="utf-8" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		{{ assets.outputCss('headerCss') }}
		{{ assets.outputJs('headerJs') }}
	</head>
	<body>

		{{ content() }}
		{{ assets.outputJs('footer')}}
	</body>
</html>
