<?php
/**
 * Snippets are a great way to store code snippets for reuse or to keep your templates clean.
 * This header snippet is reused in all templates. 
 * It fetches information from the `site.txt` content file and contains the site navigation.
 * More about snippets: https://getkirby.com/docs/guide/templates/snippets
 */
?>

<?php
  // setup global user object, if it exists
  global $user;
  if($kirby->user()):
    $user = $kirby->user();
  else:
    $user = false;
  endif;
?>
<!doctype html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php echo $site->title() ?> | <?php echo $page->title() ?></title>

  <!-- Stylesheets can be included using the `css()` helper. Kirby also provides the `js()` helper to include script file. 
        More Kirby helpers: https://getkirby.com/docs/reference/templates/helpers -->
  <?= css(['assets/css/public.css', '@auto']) ?>

</head>
<body class="">
  <header class="bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
    <div class="flex items-center justify-between px-4 py-3 sm:p-0">
        <div>
          <a href="<?php echo $site->url(); ?>" title="<?php echo $site->title() ?>"><img src="/assets/img/marc-hawkins-logo-light.svg" alt="<?php echo $site->title() ?>" class="h-8"/></a>
        </div>

        <div class="sm:hidden">
          <button type="button" class="block text-gray-400 hover:text-white focus:text-white focus:outline-none" onclick="navToggle()">
            <svg class="h-6 w-8 fill-current mr-4 icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path id="nav_menu_icon" class="secondary" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
            </svg>
          </button>
        </div>
    </div>

    <div class="hidden px-2 pt-2 pb-4 sm:flex" id="nav_menu">
      <?php foreach ($site->children()->listed() as $item): ?>
        <a class="block mt-1 first:mt-0 px-2 first:py-1 text-white font-semibold rounded hover:bg-gray-800 sm:py-0 sm:ml-2" href="<?php echo $item->url() ?>" title="<?php echo $item->title() ?>"><?php echo $item->title() ?></a>
      <?php endforeach ?>
      
      <div>
        <input type="text" name="query" class="block border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 " plaeholder="Search" aria-label="Enter Search Term"/>
        <button type="button" class="block px-2 text-gray-400 hover:bg-gray-800 focus:text-white focus:outline-none">
          <svg class="h-6 w-8 fill-current mr-4 icon-search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <circle cx="10" cy="10" r="7" class="primary"/>
            <path class="secondary" d="M16.32 14.9l1.1 1.1c.4-.02.83.13 1.14.44l3 3a1.5 1.5 0 0 1-2.12 2.12l-3-3a1.5 1.5 0 0 1-.44-1.14l-1.1-1.1a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
          </svg>
        </button>
        
      </div>

      <?php if($user && $user->isAdmin()): ?>
        <a class="block mt-1 px-2 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0 sm:ml-2" href="/panel" title="Admin Panel">
        <?php if($avatar = $user->avatar()): ?>
          <img src="<?= $avatar->url() ?>" alt="user avatar" class="h-6"/>
        <?php else: ?>
          Admin
        <?php endif ?>
        </a>
      <?php endif ?>
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

  <div class="page">
   

