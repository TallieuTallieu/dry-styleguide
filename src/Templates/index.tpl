{% extends base.tpl %}

{% block body %}

	<div class="styleguide-index">
		<div class="styleguide-index__item styleguide-index__item--horizontal">
			<div class="styleguide-index__title"><a href="styleguide/tpl/" title="Templates">Templates</a> ({{ count( $templates ) }})</div>
			<ul>
				{% foreach $templates as $t %}
					<li>
						<a href="styleguide/tpl/{{ $t }}/" title="{{ $t }}" target="_blank">{{ $t }}</a>
					</li>
				{% /foreach %}
			</ul>
		</div>
	</div>

	<div class="styleguide-index">
		<div class="styleguide-index__item">
			<div class="styleguide-index__title"><a href="styleguide/a/" title="Atoms">Atoms</a> ({{ count( $atoms ) }})</div>
			<ul>
				{% foreach $atoms as $a %}
					<li>
						<a href="styleguide/a/{{ $a }}/" title="{{ $a }}">{{ $a }}</a>
					</li>
				{% /foreach %}
			</ul>
		</div>
		<div class="styleguide-index__item">
			<div class="styleguide-index__title"><a href="styleguide/m/" title="Molecules">Molecules</a> ({{ count( $molecules ) }})</div>
			<ul>
				{% foreach $molecules as $m %}
					<li>
						<a href="styleguide/m/{{ $m }}/" title="{{ $m }}">{{ $m }}</a>
					</li>
				{% /foreach %}
			</ul>
		</div>
		<div class="styleguide-index__item">
			<div class="styleguide-index__title"><a href="styleguide/o/" title="Organisms">Organisms</a> ({{ count( $organisms ) }})</div>
			<ul>
				{% foreach $organisms as $o %}
					<li>
						<a href="styleguide/o/{{ $o }}/" title="{{ $o }}">{{ $o }}</a>
					</li>
				{% /foreach %}
			</ul>
		</div>
	</div>

{% /block %}