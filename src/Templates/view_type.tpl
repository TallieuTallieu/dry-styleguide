{% extends base.tpl %}

{% block body %}

	<div class="styleguide-breadcrumbs">
		<a href="styleguide/">...</a>
		<span>{{ $type_plural }}</span>
	</div>

	<div class="styleguide-nav">
		{% foreach $components as $c => $modifiers %}
			<a href="styleguide/{{ $type_short }}/{{ $c }}/">{{ $c }}</a>
		{% /foreach %}
	</div>

	{% foreach $components as $c => $modifiers %}
		<div class="styleguide-component">
			<div class="styleguide-component__title">
				<a href="styleguide/{{ $type_short }}/{{ $c }}/">
					{{ $c }}
				</a>
			</div>
			<div class="styleguide-component__grid" style="grid-template-columns: repeat({{ $meta[ $c ][ 'columns' ] ?? 1 }}, 1fr);">
				{% foreach $modifiers as $m => $source %}

					{% $modifier_style = $meta[ $c ][ 'style' ][ $m ] ?? [] %}
					{% $style = 'style="' %}
					{% foreach $modifier_style as $prop => $value %}
						{% $style .= $prop . ': ' . $value . '; ' %}
					{% /foreach %}
					{% $style .= '"' %}

					<div class="styleguide-component__view">
						<div class="styleguide-component__modifier">
							<a href="styleguide/{{ $type_short }}/{{ $c }}--{{ $m }}/">{{ $c }}{{ $m !== 'default' ? '--' . $m : '' }}</a>
						</div>
						<div class="styleguide-component__render" {{ r: $style }}>
							{{ r: $source }}
						</div>
					</div>
				{% /foreach %}
			</div>
		</div>
	{% /foreach %}

{% /block %}