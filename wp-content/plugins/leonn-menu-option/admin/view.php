<?php
/**
 * Sample View
 */

 /* 
    <input type="text" name="lmo_text" value="<?php echo esc_attr( get_option('lmo_text') ); ?>" />

 */
?>
    
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="/wp-admin/admin-post.php">
    <?php
        // This prints out all hidden setting fields
        settings_fields( 'leoon_menu_option_group' );
        do_settings_sections( 'leoon_menu_option_page' );
        submit_button();
    ?>
    </form>
</div>

