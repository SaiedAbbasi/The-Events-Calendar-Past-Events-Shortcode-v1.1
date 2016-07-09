<?php
/***
 Plugin Name: The Events Calendar Past Events Shortcode
 Plugin URI: https://github.com/colundrum/The-Events-Calendar-Past-Events-Shortcode
 Description: An addon to add shortcode functionality for <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar Plugin (Free Version) by Modern Tribe</a> for past events.
 Version: 1.0.0
 Author: COLUNDRUM
 Author URI: http://www.colundrum.com
 License: GPL3 or later
 License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Events calendar shortcode addon main class
 *
 * @package events-calendar--past-events-shortcode
 * @author COLUNDRUM
 * @version 1.0.0
 */
class Events_Calendar_Past_Events_Shortcode
{
	/**
	 * Current version of the plugin.
	 *
	 * @since 1.0.0
	 */
	const VERSION = '1.0.0';

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see	 add_shortcode()
	 */
	public function __construct()
	{
		add_shortcode('ecspe-list-events', array($this, 'ecspe_fetch_events') ); // link new function to shortcode name
	} // END __construct()

	/**
	 * Fetch and return required events.
	 * @param  array $atts 	shortcode attributes
	 * @return string 	shortcode output
	 */
	public function ecspe_fetch_events( $atts )
	{
		/**
		 * Check if events calendar plugin method exists
		 */
		if ( !function_exists( 'tribe_get_events' ) ) {
			return;
		}

		global $wp_query, $post;
		$output = '';
		$ecspe_event_tax = '';

		extract( shortcode_atts( array(
			'cat' => '',
			'limit' => 15,
			'eventdetails' => 'true',
			'venue' => 'false',
			'message' => 'There are no upcoming events at this time.',
			'order' => 'ASC',
			'viewall' => 'false',
			'excerpt' => 'true',
			'thumb' => 'true',
			'thumbwidth' => '',
			'thumbheight' => ''
		), $atts, 'ecspe-list-events' ), EXTR_PREFIX_ALL, 'ecspe' );

		if ($ecspe_cat) {
			$ecspe_event_tax = array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'slug',
					'terms' => $ecspe_cat
				)
			);
		}

		$posts = get_posts( array(
				'post_type' => 'tribe_events',
				'posts_per_page' => $ecspe_limit,
				'tax_query'=> $ecspe_event_tax,
				'meta_key' => '_EventEndDate',
				'orderby' => 'meta_value',
				'order' => $ecspe_order,
				'meta_query' => array(
									array(
										'key' => '_EventEndDate',
										'value' => date('Y-m-d'),
										'compare' => '<',
										'type' => 'DATETIME'
									)
								)
		) );

		if ($posts) {

			$output .= '<ul class="ecspe-event-list">';
			foreach( $posts as $post ) :
				setup_postdata( $post );
				$output .= '<div class="type-tribe_events post-396 tribe-clearfix tribe-events-category-documentary-feature tribe-events-category-gay tribe-events-venue-372 tribe-events-last"><li class="ecspe-event">';
					$output .= '<h2 class="tribe-events-list-event-title entry-title summary">' .
									'<a href="' . tribe_get_event_link() . '" rel="bookmark">' . get_the_title() . '</a>';
            
          if ( tribe_get_custom_field( 'Member Only' ) ) {
						$output .= '<img src="' . tribe_get_custom_field( 'Member Only' ) . '" rel="bookmark">';
					}
								$output .= '</h2>';

          if( self::isValid($ecspe_eventdetails) ) {
						$output .= '<div class="tribe-events-event-meta vcard">
						  <div class="author  location">
						    <div class="updated published time-details">
						      <span class="tribe-event-date-start">' . tribe_events_event_schedule_details() . '</span>
						    </div>
						  </div>  
						</div>';
					}

					if( self::isValid($ecspe_venue) ) {
						$output .= '<span class="duration venue"><em> at </em>' . tribe_get_venue() . '</span>';
					}
          
					if( self::isValid($ecspe_thumb) ) {
						$thumbWidth = is_numeric($ecspe_thumbwidth) ? $ecspe_thumbwidth : '';
						$thumbHeight = is_numeric($ecspe_thumbheight) ? $ecspe_thumbheight : '';
						if( !empty($thumbWidth) && !empty($thumbHeight) ) {
							$output .= get_the_post_thumbnail(get_the_ID(), array($thumbWidth, $thumbHeight) );
						} else {
							$output .= '<div class="tribe-events-event-image">' .
							        '<a href="' . tribe_get_event_link() . '" rel="bookmark">' . get_the_post_thumbnail(get_the_ID()) .'</a>
							      </div>';
						}
					}

					if( self::isValid($ecspe_excerpt) ) {
						$excerptLength = is_numeric($ecspe_excerpt) ? $ecspe_excerpt : 250;
						$output .= '<p style="line-height: 1.7; margin: 0 0 10px;" class="ecspe-excerpt">' .
										self::get_excerpt($excerptLength) .
									'</p><a href="' . tribe_get_event_link() . '" class="tribe-events-read-more" rel="bookmark">Find out more / Trailer</a>';
					}






				$output .= '</li></div>';
			endforeach;
			$output .= '</ul>';

			if( self::isValid($ecspe_viewall) ) {
				$output .= '<span class="ecspe-all-events"><a href="' . tribe_get_events_link() . '" rel="bookmark">' . translate( 'View All Events', 'tribe-events-calendar' ) . '</a></span>';
			}

		} else { //No Events were Found
			$output .= translate( $ecspe_message, 'tribe-events-calendar' );
		} // endif

		wp_reset_query();

		return $output;
	}

	/**
	 * Checks if the plugin attribute is valid
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 * @return boolean
	 */
	private function isValid( $prop )
	{
		return ($prop !== 'false');
	}

	/**
	 * Fetch and trims the excerpt to specified length
	 *
	 * @param integer $limit Characters to show
	 * @param string $source  content or excerpt
	 *
	 * @return string
	 */
	private function get_excerpt( $limit, $source = null )
	{
		$excerpt = get_the_excerpt();
		if( $source == "content" ) {
			$excerpt = get_the_content();
		}

		$excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
		$excerpt = strip_tags( strip_shortcodes($excerpt) );
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt .= '...';

		return $excerpt;
	}
}

/**
 * Instantiate the main class
 *
 * @since 1.0.0
 * @access public
 *
 * @var	object	$events_calendar_past_events_shortcode holds the instantiated class {@uses Events_Calendar_Past_Events_Shortcode}
 */
global $events_calendar_past_events_shortcode;
$events_calendar_past_events_shortcode = new Events_Calendar_Past_Events_Shortcode();
