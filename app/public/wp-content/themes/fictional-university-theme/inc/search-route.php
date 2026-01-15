<?php

add_action('rest_api_init','universityRegisterSearch');

function universityRegisterSearch() {
    register_rest_route('university/v1', 'search', array(
        'methods' => 'GET',
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'event', 'campus'),
        's' => sanitize_text_field($data['term']),
        'posts_per_page' => -1
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array()
    );
    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if (get_post_type() == 'post' || get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }
        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'professorLandscape'),
            ));
        }
        if (get_post_type() == 'program') {
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ));
        }
        if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'date' => $eventDate,
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'excerpt' => wp_trim_words(get_the_excerpt(), 10),
            ));
        }
        if (get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ));
        }
    }

    return $results;
}