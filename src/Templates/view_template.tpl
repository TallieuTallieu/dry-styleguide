{% extends base.tpl %}

{% block body %}
	{% foreach $modifiers as $m => $source %}
		{{ r: $source }}
	{% /foreach %}
{% /block %}