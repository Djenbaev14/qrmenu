<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rasmlar yuklash</title>
    <style>
        .container {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .image-box {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f5f5f5;
        }
        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-box .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .add-image-box {
            width: 100px;
            height: 100px;
            border: 2px dashed #9a49f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #9a49f5;
            font-size: 24px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<h2>YUKLANGAN RASMLAR</h2>
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container" id="imageContainer">
        <!-- Yuklangan rasmlar joylashadi -->
        <div class="add-image-box" onclick="document.getElementById('fileInput').click()">+</div>
    </div>
    <input type="file" id="fileInput" name="photos[]" multiple  style="display: none;">
    <input type="file" id="fileImage" name="images[]" multiple  >
    {{-- <button onclick="uploadFiles()">Yuklash</button> --}}
    <button>add</button>
</form>

{{-- <button onclick="uploadImages()">Yuklash</button> --}}

<script>
    const imageContainer = document.getElementById('imageContainer');
    const fileInput = document.getElementById('fileInput');
    const fileImage = document.getElementById('fileImage');
    let images = [];
    const a={};
    
    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = (e) => {
                const imageBox = document.createElement('div');
                imageBox.className = 'image-box';

                const img = document.createElement('img');
                img.src = e.target.result;
                imageBox.appendChild(img);

                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'delete-btn';
                deleteBtn.textContent = '×';
                deleteBtn.onclick = () => {
                    imageContainer.removeChild(imageBox);
                    images = images.filter((item) => item !== file);
                };
                imageBox.appendChild(deleteBtn);

                imageContainer.insertBefore(imageBox, imageContainer.lastElementChild);
                images.push(file);
            };
            reader.readAsDataURL(file);
        }
        fileImage.files=files;
    });
    
    function uploadFiles() {
        const formData = new FormData();
        images.forEach((image, index) => {
            formData.append('images[]', image, `image-${index}.jpg`);
        });
        console.log(formData);
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/products', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // CSRF tokenni headerga qo'shamiz
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          
            alert('Rasmlar muvaffaqiyatli yuklandi');
            
            // Tozalash
            images = [];
            imageContainer.querySelectorAll('.image-box').forEach(box => box.remove());
        })
        .catch(error => {
            console.error('Xatolik:', error);
        });
    }
</script>
</body>
</html>
