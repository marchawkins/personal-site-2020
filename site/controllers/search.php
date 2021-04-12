<?php

/**
 * Controllers allow you to separate the logic of your templates from your markup.
 * This is especially useful for complex logic, but also in general to keep your templates clean.
 * In this example, we define the `$gallery` variable which is passed to the template
 * More about controllers: https://getkirby.com/docs/guide/templates/controllers
 */

 return function ($site) {

  $query   = get('q');
  // example: search entire site, in the title and text fields
  // $results = $site->search($query, 'title|text');
  // search notes, within title, text and tags fields
  $results = page('weblog')->index()->listed()->search($query, 'title|text|tags|mymap|excerpt-text');
  $results = $results->paginate(24);

  return [
    'query'   => $query,
    'results' => $results,
    'pagination' => $results->pagination()
  ];

};
