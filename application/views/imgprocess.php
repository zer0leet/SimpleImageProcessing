<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/header');?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/header');?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
</head>

<body>
<form action="imgprocess/do_upload" method="post" enctype="multipart/form-data">
  <header>
    <div class="header-title-bar">
      <h1>Upload Your Files</h1>
    </div>
  </header>
  <main>
    <section>
      <label for="fileToUpload" class="upload" id="uploadBox">
      
          <svg
            class="cloud-img"
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="cloud-upload-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 512"
          >
            <path
              fill="#c6c6c6"
              d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zM393.4 288H328v112c0 8.8-7.2 16-16 16h-48c-8.8 0-16-7.2-16-16V288h-65.4c-14.3 0-21.4-17.2-11.3-27.3l105.4-105.4c6.2-6.2 16.4-6.2 22.6 0l105.4 105.4c10.1 10.1 2.9 27.3-11.3 27.3z"
            ></path>
          </svg>
          <h3 class="img-title" id="drag-title">
            Drag and drop to upload
            <span class="clarify">(multiple files allowed)</span>
          </h3>
          <p class="img-subtitle" id="drag-subTitle">
            or <span class="blue">Browse</span> to choose a file
          </p>
          <h3 class="img-title uploading d-none">Uploading...</h3>
          <h3 class="img-title done d-none">
            Done. <span class="blue">Upload More</span>
          </h3>
          <input type="file" name="fileToUpload" id="fileToUpload" />
        </label>
      <div class="success d-none">Files sent</div>
      <button class="btn" id="submitButton">
Upload         </button>
    </section>
  </main>
</body>

</html>
<?php
$this->load->view('templates/footer');
?>
<?php
$this->load->view('templates/footer');
?>