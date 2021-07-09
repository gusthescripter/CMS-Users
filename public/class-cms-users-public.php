<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CMS_Users
 * @subpackage CMS_Users/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CMS_Users
 * @subpackage CMS_Users/public
 * @author     Your Name <email@example.com>
 */
class CMS_Users_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cms_users    The ID of this plugin.
	 */
	private $cms_users;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $cms_users       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cms_users, $version ) {

		$this->cms_users = $cms_users;
		
		$this->version = $version;

	}
	
	//1. Add a new form element...
	
	public function reg_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
	$last_name = ( ! empty( $_POST['last_name'] ) ) ? sanitize_text_field( $_POST['last_name'] ) : '';
        
        ?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(  $first_name  ); ?>" size="25" /></label>
        </p>

		<p>
            <label for="last_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(  $last_name  ); ?>" size="25" /></label>
        </p>

        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    
    public function reg_err( $errors ) {
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include a first name.', 'mydomain' ) ) );

        }
		if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
        $errors->add( 'last_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include a last name.', 'mydomain' ) ) );

        }

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    
    public function reg_user( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
        }
		if ( ! empty( $_POST['last_name'] ) ) {
            update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
        }
		
    }
	
	
	public function wfp_shortcode() {
		
		ob_start();
		custom_registration_function();

		return ob_get_clean();
	}
	
	public function dumb_code() {
		return 'test1';
		wfp_html();
		return 'test2';
		return wfp_html();
		return 'test3';
	}
	
	public function my_shortcode( $atts ) {
		return 'Hello World';
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CMS_Users_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CMS_Users_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->cms_users, plugin_dir_url( __FILE__ ) . 'css/cms-users-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CMS_Users_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CMS_Users_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->cms_users, plugin_dir_url( __FILE__ ) . 'js/cms-users-public.js', array( 'jquery' ), $this->version, false );

	}

}
