<?php 

if( ! class_exists( 'PM_Settings' )){
    class PM_Settings{

        public static $options;

        public function __construct(){
            self::$options = get_option( 'pm_options' );
            add_action( 'admin_init', array( $this, 'admin_init') );
        }

        public function admin_init(){
            
            register_setting( 'pm_group', 'pm_options', array( $this, 'pm_validate' ) );

            add_settings_section(
                'pm_main_section',
                esc_html__( 'How does it work?', 'pm' ),
                null,
                'pm_page1'
            );

            add_settings_section(
                'pm_second_section',
                esc_html__( 'Other Plugin Options', 'pm' ),
                null,
                'pm_page2'
            );

            add_settings_field(
                'pm_shortcode',
                esc_html__( 'Shortcode', 'pm' ),
                array( $this, 'pm_shortcode_callback' ),
                'pm_page1',
                'pm_main_section'
            );

            add_settings_field(
                'pm_title',
                esc_html__( 'Slider Title', 'pm' ),
                array( $this, 'pm_title_callback' ),
                'pm_page2',
                'pm_second_section',
                array(
                    'label_for' => 'pm_title'
                )
            );

            add_settings_field(
                'pm_bullets',
                esc_html__( 'Display Bullets', 'pm' ),
                array( $this, 'pm_bullets_callback' ),
                'pm_page2',
                'pm_second_section',
                array(
                    'label_for' => 'pm_bullets'
                )
            );

            add_settings_field(
                'pm_style',
                esc_html__( 'Slider Style', 'pm' ),
                array( $this, 'pm_style_callback' ),
                'pm_page2',
                'pm_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'pm_style'
                )
                
            );
        }

        public function pm_shortcode_callback(){
            ?>
            <span><?php esc_html_e( 'Use the shortcode [pm] to display the slider in any page/post/widget', 'pm' ); ?></span>
            <?php
        }

        public function pm_title_callback( $args ){
            ?>
                <input 
                type="text" 
                name="pm_options[pm_title]" 
                id="pm_title"
                value="<?php echo isset( self::$options['pm_title'] ) ? esc_attr( self::$options['pm_title'] ) : ''; ?>"
                >
            <?php
        }
        
        public function pm_bullets_callback( $args ){
            ?>
                <input 
                    type="checkbox"
                    name="pm_options[pm_bullets]"
                    id="pm_bullets"
                    value="1"
                    <?php 
                        if( isset( self::$options['pm_bullets'] ) ){
                            checked( "1", self::$options['pm_bullets'], true );
                        }    
                    ?>
                />
                <label for="pm_bullets"><?php esc_html_e( 'Whether to display bullets or not', 'pm' ); ?></label>
                
            <?php
        }

        public function pm_style_callback( $args ){
            ?>
            <select 
                id="pm_style" 
                name="pm_options[pm_style]">
                <?php 
                foreach( $args['items'] as $item ):
                ?>
                    <option value="<?php echo esc_attr( $item ); ?>" 
                        <?php 
                        isset( self::$options['pm_style'] ) ? selected( $item, self::$options['pm_style'], true ) : ''; 
                        ?>
                    >
                        <?php echo esc_html( ucfirst( $item ) ); ?>
                    </option>                
                <?php endforeach; ?>
            </select>
            <?php
        }

        public function pm_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                switch ($key){
                    case 'pm_title':
                        if( empty( $value )){
                            add_settings_error( 'pm_options', 'pm_message', esc_html__( 'The title field can not be left empty', 'pm' ), 'error' );
                            $value = esc_html__( 'Please, type some text', 'pm' );
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }
            }
            return $new_input;
        }

    }
}

$settings = new PM_Settings();