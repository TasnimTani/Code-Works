<?php
/*
 * Mega Menu API
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

require_once( SEESE_FRAMEWORK .'/core/mega-menu/seese-custom-menu-walker.php' );

class seese_framework_custom_menu {

    public $seese_custom_fields = array( 'mega_menu', 'icon_select', 'mega_menu_columns', 'hide_title' );
    public $walker = null;

	public function __construct() {
		add_action( 'seese_custom_menu_fields', array( $this, 'seese_custom_menu_fields_add_function' ), 10, 2 );
		add_action( 'wp_update_nav_menu_item', array( $this, 'seese_framework_update_fields'), 10, 3 );

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'seese_framework_add_fields' ) );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'seese_framework_edit_walker'), 10, 2 );
		add_filter( 'wp_nav_menu_args', array( $this, 'wp_nav_menu_args' ), 99 );
	}

	/**
	 * Add custom fields
	*/
	public function seese_custom_menu_fields_add_function( $item_id, $item ) {
?>
		<div class="seese-menu-mega">
			<span class="seese-cf-sep"></span>
			<p class="seese-cf-icon_select seese-cf-field description description-wide">
				<?php
				  $hidden = ( empty( $item->icon_select ) ) ? ' hidden' : '';
				  $icon_select_class = ( !empty( $item->icon_select ) ) ? $item->icon_select : '';
				?>
			  <span class="seese-cf-title">Menu Icon : </span>
			  <label for="edit-menu-item-icon_select-<?php echo esc_attr($item_id); ?>" class="cs-icon-select cs-field-icon">
		  		<span class="cs-icon-preview <?php echo esc_attr($hidden); ?>"><i class="<?php echo esc_attr($icon_select_class); ?>"></i></span>
		  		<a href="#" class="button button-primary cs-icon-add">Add Icon</a>
		  		<a href="#" class="button cs-warning-primary cs-icon-remove <?php echo esc_attr($hidden); ?>">Remove Icon</a>
		  		<input type="text" id="edit-menu-item-icon_select-<?php echo esc_attr($item_id); ?>" class="widefat cs-icon-value edit-menu-item-icon_select" name="menu-item-icon_select[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->icon_select ); ?>" />
			  </label>
			</p>
			<p class="seese-cf-mega_menu seese-cf-field description description-thin cs-field-switcher">
                <span class="seese-cf-title">Enable Mega Menu?</span>
                <label for="edit-menu-item-mega_menu-<?php echo esc_attr($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-mega_menu-<?php echo esc_attr($item_id); ?>"<?php checked( $item->mega_menu, 1 ); ?> name="menu-item-mega_menu[<?php echo esc_attr($item_id); ?>]" value="1" />
                    <em data-on="on" data-off="off"></em><span></span>
                </label>
			</p>
			<span class="seese-cf-sep"></span>
		</div>

		<!-- Columns -->
		<div class="seese-menu-columns">
            <span class="seese-cf-sep"></span>
            <p class="seese-cf-mega_menu_columns seese-cf-field description description-thin">
                <span class="seese-cf-title">Mega Menu Columns</span>
                <label for="edit-menu-item-mega_menu_columns-<?php echo esc_attr($item_id); ?>">
    			    <select id="edit-menu-item-mega_menu_columns-<?php echo esc_attr($item_id); ?>" name="menu-item-mega_menu_columns[<?php echo esc_attr($item_id); ?>]">
                        <option value="">Select Columns</option>
                        <?php
                            $mega_menu_columns = array(
                            'col-lg-1 col-md-1 col-sm-1'    => '1 Column',
                            'col-lg-2 col-md-2 col-sm-2'    => '2 Column',
                            'col-lg-3 col-md-3 col-sm-3'    => '3 Column',
                            'col-lg-4 col-md-4 col-sm-4'    => '4 Column',
                            'col-lg-5 col-md-5 col-sm-5'    => '5 Column',
                            'col-lg-6 col-md-6 col-sm-6'    => '6 Column (half)',
                            'col-lg-7 col-md-7 col-sm-7'    => '7 Column',
                            'col-lg-8 col-md-8 col-sm-8'    => '8 Column',
                            'col-lg-9 col-md-9 col-sm-9'    => '9 Column',
                            'col-lg-10 col-md-10 col-sm-10' => '10 Column',
                            'col-lg-11 col-md-11 col-sm-11' => '11 Column',
                            'col-lg-12 col-md-12 col-sm-12' => '12 Column (full-width)'
                            );
                            foreach ($mega_menu_columns as $key => $value) {
                                echo '<option value="'. $key .'"'. selected($key, $item->mega_menu_columns) .'>'. $value .'</option>';
                            }
                        ?>
    			    </select>
                </label>
            </p>
			<p class="seese-cf-hide_title seese-cf-field description description-thin cs-field-switcher">
                <span class="seese-cf-title">Hide Title?</span>
                <label for="edit-menu-item-hide_title-<?php echo esc_attr($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-hide_title-<?php echo esc_attr($item_id); ?>"<?php checked( $item->hide_title, 1 ); ?> name="menu-item-hide_title[<?php echo esc_attr($item_id); ?>]" value="1" />
                    <em data-on="on" data-off="off"></em><span></span>
                </label>
            </p>
            <span class="seese-cf-sep"></span>
		</div>
    <?php
	}

	/**
	 * Add custom fields to $menu_item nav object
	*/
	public function seese_framework_add_fields( $menu_item ) {
        foreach ( $this->seese_custom_fields as $key ) {
            $menu_item->$key = get_post_meta( $menu_item->ID, '_menu_item_'. $key, true );
        }
        return $menu_item;
	}

	/**
	 * Save menu custom fields
	*/
	public function seese_framework_update_fields( $menu_id, $menu_item_db_id, $args ) {
        foreach ( $this->seese_custom_fields as $key ) {
            $value = ( isset( $_REQUEST['menu-item-'.$key][$menu_item_db_id] ) ) ? $_REQUEST['menu-item-'.$key][$menu_item_db_id] : '';
            update_post_meta( $menu_item_db_id, '_menu_item_'. $key, $value );
        }
	}

	/**
	 * Setting these cutomization into core function of WordPress : wp_nav_menu()
	*/
	public function wp_nav_menu_args( $args ) {
        $walker = new Walker_Nav_Menu_Custom();
        $args['container'] = false;
        $args['menu_class'] = 'main-navigation';
        $args['walker'] = $walker;

        return $args;
	}

	/**
	 * Define new Walker edit
	*/
	public function seese_framework_edit_walker($walker,$menu_id) {
        return 'Walker_Nav_Menu_Edit_Custom';
	}

}

// instantiate plugin's class
$GLOBALS['seese_custom_menu'] = new seese_framework_custom_menu();