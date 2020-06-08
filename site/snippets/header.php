<?php
/**
 * Snippets are a great way to store code snippets for reuse or to keep your templates clean.
 * This header snippet is reused in all templates. 
 * It fetches information from the `site.txt` content file and contains the site navigation.
 * More about snippets: https://getkirby.com/docs/guide/templates/snippets
 */
?>

<!doctype html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <!-- The title tag we show the title of our site and the title of the current page -->
  <title><?= $site->title() ?> | <?= $page->title() ?></title>

  <!-- Stylesheets can be included using the `css()` helper. Kirby also provides the `js()` helper to include script file. 
        More Kirby helpers: https://getkirby.com/docs/reference/templates/helpers -->
  <?= css(['assets/css/public.css', '@auto']) ?>

</head>
<body class="">
  <header class="bg-gray-900">
    <div class="flex items-center justify-between px-4 py-3">
        <div>
          <img src="/assets/img/marc-hawkins-logo-light.svg" alt="the website of marc hawkins" class="h-8"/>
        </div>

        <div>
          <button type="button" class="block text-gray-400 hover:text-white focus:text-white focus:outline-none" onclick="navToggle()">
            <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 mr-4 icon-menu">
              <path id="nav_menu_icon" class="secondary" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
            </svg>
          </button>
        </div>
    </div>

    <div class="hidden px-2 pt-2 pb-4" id="nav_menu">
      <a class="block px-2 py-1 text-white font-semibold rounded hover:bg-gray-800" href="#notes">Notes</a>
      <a class="mt-1 block px-2 text-white font-semibold rounded hover:bg-gray-800" href="#about">About</a>
      <a class="mt-1 block px-2 text-white font-semibold rounded hover:bg-gray-800" href="#vinyl">Vinyl</a>
    </div>
  </header>

  <script>
    var isOpen = false;
    var navMenu = document.getElementById('nav_menu');
    var navMenuIcon = document.getElementById('nav_menu_icon');
    var xIcon = "M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z";
    var hamburgerIcon = "M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z";

    function navToggle() {
      if(!isOpen) {
        navMenu.classList.remove('hidden');
        navMenu.classList.add('block');
        navMenuIcon.setAttribute('d',xIcon);
        isOpen = true;
      } else {
        navMenu.classList.remove('block');
        navMenu.classList.add('hidden');
        navMenuIcon.setAttribute('d',hamburgerIcon);
        isOpen = false;
      }
    }
  </script>

<?php /*
      <a class="logo" href="<?= $site->url() ?>"><?= $site->title() ?></a>
      <nav id="menu" class="menu">
        <?php 
        // In the menu, we only fetch listed pages, i.e. the pages that have a prepended number in their foldername
        // We do not want to display links to unlisted `error`, `home`, or `sandbox` pages
        // More about page status: https://getkirby.com/docs/reference/panel/blueprints/page#statuses
        foreach ($site->children()->listed() as $item): ?>
        <?= $item->title()->link() ?>
        <?php endforeach ?>
      </nav>
   

  <div class="p-8">
    
  </div>
*/ ?>

  <div class="page">
   

