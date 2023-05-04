<!DOCTYPE html>
<html>
  <head>
    <title>PHP Image Downloader</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <h1>PHP URL Image Downloader</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Get the URL and filename from the form
      $url = $_POST['url'];
      $filename = $_POST['filename'];

      // Check if the URL is empty or invalid
      if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
        echo '<script>alert("Please enter a valid image URL.")</script>';
      } else {
        // Open the URL and get the image data
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $image_data = curl_exec($ch);
        curl_close($ch);

        // Save the image data to a file inside the "downloads" folder
	$fp = fopen('download/' . $filename, 'w');
	fwrite($fp, $image_data);
	fclose($fp);

        // Show a success message in a modal
echo '<script>alert("Successfully Downloaded")</script>';

      }
    }
    ?>

    <div class="container">
      <form method="post">
        <div class="form-group">
          <label for="url">Image URL:</label>
          <input type="text" name="url" id="url" oninput="previewImage()" required>
        </div>
        <div class="form-group">
          <label for="filename">Filename(.JPG):</label>
          <input type="text" name="filename" id="filename" required>
        </div>
        <button type="submit">Download Image</button>
      </form>

<div class="image-preview-container">
  <img class="image-preview" id="image-preview">
  <button class="open-modal-btn" onclick="openModal()" id="full-size-btn" style="display:none;">View Full Size</button>
</div>

      <div id="success-modal" class="modal">
        <div class="modal-content">
          <span class="close" id="success-modal-close">&times;</span>
          <h2>Image Downloaded Successfully!</h2>
          <p>The image has been saved to the following filename:</p>
          <p id="filename-display"></p>
        </div>
      </div>
    </div>

    <div id="modal" class="modal">
      <span class="close" id="close-modal-btn">&times;</span>
      <img class="modal-content" id="image-modal">
    </div>

  <script>
function previewImage() {
  var url = document.getElementById("url").value;
  var imagePreview = document.getElementById("image-preview");
  var fullSizeBtn = document.getElementById("full-size-btn");
  if (url === "") {
    imagePreview.style.display = "none";
    imagePreview.src = "";
    fullSizeBtn.style.display = "none";
  } else {
    imagePreview.style.display = "block";
    imagePreview.src = url;
    fullSizeBtn.style.display = "block";
  }
}

var modal = document.getElementById("modal");
var modalImg = document.getElementById("image-modal");
var captionText = document.getElementById("caption");
var span = document.getElementsByClassName("close")[0];
var closeBtn = document.getElementById("close-modal-btn");
          closeBtn.onclick = function() {
            modal.style.display = "none";
          };
modal.style.display = "none";

function openModal() {
  modal.style.display = "block";
  modalImg.src = document.getElementById("image-preview").src;
  captionText.innerHTML = document.getElementById("filename").value;
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
f</body>
</html>
