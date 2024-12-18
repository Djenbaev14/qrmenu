<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic QR Code Generator with PDF Download</title>
    <style>
        /* Oddiy uslub */
body {
    font-family: Arial, sans-serif;
    text-align: center;
    margin-top: 50px;
}

.container {
    width: 80%;
    margin: 0 auto;
}

input[type="range"], input[type="color"], input[type="text"] {
    margin: 10px 0;
    padding: 5px;
    width: 100%;
    max-width: 300px;
}

#qrcode {
    margin-top: 30px;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Dynamic QR Code Generator</h1>

        <!-- Banner uchun sozlamalar -->
        <label for="size">QR Code Size: </label>
        <input type="range" id="size" name="size" min="100" max="500" value="300">
        
        <label for="bgColor">Background Color: </label>
        <input type="color" id="bgColor" value="#ffffff">
        
        <label for="qrColor">QR Code Color: </label>
        <input type="color" id="qrColor" value="#000000">
        
        <label for="text">Text: </label>
        <input type="text" id="text" value="https://example.com">
        
        <label for="logo">Logo URL: </label>
        <input type="text" id="logo" placeholder="https://example.com/logo.png">
        
        <!-- QR kodini chiqarish uchun joy -->
        <div id="qrcode"></div>

        <!-- PDF yuklab olish tugmasi -->
        <button id="downloadBtn">Download PDF</button>
    </div>
    
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const sizeInput = document.getElementById('size');
    const bgColorInput = document.getElementById('bgColor');
    const qrColorInput = document.getElementById('qrColor');
    const textInput = document.getElementById('text');
    const logoInput = document.getElementById('logo');
    const qrcodeContainer = document.getElementById('qrcode');
    const downloadBtn = document.getElementById('downloadBtn');
    
    let qrcode;

    // QR kodini yaratish va yangilash
    function generateQRCode() {
        const size = sizeInput.value;
        const bgColor = bgColorInput.value;
        const qrColor = qrColorInput.value;
        const text = textInput.value;
        const logo = logoInput.value;
        
        // Agar oldin yaratilgan QR kod bo'lsa, uni o'chirib yangisini yaratish
        if (qrcode) {
            qrcode.clear();
        }

        // QR kodini yaratish
        qrcode = new QRCode(qrcodeContainer, {
            text: text,
            width: size,
            height: size,
            colorDark: qrColor,
            colorLight: bgColor,
            correctLevel: QRCode.CorrectLevel.L,
        });

        // Agar logo URL kiritilgan bo'lsa, uni qo'shish
        if (logo) {
            // QR kodga logotip qo'shish uchun alohida kodni yozish kerak
        }
    }

    // Har bir input o'zgarishida QR kodni yangilash
    sizeInput.addEventListener('input', generateQRCode);
    bgColorInput.addEventListener('input', generateQRCode);
    qrColorInput.addEventListener('input', generateQRCode);
    textInput.addEventListener('input', generateQRCode);
    logoInput.addEventListener('input', generateQRCode);

    // Dastlabki QR kodni yaratish
    generateQRCode();

    // PDF yuklab olish funksiyasi
    downloadBtn.addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // QR kodni canvasdan olish
        const qrCanvas = qrcodeContainer.querySelector('canvas');
        if (qrCanvas) {
            const qrDataURL = qrCanvas.toDataURL('image/png');
            
            // Banner va QR kodni PDFga joylash
            doc.addImage(qrDataURL, 'PNG', 10, 10, sizeInput.value, sizeInput.value);
            doc.text(textInput.value, 10, 20 + parseInt(sizeInput.value));
            
            // PDFni yuklab olish
            doc.save('qr-banner.pdf');
        }
    });
});

    </script>
</body>
</html>
