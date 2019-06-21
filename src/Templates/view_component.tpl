{% extends base.tpl %}

{% block body %}

	<div class="styleguide-breadcrumbs">
		<a href="styleguide/">...</a>
		<a href="styleguide/{{ $type_short }}/">{{ $type_plural }}</a>
		<span>{{ $component_name }}</span>
	</div>

	<div class="styleguide-component">
		<div class="styleguide-component__title">{{ $component_name }}</div>
		<div class="styleguide-component__grid" style="grid-template-columns: repeat({{ $meta[ 'columns' ] ?? 1 }}, 1fr);">

			{% foreach $modifiers as $m => $source %}
				<div class="styleguide-component__view">
					{% $modifier_style = $meta['style'][ $m ] ?? [] %}
					{% $style = 'style="' %}
					{% foreach $modifier_style as $prop => $value %}
						{% $style .= $prop . ': ' . $value . '; ' %}
					{% /foreach %}
					{% $style .= '"' %}
					<div class="styleguide-component__modifier">
						<a href="styleguide/{{ $type_short }}/{{ $component_name }}--{{ $m }}/">{{ $component_name }}{{ $m !== 'default' ? '--' . $m : '' }}</a>
					</div>
					<div class="styleguide-component__render" {{ r: $style }}>
						{{ r: $source }}
					</div>
				</div>
			{% /foreach %}
		</div>
	</div>

	{% if count( $examples ) %}
		<div class="styleguide-component">
			<div class="styleguide-component__title styleguide-component__title--alt">Examples</div>
			<div class="styleguide-component__grid" style="grid-template-columns: repeat({{ $meta[ 'columns' ] ?? 1 }}, 1fr);">
				{% foreach $examples as $e => $source %}
					<div class="styleguide-component__view">
						<div class="styleguide-component__modifier">
							{{ $e }}
						</div>
						<div class="styleguide-component__render styleguide-component__render--alt">
							{{ r: $source }}
						</div>
					</div>
				{% /foreach %}
			</div>
		</div>
	{% /if %}

{% /block %}