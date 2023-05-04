<script>
function previewImage() {
  var url = document.getElementById("url").value;
  var imagePreview = document.getElementById("image-preview");
  if (url === "") {
    imagePreview.style.display = "none";
    imagePreview.src = "";
  } else {
    imagePreview.style.display = "block";
    imagePreview.src = url;
  }
}

var modal = document.getElementById("modal");
var modalImg = document.getElementById("image-modal");
var captionText = document.getElementById("caption");
var span = document.getElementsByClassName("close")[0];

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