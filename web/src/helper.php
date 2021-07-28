<?php

use Sanity\Client as SanityClient;
use Sanity\BlockContent;

if (!defined('SLOWFOOT_BASE')) {
    define('SLOWFOOT_BASE', __DIR__ . '/../');
}

function load_preview_object($id, $type = null, $config) {
    // print_r($config);
    //print_r(apache_request_headers());
    //print_r($_COOKIE);
    $client = sanity_client($config['preview']['sanity']);

    $document = $client->getDocument($id);
    //print_r($document);
    return $document;
    return [
        '_id' => $id,
        '_type' => 'artist',
        'title' => 'hoho',
        'firstname' => 'HEiko',
        'familyname' => 'van Gogh'
    ];
}

function load_sanity($opts, $config) {
    $client = sanity_client($opts);
    $query = $config['query'] ?? '*[!(_type match "system.*") && !(_id in path("drafts.**"))]';
    $res = $client->fetch($query);
    return $res;
}

function sanity_client($config) {
    return new SanityClient($config);
}
function split_tags($tags) {
    return array_filter(array_map('trim', preg_split('/[,;]/', $tags)), 'trim');
}

/* 
    $sl could be 
    - a sanity#link object
    - a sanity#nav_item
*/
function sanity_link($sl, $opts=[], $ds){
    $link = $sl['link'];
    if(!$link) $link = $sl;
    #print_r($link);
    $url = sanity_link_url($link, $ds);

    $text = $opts['text']?:$sl['text'];
    if(!$text){
        if($link['internal']){
            $internal = $ds->ref($link['internal']);
            $text = $internal['title'];
        }else{
            $text = $url;
        }
    }
    return sprintf('<a href="%s">%s</a>', $url, $text);
}

function sanity_link_url($link, $ds){
    return $link['internal'] ? $ds->get_path($link['internal']['_ref']) : (  $link['route'] ? path_page($link['route']): $link['external'] );
}

function sanity_text($block, $ds, $config){
    $conf = $config['sources']['sanity'];
    #var_dump($conf);
    #var_dump($block);

    $html = BlockContent::toHtml($block, [
      'projectId'    => $conf['projectId'],
      'dataset'      => $conf['dataset'],
      'serializers' => [
        'marks'=>[
            'link' => [
                'head' => function ($mark) use($ds){
                    return '<a href="' . sanity_link_url($mark, $ds) . '">';
                },
                'tail' => '</a>'
            ]
        ]
        ,
        'xxxlistItem' => function ($item, $parent, $htmlBuilder) {
          return '<li class="my-list-item">' . implode('\n', $item['children']) . '</li>';
        },
        'xxxgeopoint' => function ($item) {
          $attrs = $item['attributes'];
          $url = 'https://www.google.com/maps/embed/v1/place?key=someApiKey&center=';
          $url .= $attrs['lat'] . ',' . $attrs['lng'];
          return '<iframe class="geomap" src="' . $url . '" allowfullscreen></iframe>';
        },
        'xxxpet' => function ($item, $parent, $htmlBuilder) {
          return '<p class="pet">' . $htmlBuilder->escape($item['attributes']['name']) . '</p>';
        }
      ]
    ]);
  return $html;
}
