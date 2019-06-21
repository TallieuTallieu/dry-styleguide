{% extends base.tpl %}

{% block body %}

	{% $modifier_style = $meta['style'][ $modifier_name ] ?? [] %}
	{% $style = 'style="' %}
	{% foreach $modifier_style as $prop => $value %}
	{% $style .= $prop . ': ' . $value . '; ' %}
	{% /foreach %}
	{% $style .= '"' %}

	<div class="styleguide-breadcrumbs">
		<a href="styleguide/">...</a>
		<a href="styleguide/{{ $type_short }}/">{{ $type_plural }}</a>
		<a href="styleguide/{{ $type_short }}/{{ $component_name }}/">{{ $component_name }}</a>
		<span>--{{ $modifier_name }}</span>
	</div>

	<div class="styleguide-component">
		<div class="styleguide-component__title">{{ $component_name }}--{{ $modifier_name }}</div>
		<div class="styleguide-component__view">
			<div class="styleguide-component__render"{{ r: $style }}>
				{{ r: $source }}
			</div>
		</div>
	</div>

{% /block %}