<?php /* global navigation include */ ?>

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

  <?php echo css(['assets/css/public.css', '@auto']) ?>

  <link rel="icon" type="image/png" href="https://www.marchawkins.com/assets/img/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="https://www.marchawkins.com/assets/img/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="https://www.marchawkins.com/assets/img/favicons/favicon-96x96.png" sizes="96x96">
  <link rel="apple-touch-icon" href="https://www.marchawkins.com/assets/img/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="180x180" href="https://www.marchawkins.com/assets/img/favicons/apple-touch-icon-180x180.png">
  <link rel="apple-touch-icon" sizes="152x152" href="https://www.marchawkins.com/assets/img/favicons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="167x167" href="https://www.marchawkins.com/assets/img/favicons/apple-touch-icon-167x167.png">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-5347355-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-5347355-1');
</script>


</head>
<body class="flex flex-col min-h-screen">

    <header class="bg-black sm:bg-white">
      <div class="flex sm:items-center justify-between sm:justify-center p-4 sm:bg-black">
          <div class="sm:flex sm:items-center">
            <a href="<?php echo $site->url(); ?>" title="<?php echo $site->title() ?>">
              <img src="/assets/img/marc-hawkins-logo-light.svg" alt="<?php echo $site->title() ?>" class="h-8 sm:h-16"/>
            </a>
          </div>

          <div class="sm:hidden">
            <button type="button" class="block text-gray-400 hover:text-white focus:text-white focus:outline-none" onclick="navToggle()">
              <svg class="h-6 w-8 fill-current icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path id="nav_menu_icon" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
              </svg>
            </button>
          </div>
      </div>

      <div class="hidden px-2 pt-2 pb-4 sm:flex sm:items-center sm:justify-center sm:mx-4" id="nav_menu">
        <?php foreach ($site->children()->listed() as $item): ?>
          <a class="block mt-1 px-2 py-2 text-white font-title uppercase rounded hover:bg-gray-800 sm:py-0 sm:text-gray-600 sm:text-xl sm:hover:bg-transparent sm:hover:text-gray-900" href="<?php echo $item->url() ?>" title="<?php echo $item->title() ?>"><?php echo $item->title() ?></a>
        <?php endforeach ?>
        <a class="block mt-1 px-2 py-2 text-white font-title uppercase rounded hover:bg-gray-800 sm:py-0 sm:text-gray-600 sm:text-xl sm:hover:bg-transparent sm:hover:text-gray-900" href="/search" title="Search Notes">Search</a>

        <?php if($user && $user->isAdmin()): ?>
          <a class="block mt-1 px-2 py-2 text-white font-title uppercase rounded hover:bg-gray-800 sm:py-0 sm:text-gray-600 sm:text-xl sm:hover:bg-transparent sm:hover:text-gray-900" href="/panel" title="Admin Panel">Admin</a>
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

   

