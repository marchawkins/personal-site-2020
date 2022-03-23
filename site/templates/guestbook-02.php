<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * This example templates only echos the field values from the content file and doesn't need any special logic from a controller.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php snippet('header') ?>

<main class="flex-grow bg-black text-gray-600 body-font"  id="guestbook">
 <div class="container  mx-auto" id="guestCapture">
  <h1 class="text-center text-2xl font-title text-white pt-2 sm:pt-0 sm:text-3xl">Sign my guestbook</h1>
  <div class="flex items-center">
    <div class="px-10 mx-auto align-middle">
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">

        <div class="mb-10 px-4">
          <div class="rounded-lg my-4 aspect-w-4 aspect-h-3 border-2 border-terminal overflow-hidden">
            <video class="videostream" autoplay></video><!-- used to hold the video stream from webcam -->
          </div><!-- .rounded-lg -->
          <p class="leading-relaxed text-terminal font-mono uppercase text-center">Click "initialize" and allow access to your webcam.</p>
          <button class="flex mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded capture-button">Initialize webcam</button>
        </div><!-- .sm:w -->
        <div class="mb-10 px-4">
          <div class="rounded-lg my-4 aspect-w-4 aspect-h-3 border-2 border-terminal overflow-hidden">
            <img id="screenshot-img" /><!-- used to hold the static capture from video stream (older browsers) -->
            <canvas style="display:none;"></canvas><!-- used to hold the static capture from video stream (newer browsers) -->
          </div><!-- .rounded-lg -->
          <p class="leading-relaxed text-terminal font-mono uppercase text-center">Click "take photo" to capture a still from your webcam.</p>
          <div class="flex justify-center items-center">
            <button id="screenshot-button" class="cursor-pointer mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded capture-button opacity-20">Take a photo</button>
            <button id="save-button" class="cursor-pointer mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded opacity-20">Save photo</button>
          </div><!-- .mx-auto -->
        </div><!-- .sm:w -->

      </div><!-- .grid -->
    </div><!-- .px-10.mx-auto -->
  </div><!-- .flex.h-screen -->
 </div><!-- .container -->

 <div id="debug">
  <p>doc root: <?php echo($_SERVER['DOCUMENT_ROOT']); ?></p>
  <?php
  if($_POST) {
  $data = $_POST['photo'];
  list($type, $data) = explode(';', $data);
  list(, $data)      = explode(',', $data);
  $data = base64_decode($data);

  $uploadDir = ($_SERVER['DOCUMENT_ROOT'] . "/_uploads/guestbook");

  file_put_contents($uploadDir.time().'.png', $data);
  //die;
  }
  ?>
</div>
</main>

<script>
  // variable setup
  const constraints = {video: true};
  const captureVideoButton = document.querySelector("#guestCapture .capture-button");
  const screenshotButton = document.querySelector("#screenshot-button");
  const saveButton = document.querySelector("#save-button");
  const img = document.querySelector("#guestCapture img");
  const video = document.querySelector("#guestCapture video");
  const canvas = document.createElement("canvas");
  
  screenshotButton.setAttribute("disabled", "disabled"); // turn off screenshot button
  saveButton.setAttribute("disabled", "disabled"); // turn off save button

  // initialize video button
  captureVideoButton.onclick = function () {
    navigator.mediaDevices
      .getUserMedia(constraints)
      .then(handleSuccess)
      .catch(handleError);
    captureVideoButton.disabled = true;
    captureVideoButton.innerHTML = "Camera Initialized";
    captureVideoButton.classList.add('opacity-20');
    screenshotButton.classList.remove('opacity-20');
    saveButton.classList.remove('opacity-20');
  };
  
  // take photo button
  screenshotButton.onclick = video.onclick = function () {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext("2d").drawImage(video, 0, 0);
    img.src = canvas.toDataURL("image/png"); // Other browsers will fall back to image/png
    screenshotButton.innerHTML = "Retake Photo";
    
  };

  // output the webcam stream to the video object
  function handleSuccess(stream) {
    screenshotButton.disabled = false;
    video.srcObject = stream;
  };
  
  // show alert if there was a problem
  function handleError(stream) {
    alert('Whoops. Something is busted. My bad. Tweet me at @marchawkins');
  };

 // function to upload image to server via ajax request
 function uploadImage() {
    var opts = {
      method: 'GET',      
      headers: {}
    }
    
  };




</script>

<?php snippet('footer') ?>
