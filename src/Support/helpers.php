<?php

namespace Tnt\Styleguide\Support;

use dry\Template;

const TYPE_ATOM = 'atom';
const TYPE_MOLECULE = 'molecule';
const TYPE_ORGANISM = 'organism';

function get_list( $type )
{
	$plural = $type . 's';
	$dir = 'app/templates/styleguide/' . $plural . '/';

	return array_values( array_filter( scandir( $dir ), function( $value )
	{
		return ( ! in_array( $value, [ '.', '..', ] ) );
	} ) );
}

function get_component_modifiers( $type, $component )
{
	$plural = $type . 's';
	$dir = 'app/templates/styleguide/' . $plural . '/' . $component . '/';

	$all_modifiers = array_map( function( $value ) use ( $dir ) {

		return str_replace( '.tpl', '', str_replace( $dir, '', $value ) );

	}, glob( $dir . '*.tpl' ) );

	return array_filter( $all_modifiers, function( $modifier )
	{
		return ( $modifier !== 'default' );
	} );
}

function get_component_examples( $type, $component )
{
	$plural = $type . 's';
	$dir = 'app/templates/styleguide/' . $plural . '/' . $component . '/examples/';

	$all_examples = array_map( function( $value ) use ( $dir ) {

		return str_replace( '.tpl', '', str_replace( $dir, '', $value ) );

	}, glob( $dir . '*.tpl' ) );

	return $all_examples;
}

function get_rendered_list( $type, $list )
{
	$rendered_list = [];

	foreach( $list as $component )
	{
		$rendered_list[ $component ] = get_rendered_component( $type, $component );
	}

	return $rendered_list;
}

function get_rendered_component( $type, $component )
{
	$modifiers = get_component_modifiers( $type, $component );

	$component_modifiers = [
		'default' => render( $type, $component ),
	];

	foreach( $modifiers as $m )
	{
		$component_modifiers[ $m ] = render( $type, $component, $m );
	}

	return $component_modifiers;
}

function get_rendered_examples( $type, $component )
{
	$examples = get_component_examples( $type, $component );

	$component_examples = [];

	foreach( $examples as $e )
	{
		$component_examples[ $e ] = render( $type, $component, 'examples/' . $e );
	}

	return $component_examples;
}

function get_meta_list( $type, $list )
{
	$rendered_list = [];

	foreach( $list as $component )
	{
		$rendered_list[ $component ] = get_meta( $type, $component );
	}

	return $rendered_list;
}

function get_meta( $type, $component )
{
	$plural = $type . 's';
	$dir = 'app/templates/styleguide/' . $plural . '/' . $component . '/';

	if( ! file_exists( $dir . 'meta.json' ) )
	{
		return [];
	}

	$json = file_get_contents( $dir . 'meta.json' );
	$meta = json_decode( $json, TRUE );

	if( ! $meta )
	{
		return [];
	}

	return $meta;
}

function render( $type, $component, $modifier = NULL )
{
	$modifier = $modifier ?: 'default';
	$plural = $type . 's';
	$dir = 'styleguide/' . $plural . '/';
	$file = $dir . $component . '/' . $modifier . '.tpl';

	$tpl = new Template();
	return $tpl->get( $file );
}