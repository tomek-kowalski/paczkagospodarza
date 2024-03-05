<?php 

$frontpage_data = get_posts(array(
    'post_type'      => 'front-page',
    'numberposts'    => 1,
    'post_status'    => 'publish',
    'orderby'        => 'post_date',
    'order'          => 'DESC',
));

foreach ($frontpage_data as $data) :
    $postid = $data->ID;

    $icon_1             = get_post_meta($postid, 'front_page_icon_1', true);
    $title_1            = get_post_meta($postid, 'front_page_title_1', true);
    $text_section_1     = get_post_meta($postid, 'front_page_text_section_1', true);

    $icon_2             = get_post_meta($postid, 'front_page_icon_2', true);
    $title_2            = get_post_meta($postid, 'front_page_title_2', true);
    $text_section_2     = get_post_meta($postid, 'front_page_text_section_2', true);

    $icon_3             = get_post_meta($postid, 'front_page_icon_3', true);
    $title_3            = get_post_meta($postid, 'front_page_title_3', true);
    $text_section_3     = get_post_meta($postid, 'front_page_text_section_3', true);

    $icon_4             = get_post_meta($postid, 'front_page_icon_4', true);
    $title_4            = get_post_meta($postid, 'front_page_title_4', true);
    $text_section_4     = get_post_meta($postid, 'front_page_text_section_4', true);

    $output  = '';
    $output .= '<div class="certified-frame-mobile">';
    $output .= '<div class="certified-slider">';

    $certified_items = array(
        array('icon' => $icon_1, 'title' => $title_1, 'text' => $text_section_1),
        array('icon' => $icon_2, 'title' => $title_2, 'text' => $text_section_2),
        array('icon' => $icon_3, 'title' => $title_3, 'text' => $text_section_3),
        array('icon' => $icon_4, 'title' => $title_4, 'text' => $text_section_4),
    );

    foreach ($certified_items as $item) {
        $output .= '<div class="certified-column-mobile">';
        if ($item['icon']) {
            $output .= '<img alt="Paczka Gospodarza certified" src="' . $item['icon'] . '">';
        }
        if ($item['title']) {
            $output .= '<h4 class="certified-title">' . $item['title'] . '</h4>';
        }
        if ($item['text']) {
            $output .= '<p class="certified-text">' . $item['text'] . '</p>';
        }
        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '<div class="buttons-slider">';
    $output .= '<div class="prev"></div>';
    $output .= '<div class="next"></div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="border-down-mobile"></div>';


    echo $output;
endforeach;
?>

