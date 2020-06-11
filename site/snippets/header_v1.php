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

      <!-- 
      <div class="relative text-lg bg-transparent text-white">
        <div class="flex items-center border-b border-b-2 border-white py-2">
          <input class="bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none text-white" type="text" placeholder="Search">
          <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
              <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                  <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
              </svg>
          </button>
        </div>
      </div>
      -->

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
   

