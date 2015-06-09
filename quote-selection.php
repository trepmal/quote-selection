<?php
/*
 * Plugin Name: Quote Selection
 * Plugin URI: trepmal.com
 * Description:
 * Version: 0.0.0
 * Author: Kailey Lampert
 * Author URI: kaileylampert.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * TextDomain: quote-selection
 * DomainPath:
 * Network:
 */

$quote_selection = new Quote_Selection();

class Quote_Selection {

	var $textdomain = 'quote-selection';

	function __construct() {
		add_action( 'comment_form_top', array( $this, 'comment_form_top' ) );
		add_action( 'comment_form_top', array( $this, 'comment_form_top_scripts' ), 11 );
	}

	function comment_form_top() {
		echo '<button id="quote-selection">Quote Selection</button>';
	}

	function comment_form_top_scripts() {
		wp_enqueue_script('jquery');
		?>
<script>
jQuery('#quote-selection').on('click', function(ev) {
	ev.preventDefault();
	var selection   = getSelectionText(),
					  // regex modified from https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim#Polyfill
		rtrim       = /^[\s\r\n\uFEFF\xA0]+|[\s\r\n\uFEFF\xA0]+$/g;
		commentform = jQuery( document.getElementById('comment') ),
		commenttext = commentform.val(),
		padleft     = "\n",
		padright    = "\n";

	if ( '' == commenttext ) {
		padleft = '';
	}

	// trim leading and trailing whitespace
	selection = selection.replace( rtrim, '' );

	if ( '' == selection ) {
		return true;
	}

	<?php
		// only wrap in '<blockquote>' if that tag is allowed
		// @todo Make tag customizable
		global $allowedtags;
		if ( isset( $allowedtags['blockquote'] ) ) :
	?>
	// wrap
	quote = '<blockquote>' + selection + '</blockquote>';
	<?php endif; // blockquote in $allowedtags ?>

	quote = padleft + quote + padright;

	// append to value so as not to overwrite anything already entered
	commentform.val( commenttext + quote );
});

function getSelectionText() {
	var text = "";
	if ( window.getSelection ) {
		text = window.getSelection().toString();
	} else if ( document.selection && document.selection.type != "Control" ) {
		text = document.selection.createRange().text;
	}
	return text;
}
</script>
		<?php
	}

}