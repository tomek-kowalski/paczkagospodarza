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

    $output = '';
    $output .= '<div class="certified-frame">';

    $output .= '<div class="certified-column">';
    if ($icon_1) {
        $output .= '<img alt="Paczka Gospodarza certified" src="' . $icon_1 . '">';
    }
    if ($title_1) {
        $output .= '<h4 class="certified-title">' . $title_1 . '</h4>';
    }
    if ($text_section_1) {
        $output .= '<p class="certified-text">' . $text_section_1 . '</p>';
    }
    $output .= '</div>';

    $output .= '<div class="certified-column">';
    if ($icon_2) {
        $output .= '<img alt="Paczka Gospodarza certified" src="' . $icon_2 . '">';
    }
    if ($title_2) {
        $output .= '<h4 class="certified-title">' . $title_2 . '</h4>';
    }
    if ($text_section_2) {
        $output .= '<p class="certified-text">' . $text_section_2 . '</p>';
    }
    $output .= '</div>';

    $output .= '<div class="certified-column">';
    if ($icon_3) {
        $output .= '<img alt="Paczka Gospodarza certified" src="' . $icon_3 . '">';
    }
    if ($title_3) {
        $output .= '<h4 class="certified-title">' . $title_3 . '</h4>';
    }
    if ($text_section_3) {
        $output .= '<p class="certified-text">' . $text_section_3 . '</p>';
    }
    $output .= '</div>';

    $output .= '<div class="certified-column">';
    if ($icon_4) {
        $output .= '<img alt="Paczka Gospodarza certified" src="' . $icon_4 . '">';
    }
    if ($title_4) {
        $output .= '<h4 class="certified-title">' . $title_4 . '</h4>';
    }
    if ($text_section_4) {
        $output .= '<p class="certified-text">' . $text_section_4 . '</p>';
    }
    $output .= '</div>';
    $output .= '</div>';
	$output .= '<div class="border-down"></div>';

    echo $output;

endforeach;
?>

