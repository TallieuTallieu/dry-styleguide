<?php

namespace Tnt\Styleguide\Controller;

use Tnt\Styleguide\Template;
use Tnt\Styleguide\Support;

use app\container\Application;

class StyleguideController
{
	public static function index( $request )
	{
		$atoms = Support\get_list( Support\TYPE_ATOM );
		$molecules = Support\get_list( Support\TYPE_MOLECULE );
		$organisms = Support\get_list( Support\TYPE_ORGANISM );

		$tpl = Application::get()->get(Template::class);
		$tpl->atoms = $atoms;
		$tpl->molecules = $molecules;
		$tpl->organisms = $organisms;
		$tpl->render('index.tpl');
	}

	public static function viewType( $request )
	{
		$type_map = [
			'a' => Support\TYPE_ATOM,
			'm' => Support\TYPE_MOLECULE,
			'o' => Support\TYPE_ORGANISM,
		];

		$type_short = $request->parameters->string( 'type' );
		$type = $type_map[ $type_short ];
		$list = Support\get_list( $type );

		$tpl = Application::get()->get(Template::class);
		$tpl->components = Support\get_rendered_list( $type, $list );
		$tpl->type_short = $type_short;
		$tpl->type_plural = $type.'s';
		$tpl->meta = Support\get_meta_list( $type, $list );
		$tpl->render('view_type.tpl');
	}

	public static function viewComponent( $request )
	{
		$type_map = [
			'a' => Support\TYPE_ATOM,
			'm' => Support\TYPE_MOLECULE,
			'o' => Support\TYPE_ORGANISM,
		];

		$type_short = $request->parameters->string( 'type' );
		$component = $request->parameters->string( 'component' );
		$type = $type_map[ $type_short ];

		$tpl = Application::get()->get(Template::class);
		$tpl->type_short = $type_short;
		$tpl->type_plural = $type.'s';
		$tpl->component_name = $component;
		$tpl->modifiers = Support\get_rendered_component( $type, $component );
		$tpl->examples = Support\get_rendered_examples( $type, $component );
		$tpl->meta = Support\get_meta( $type, $component );
		$tpl->render('view_component.tpl');
	}

	public static function viewComponentModifier( $request )
	{
		$type_map = [
			'a' => Support\TYPE_ATOM,
			'm' => Support\TYPE_MOLECULE,
			'o' => Support\TYPE_ORGANISM,
		];

		$type_short = $request->parameters->string( 'type' );
		$component = $request->parameters->string( 'component' );
		$modifier = $request->parameters->string( 'modifier' );
		$type = $type_map[ $type_short ];

		$tpl = Application::get()->get(Template::class);
		$tpl->type_short = $type_short;
		$tpl->type_plural = $type.'s';
		$tpl->component_name = $component;
		$tpl->modifier_name = $modifier;
		$tpl->source = Support\render( $type, $component, $modifier );
		$tpl->meta = Support\get_meta( $type, $component );
		$tpl->render('view_component_modifier.tpl');
	}
}