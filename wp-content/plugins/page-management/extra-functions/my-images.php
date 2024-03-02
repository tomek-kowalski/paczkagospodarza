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

    $image_1 = get_post_meta($postid, 'front_page_images_1', true);
    $image_2 = get_post_meta($postid, 'front_page_images_2', true);
    $image_3 = get_post_meta($postid, 'front_page_images_3', true);

    $output = '';
    $output .= '<div class="images-frame">';

    $output .= '<div class="images-column">';
    if ($image_1) {
        $link_diary = esc_url(get_permalink(get_page_by_path('nabial-jaja')));
        $output .= '<a href="' . $link_diary . '">';
        $output .= '<img alt="Paczka Gospodarza Linki" src="' . esc_url($image_1) . '">';
        $output .= '</a>';
    }
    $output .= '</div>';

    $output .= '<div class="images-column">';
    if ($image_2) {
        $link_shop = esc_url(get_permalink(get_page_by_path('sklep')));
        $output .= '<a href="' . $link_shop . '">';
        $output .= '<img alt="Paczka Gospodarza Linki" src="' . esc_url($image_2) . '">';
        $output .= '</a>';
    }
    $output .= '</div>';

    $output .= '<div class="images-column">';
    if ($image_3) {
        $link_blog = esc_url(get_permalink(get_page_by_path('blog')));
        $output .= '<a href="' . $link_blog . '">';
        $output .= '<img alt="Paczka Gospodarza Linki" src="' . esc_url($image_3) . '">';
        $output .= '</a>';
    }
    $output .= '</div>';

    $output .= '</div>';

    echo $output;

endforeach;

?>