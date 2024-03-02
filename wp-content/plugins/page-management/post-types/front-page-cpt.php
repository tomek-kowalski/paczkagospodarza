<?php 

if( !class_exists( 'PM_Post_Type_Front') ){
    class PM_Post_Type_Front extends PM{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'admin_enqueue_scripts', array($this,'meta_image_enqueue') );
        }


        public function create_post_type(){
            register_post_type(
                'front-page',
                array(
                    'label'                 => esc_html__( 'Item', 'page_manage' ),
                    'description'           => esc_html__( 'Page management', 'page_manage' ),
                    'labels'                => array(
                        'name'              => esc_html__( 'Items', 'page_manage' ),
                        'singular_name'     => esc_html__( 'Item', 'page_manage' ),
                    ),
                    'public'                => true,
                    'supports'              => array( 'title' ),
                    'hierarchical'          => false,
                    'show_ui'               => true,
                    'show_in_menu'          => false,
                    'menu_position'         => 5,
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'has_archive'           => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'show_in_rest'          => true,
                    'menu_icon'             => 'dashicons-images-alt2',
                )
            );
        }

        function meta_image_enqueue() {
  
                wp_enqueue_media();

                wp_enqueue_style( 'pm-admin', PM_URL . 'assets/css/admin.css' );

                wp_register_script( 'meta-box-image', PM_URL . 'assets/js/meta-box-image.js', array( 'jquery' ) );
                wp_localize_script( 'meta-box-image', 'meta_image_img',
                    array(
                        'title'  => __( 'Choose an Image', 'page_manage' ),
                        'button' => __( 'Use this image', 'page_manage' ),
                    )
                );
                wp_enqueue_script( 'meta-box-image' );

        }

        public function add_meta_boxes(){
            add_meta_box(
                'front-page_meta_box',
                esc_html__( 'Front Page Options', 'page_manage' ),
                array( $this, 'add_inner_meta_boxes' ),
                'front-page',
                'normal',
                'high' 
            );
        }

        public function add_inner_meta_boxes($post){
            require_once( PM_PATH . 'views/front-page_metabox.php' );
        }

        public function save_post( $post_id ){
            if( isset( $_POST['pm_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['pm_nonce'], 'pm_nonce' ) ){
                    return;
                }
            }

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            if( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'front-page' ){
                if( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }
            
            if (isset($_POST['action']) && $_POST['action'] == 'editpost' && $_POST['post_type'] === 'front-page' ) {

                $this->save_meta_field("front_page_image_1");
                $this->save_meta_field("front_page_text_1");

                $this->save_meta_field("front_page_icon_1");
                $this->save_meta_field("front_page_title_1");
                $this->save_meta_field("front_page_text_section_1");

                $this->save_meta_field("front_page_icon_2");
                $this->save_meta_field("front_page_title_2");
                $this->save_meta_field("front_page_text_section_2");

                $this->save_meta_field("front_page_icon_3");
                $this->save_meta_field("front_page_title_3");
                $this->save_meta_field("front_page_text_section_3");

                $this->save_meta_field("front_page_icon_4");
                $this->save_meta_field("front_page_title_4");
                $this->save_meta_field("front_page_text_section_4");

                $this->save_meta_field("front_page_images_1");
                $this->save_meta_field("front_page_images_2");
                $this->save_meta_field("front_page_images_3");
            }   
        }
    }
}

$pm = new PM_Post_Type_Front();