<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Minifyhtml Class
 * Will Minify the HTML. Reducing network latency, enhancing compression, and faster browser loading and execution.
 *
 * @category    Output
 * @author      John Gerome
 * @link        https://github.com/johngerome/CodeIgniter-Minifyhtml-hooks
 */
class Minifyhtml {

	/**
	 * Responsible for sending final output to browser
	 */
	function output() {
		$CI     =& get_instance();
		$buffer = $CI->output->get_output();
		/*$re = '%            # Collapse ws everywhere but in blacklisted elements.
            (?>             # Match all whitespans other than single space.
              [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
            | \s{2,}        # or two or more consecutive-any-whitespace.
            ) # Note: The remaining regex consumes no text at all...
            (?=             # Ensure we are not in a blacklist tag.
              (?:           # Begin (unnecessary) group.
                (?:         # Zero or more of...
                  [^<]++    # Either one or more non-"<"
                | <         # or a < starting a non-blacklist tag.
                            # Skip Script and Style Tags
                  (?!/?(?:textarea|pre|script|style)\b)
                )*+         # (This could be "unroll-the-loop"ified.)
              )             # End (unnecessary) group.
              (?:           # Begin alternation group.
                <           # Either a blacklist start tag.
                            # Dont foget the closing tags 
                (?>textarea|pre|script|style)\b
              | \z          # or end of file.
              )             # End alternation group.
            )  # If we made it here, we are not in a blacklist tag.
            %ix';*/
		$search = array(
			'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
			'/[^\S ]+\</s',     // strip whitespaces before tags, except space
			'/(\s)+/s',         // shorten multiple whitespace sequences
			'/<!--(.|\s)*?-->/' // Remove HTML comments
		);

		$replace = array(
			'>',
			'<',
			'\\1',
			''
		);


		//$buffer = preg_replace($re, " ", $buffer);
		$buffer = preg_replace( $search, $replace, $buffer );
		$CI->output->set_output( $buffer );
		$CI->output->_display();
	}
}