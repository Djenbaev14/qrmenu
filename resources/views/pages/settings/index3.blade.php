<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rasmni qirqib olish</title>
  <style>
    .container {
      text-align: center;
      margin-top: 20px;
    }
    .image-wrapper {
      display: inline-block;
      position: relative;
    }
    #uploadedImage {
      max-width: 100%;
      max-height: 400px;
    }
    #cropArea {
      position: absolute;
      border: 2px dashed red;
      width: 550px;
      height: 310px;
      top: 0;
      left: 0;
    }
    .output {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Rasmni Qirqib Olish</h1>
    <input type="file" id="imageInput" accept="image/*"><br><br>
    <div class="image-wrapper">
      <img id="uploadedImage" alt="Rasm yuklang" />
      <div id="cropArea"></div>
    </div>
    <canvas id="outputCanvas" class="output"></canvas>
  </div>

  <script>
    const imageInput = document.getElementById('imageInput');
    const uploadedImage = document.getElementById('uploadedImage');
    const cropArea = document.getElementById('cropArea');
    const outputCanvas = document.getElementById('outputCanvas');
    const ctx = outputCanvas.getContext('2d');

    imageInput.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          uploadedImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    uploadedImage.onload = () => {
      const cropX = parseInt(cropArea.style.left, 10) || 0;
      const cropY = parseInt(cropArea.style.top, 10) || 0;
      const cropWidth = 550;
      const cropHeight = 310;

      // Canvas o'lchamini o'rnatish
      outputCanvas.width = cropWidth;
      outputCanvas.height = cropHeight;

      // Rasmni qirqish
      ctx.drawImage(
        uploadedImage,
        cropX, cropY, cropWidth, cropHeight, // Asl rasm qirqish koordinatalari
        0, 0, cropWidth, cropHeight         // Canvasda joylashuvi
      );
    };

    cropArea.addEventListener('mousemove', (event) => {
      const rect = uploadedImage.getBoundingClientRect();
      cropArea.style.left = `${Math.min(Math.max(event.clientX - rect.left - 275, 0), rect.width - 550)}px`;
      cropArea.style.top = `${Math.min(Math.max(event.clientY - rect.top - 155, 0), rect.height - 310)}px`;
    });
  </script>
</body>
</html>
