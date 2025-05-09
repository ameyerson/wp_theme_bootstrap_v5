<?php

function icon_callout( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'icon'  => 'las la-thumbtack',
		'icon-color' => '#00838F'
	), $atts );

	$markup = '<div class="icon-callout">';
	$markup .= '<div class="callout-icon"><i class="' . $a['icon'] . '" style="background-color: ' . $a['icon-color'] . '"></i></div>';
	$markup .= '<div class="callout-content">' . $content . '</div>';
	$markup .= '</div>';

	return $markup;
}

add_shortcode( 'icon-callout', 'icon_callout' );

function theme_wysiwyg_spacing_section( $atts ) {

	$markup = '<div class="spacer-section"></div>';

	return $markup;
}

add_shortcode( 'spacing', 'theme_wysiwyg_spacing_section' );

function theme_poppover( $atts, $content = '<i class="las la-question-circle"></i>' ) {

	$a = shortcode_atts( array(
		'title' => false,
		'body' => false,
	), $atts );


	$popper = '<a class="popper-trigger" tabindex="0" role="button" data-bs-toggle="popover" data-bs-container="article" data-bs-trigger="focus" data-bs-placement="top"';
	if ($a['title'])
		$popper .= ' data-bs-title="' . $a['title'] . '"';
	if ($a['body'])
		$popper .= ' data-bs-content="' . $a['body'] . '"';
	$popper .= '>' . $content . '</a>';

	return $popper;

}
add_shortcode( 'popover', 'theme_poppover' );


function theme_audio_embed( $atts ) {
	$a = shortcode_atts( array(
		'src'  		=> false,
		'resource_id' => false
	), $atts );

	if ($a['src'])
	    get_template_part( 'template-parts/resource/embed', 'audio', array( 'src' => $a['src'], 'resource_id' => $a['resource_id']));

	return ob_get_clean();
}

add_shortcode( 'audio-embed', 'theme_audio_embed' );

function theme_video_ratio_embed( $atts ) {
	$a = shortcode_atts( array(
		'src'  		=> false,
		'ratio' 	=> '16x9',
		'resource_id' => false
	), $atts );

	/*
	default styles for ratios included:
		1x1
		4x3
		16x9
		21x9
	*/
	ob_start();

	if ($a['src'])
	    get_template_part( 'template-parts/resource/embed', 'video', array( 'src' => $a['src'], 'ratio' => $a['ratio'], 'resource_id' => $a['resource_id']) );

	return ob_get_clean();
}

add_shortcode( 'video-embed', 'theme_video_ratio_embed' );


