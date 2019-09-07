<?php
/**
 * Retrieves information from the database.
 *
 * @package Very_Simple_Wp_Statistics
 */
 
/**
 * Retrieves information from the database.
 *
 * This requires the information being retrieved from the database should be
 * specified by an incoming key. If no key is specified or a value is not found
 * then an empty string will be returned.
 *
 * @package Very_Simple_Wp_Statistics
 */

class VSWPS_Content_Messenger {
	/**
	 * A reference to the class for retrieving our option values.
	 *
	 * @access private
	 * @var    deserializer_vswps
	 */
	private $deserializer_vswps;
	/**
	 * Initializes the class by setting a reference to the incoming deserializer_vswps.
	 *
	 * @param deserializer_vswps $deserializer_vswps Retrieves a value from the database.
	 */
	public function __construct( $deserializer_vswps ) {
		$this->deserializer_vswps = $deserializer_vswps;
	}
    /**
     * Adds a submenu for this plugin to the 'Tools' menu.
     */
    public function init() {
        add_filter( 'the_content', array( $this, 'filterStatistics' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'very_simple_wp_statistics_public_scripts' ) );
    }
	
	public function filterStatistics( $content ) {
		if( preg_match_all( '/\[vswpstatistics ID=.* title=.*\]/', $content, $ouputs, PREG_OFFSET_CAPTURE ) ) {

			for( $a = 0; $a < count( $ouputs[0] ); $a++ ) {
				$explodeId =  explode('ID=', $ouputs[0][$a][0]);
				$explodeId =  explode(' ', $explodeId[1]);
				$filter[$a] = $ouputs[0][$a][0];
				$values[$a] = esc_attr( $this->deserializer_vswps->get_filter( 'very_simple_wp_statistics_' . $explodeId[0] ) );
			}

			$control = 1;
			for( $a = 0; $a < count( $values ); $a++ ) {

				if( !empty( $values[$a] ) ) { 
					$styleStatistics = explode( ',', $values[$a] );
					$id = explode( '=', $styleStatistics[0] );
					$title = explode( '=', $styleStatistics[1] );
					$height = explode( '=', $styleStatistics[2] );
					$percentage = explode( '=', $styleStatistics[3] );
					$color = explode( '=', $styleStatistics[4] );
					$colorText = explode( '=', $styleStatistics[5] );
					$text = explode( '=', $styleStatistics[6] );
					$html[$a] = '<p><h3>' . $title[1] . '</h3>';
					
					$text_array = explode('#vswps#', $text[1]);
					$color_array = explode('#vswps#', $color[1]);
					$percentage_array = explode('#vswps#', $percentage[1]);
					$height_array = explode('#vswps#', $height[1]);
					$colorText_array = explode('#vswps#', $colorText[1]);
					for($b = 0; $b < count($text_array); $b++) {
						$html[$a] .= '<span title="" alt="" style="margin-bottom: 2px;display:block;background-color:' . $color_array[$b] . ';width:' . $percentage_array[$b] . '%;height:' . $height[1] . 'px;">';
						$html[$a] .= '<span style="position: absolute;padding-left: 5px;color:' . $colorText_array[$b] . '">' . $text_array[$b] . ' - ' .  $percentage_array[$b] . '%</span>';
						$html[$a] .= '</span>';
					}
					
					$html[$a] .= '</p>';
					
					$content = str_replace( $filter[$a], $html[$a], $content );
					$control++;
				} else {
					$content = str_replace( $filter[$a], '', $content );
				}
			}
			return $content;
		} else {
			return $content;
		}
	}
	
	/**
	 * Proper way to enqueue scripts and styles.
	 */
	public function very_simple_wp_statistics_public_scripts() {
		wp_register_style( 'vswp-statistics-css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
		wp_enqueue_style( 'vswp-statistics-css' );
		wp_enqueue_script( 'very-simple-wp-statistics-scripts', plugin_dir_url( __FILE__ ) . 'js/script.js', array(), '1.0.0', true );
	}
}