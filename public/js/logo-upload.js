
document.getElementById("logo-upload").addEventListener("change", function (event) {
  const file = event.target.files[0];
  if (file && file.size <= 10 * 1024 * 1024) { // 10 MB
      const reader = new FileReader();
      reader.onload = function (e) {
          const logoPreview = document.getElementById("logo-preview");
          logoPreview.src = e.target.result;
          logoPreview.style.display = "block";
          
          // Placeholderni yashirish
          document.getElementById("placeholder").style.display = "none";
          document.getElementById("change-icon").style.display = "inline-block";
          document.getElementById("upload-area").style.display = "none";
      };
      reader.readAsDataURL(file);
  } else {
      alert("Fayl hajmi 10 MB'dan oshmasligi kerak.");
  }
});