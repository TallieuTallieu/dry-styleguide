<!DOCTYPE html>
<html lang="{{ \dry\http\Response::$language }}">
<head>
	<meta charset="UTF-8" />
	<base href="{% block base_href %}http{% if defined( '\app\USE_HTTPS' ) && \app\USE_HTTPS %}s{% /if %}://{{ \app\HTTP_HOST }}{{ \app\HTTP_ROOT }}{% /block %}" />
	<title>Styleguide</title>
	<link rel="stylesheet" href="build/css/{{ \dry\asset_path( 'app.css' ) }}" />
	<link rel="stylesheet" href="build/css/{{ \dry\asset_path( 'styleguide.css' ) }}" />

	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
	{% block body %}{% /block %}
</body>
</html>