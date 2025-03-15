<?php
/**
 * GeneratePress.
 *
 * Please do not make any edits to this file. All edits should be done in a child theme.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



// Set our theme version.
define( 'GENERATE_VERSION', '3.5.1' );

if ( ! function_exists( 'generate_setup' ) ) {
	add_action( 'after_setup_theme', 'generate_setup' );
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.1
	 */
	function generate_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'generatepress' );

		// Add theme support for various features.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		$color_palette = generate_get_editor_color_palette();

		if ( ! empty( $color_palette ) ) {
			add_theme_support( 'editor-color-palette', $color_palette );
		}

		add_theme_support(
			'custom-logo',
			array(
				'height' => 70,
				'width' => 350,
				'flex-height' => true,
				'flex-width' => true,
			)
		);

		// Register primary menu.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'generatepress' ),
			)
		);

		/**
		 * Set the content width to something large
		 * We set a more accurate width in generate_smart_content_width()
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1200; /* pixels */
		}

		// Add editor styles to the block editor.
		add_theme_support( 'editor-styles' );

		$editor_styles = apply_filters(
			'generate_editor_styles',
			array(
				'assets/css/admin/block-editor.css',
			)
		);

		add_editor_style( $editor_styles );
	}
}



function display_form_entries() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'db7_forms'; 

    $results = $wpdb->get_results("SELECT form_value FROM $table_name ORDER BY form_id DESC");

    $output = '<table>';
    $output .= '<tr><th>Team Name</th><th>Name</th><th>Surname</th><th>University</th><th>Student ID</th><th>Department</th><th>Role</th><th>Email</th><th>Video Link</th><th>Proposal</th></tr>';

    if ($results) {
        foreach ($results as $row) {

            $form_data = unserialize($row->form_value);

            $team_name = isset($form_data['team_name']) ? esc_html($form_data['team_name']) : 'N/A';
            $video_link = isset($form_data['video_link']) ? esc_url($form_data['video_link']) : 'N/A';
            $person1_proposal = isset($form_data['person1_proposalcfdb7_file']) ? esc_html($form_data['person1_proposalcfdb7_file']) : 'N/A';


            $person1_name = isset($form_data['person1_name']) ? esc_html($form_data['person1_name']) : 'N/A';
            $person1_surname = isset($form_data['person1_surname']) ? esc_html($form_data['person1_surname']) : 'N/A';
            $person1_university = isset($form_data['person1_university']) ? esc_html($form_data['person1_university']) : 'N/A';
            $person1_student_id = isset($form_data['person1_student_id']) ? esc_html($form_data['person1_student_id']) : 'N/A';
            $person1_department = isset($form_data['person1_department']) ? esc_html($form_data['person1_department']) : 'N/A';
            $person1_role = isset($form_data['person1_role']) ? implode(", ", $form_data['person1_role']) : 'N/A';
            $person1_email = isset($form_data['person1_email']) ? esc_html($form_data['person1_email']) : 'N/A';

            $person2_name = isset($form_data['person2_name']) ? esc_html($form_data['person2_name']) : '';
            $person2_surname = isset($form_data['person2_surname']) ? esc_html($form_data['person2_surname']) : '';
            $person2_university = isset($form_data['person2_university']) ? esc_html($form_data['person2_university']) : '';
            $person2_student_id = isset($form_data['person2_student_id']) ? esc_html($form_data['person2_student_id']) : '';
            $person2_department = isset($form_data['person2_department']) ? esc_html($form_data['person2_department']) : '';
            $person2_role = isset($form_data['person2_role']) ? implode(", ", $form_data['person2_role']) : '';
            $person2_email = isset($form_data['person2_email']) ? esc_html($form_data['person2_email']) : '';

            $person3_name = isset($form_data['person3_name']) ? esc_html($form_data['person3_name']) : '';
            $person3_surname = isset($form_data['person3_surname']) ? esc_html($form_data['person3_surname']) : '';
            $person3_university = isset($form_data['person3_university']) ? esc_html($form_data['person3_university']) : '';
            $person3_student_id = isset($form_data['person3_student_id']) ? esc_html($form_data['person3_student_id']) : '';
            $person3_department = isset($form_data['person3_department']) ? esc_html($form_data['person3_department']) : '';
            $person3_role = isset($form_data['person3_role']) ? implode(", ", $form_data['person3_role']) : '';
            $person3_email = isset($form_data['person3_email']) ? esc_html($form_data['person3_email']) : '';

            $output .= '<tr>';
            $output .= '<td>' . $team_name . '</td>'; 
            $output .= '<td>' . $person1_name . '</td>';
            $output .= '<td>' . $person1_surname . '</td>';
            $output .= '<td>' . $person1_university . '</td>';
            $output .= '<td>' . $person1_student_id . '</td>';
            $output .= '<td>' . $person1_department . '</td>';
            $output .= '<td>' . $person1_role . '</td>';
            $output .= '<td>' . $person1_email . '</td>';
            $output .= '<td><a href="' . $video_link . '" target="_blank">Video</a></td>';
            $output .= '<td><a href="' . esc_url($person1_proposal) . '" target="_blank">Proposal</a></td>';
            $output .= '</tr>';


            if (!empty($person2_name)) {
                $output .= '<tr>';
                $output .= '<td></td>';
                $output .= '<td>' . $person2_name . '</td>';
                $output .= '<td>' . $person2_surname . '</td>';
                $output .= '<td>' . $person2_university . '</td>';
                $output .= '<td>' . $person2_student_id . '</td>';
                $output .= '<td>' . $person2_department . '</td>';
                $output .= '<td>' . $person2_role . '</td>';
                $output .= '<td>' . $person2_email . '</td>';
                $output .= '<td><a href="' . $video_link . '" target="_blank">Video</a></td>';
                $output .= '<td><a href="' . esc_url($person1_proposal) . '" target="_blank">Proposal</a></td>';
                $output .= '</tr>';
            }


            if (!empty($person3_name)) {
                $output .= '<tr>';
                $output .= '<td></td>'; 
                $output .= '<td>' . $person3_name . '</td>';
                $output .= '<td>' . $person3_surname . '</td>';
                $output .= '<td>' . $person3_university . '</td>';
                $output .= '<td>' . $person3_student_id . '</td>';
                $output .= '<td>' . $person3_department . '</td>';
                $output .= '<td>' . $person3_role . '</td>';
                $output .= '<td>' . $person3_email . '</td>';
                $output .= '<td><a href="' . $video_link . '" target="_blank">Video</a></td>';
                $output .= '<td><a href="' . esc_url($person1_proposal) . '" target="_blank">Proposal</a></td>';
                $output .= '</tr>';
            }
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';
	$output .= '<td class="empty-cell"></td>';

        }
        $output .= '</table>';
    } else {
        $output .= 'No entries found.';
    }

    return $output;
}

add_shortcode('display_form_entries', 'display_form_entries');



/**
 * Get all necessary theme files
 */
$theme_dir = get_template_directory();

require $theme_dir . '/inc/theme-functions.php';
require $theme_dir . '/inc/defaults.php';
require $theme_dir . '/inc/class-css.php';
require $theme_dir . '/inc/css-output.php';
require $theme_dir . '/inc/general.php';
require $theme_dir . '/inc/customizer.php';
require $theme_dir . '/inc/markup.php';
require $theme_dir . '/inc/typography.php';
require $theme_dir . '/inc/plugin-compat.php';
require $theme_dir . '/inc/block-editor.php';
require $theme_dir . '/inc/class-typography.php';
require $theme_dir . '/inc/class-typography-migration.php';
require $theme_dir . '/inc/class-html-attributes.php';
require $theme_dir . '/inc/class-theme-update.php';
require $theme_dir . '/inc/class-rest.php';
require $theme_dir . '/inc/deprecated.php';

if ( is_admin() ) {
	require $theme_dir . '/inc/meta-box.php';
	require $theme_dir . '/inc/class-dashboard.php';
}

/**
 * Load our theme structure
 */
require $theme_dir . '/inc/structure/archives.php';
require $theme_dir . '/inc/structure/comments.php';
require $theme_dir . '/inc/structure/featured-images.php';
require $theme_dir . '/inc/structure/footer.php';
require $theme_dir . '/inc/structure/header.php';
require $theme_dir . '/inc/structure/navigation.php';
require $theme_dir . '/inc/structure/post-meta.php';
require $theme_dir . '/inc/structure/sidebars.php';
require $theme_dir . '/inc/structure/search-modal.php';
