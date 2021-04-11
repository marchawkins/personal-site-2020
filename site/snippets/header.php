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

  <?php if(url::host() !== 'localhost'): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-5347355-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-5347355-1');
  </script>
  <?php endif; ?>

</head>
<body class="flex flex-col min-h-screen pg-<?= $page->slug() ?>">
<?php if($page->isHomePage()): ?>

  <header class="container mx-auto text-center w-full sm:w-1/2 lg:w-1/3 text-white">
    <div class="text-center mt-9 pb-4">
        <a href="<?php echo $site->url(); ?>" title="<?php echo $site->title() ?>" class="">
          <img src="/assets/img/marc-hawkins-logo.png" width="290" height="150" alt="<?php echo $site->title() ?>" class="inline-block"/>
        </a>
    </div>
    <div class="text-center">
        <p class="inline-block text-4xl font-hand text-white pt-2">Marc's Awesome Website</p>
    </div>
    <div class="max-w-sm mx-auto py-6 px-6 sm:px-12">
      <div class="flex justify-around social-nav">
       <div class="twitter"><a href="https://twitter.com/marchawkins" title="i post updates to twitter">twitter</a></div>
       <div class="youtube"><a href="https://www.youtube.com/channel/UCcbOtzDdq79jlmJuwEM_qfA" title="i post videos on youtube">youtube</a></div>
       <div class="email"><a href="mailto:marc@marchawkins.com" title="shoot me an email">email</a></div>
       <div class="instagram"><a href="https://www.instagram.com/marchawkins/" title="i post photos on instagram">instagram</a></div>
       <div class="twitch"><a href="https://www.twitch.tv/marchawkinslive" title="i stream games on twitch">twitch</a></div>
       <div class="coffee"><a href="https://www.buymeacoffee.com/marchawkins" title="like it? donate a coffee">buy me a coffee</a></div>
      </div>
    </div>
  </header>

<?php else: ?>
    <header class="">
      <div class="flex sm:items-center justify-between sm:justify-center p-4 sm:pb-0 bg-black">
          <div class="sm:flex sm:items-center">
            <a href="<?php echo $site->url(); ?>" title="<?php echo $site->title() ?>">
              <img src="/assets/img/marc-hawkins-logo-sm.png" width="200" height="105" alt="<?php echo $site->title() ?>"/>
            </a>
          </div>

          <div class="sm:hidden">aa
            <button type="button" class="block text-gray-400 hover:tesasxt-white focus:text-white focus:outline-none" onclick="navToggle()">
              <svg class="h-6 w-8 fill-current icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path id="nav_menu_icon" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
              </svg>
            </button>
          </div>
      </div>

      <div class="hidden sm:flex sm:pb-4 sm:pt-4 items-center justify-center bg-black text-lg sm:text-xl" id="nav_menu">
        <?php foreach ($site->children()->listed() as $item): ?>
          <a class="block px-2 font-mono text-terminal uppercase hover:text-opacity-50 " href="<?php echo $item->url() ?>" title="<?php echo $item->title() ?>"><?php echo $item->title() ?></a>
        <?php endforeach ?>
        <a class="block px-2 font-mono text-terminal uppercase hover:text-opacity-50 " href="/search" title="Search Notes">Search</a>

        <?php if($user && $user->isAdmin()): ?>
          <a class="block px-2 font-mono text-terminal uppercase hover:text-opacity-50 " href="/panel" title="Admin Panel">Admin</a>
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

<?php endif ?>
   

