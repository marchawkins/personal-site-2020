<?php

Kirby::plugin('roland/video', [
  'tags' => [
      'videoself' => [
        'attr' => [
          'width',
          'height',
          'poster',
          'text',
          'caption',
          'title',
          'class',
          'vidclass',
          'caption',
          'preload',
          'controls',
          'mp4'
        ],
        'html' => function($tag) {

          $url          = $tag->videoself;
          $caption      = $tag->caption;
          $alt          = $tag->alt;
          $title        = $tag->title;
          $link         = $tag->link;
          $caption      = $tag->caption;
          $file         = $tag->parent()->file($url);
          $poster       = $tag->parent()->file($tag->poster);

          // use the file url if available and otherwise the given url
          $url = $file ? $file : url($url);

          // alt is just an alternative for text
          if($text = $tag->text) $alt = $text;

          // try to get the title from the image object and use it as alt text
          if($file) {
            if(empty($alt) and $file->alt() != '') {
              $alt = $file->alt();
            }
            if(empty($title) and $file->title() != '') {
              $title = $file->title();
            }
          }

          if(empty($alt)) $alt = pathinfo($url, PATHINFO_FILENAME);

          $args = array(
            'videos'    => array($file),
            'width'     => $tag->width,
            'height'    => $tag->height,
            'class'     => $tag->vidclass,
            'poster'    => $tag->poster,
            'preload'   => $tag->preload,
            'caption'   => $caption,
            'controls'  => $tag->controls,
            'title'     => $title,
            'url'       => $url,
            'alt'       => $alt

          );


          if($mp4 = $tag->parent()->file($file)) {
            $args['videos'][] = $mp4;
          }

          if($poster = $tag->parent()->file($tag->poster)) {
            $args['poster'] = $poster;
          }

          $video = snippet('video', $args, true);

          $caption = Html::tag('figcaption', [$caption]);

          $video .= $caption;

          $figure = Html::tag('figure', [$video], ['class' => $tag->class]);


          return $figure;
        }
      ]
    ]
]);

/* sample usage:
(video:videofile.mp4 width:100% height:100% poster:yourposterimage.jpg class:video-post title:Your Video Title caption:Your Video Caption)
*/
?>