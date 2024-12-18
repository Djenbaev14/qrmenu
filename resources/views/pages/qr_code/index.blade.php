@extends('layouts.main')


@section('content')
  <div class="content-body">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          
    <div class="qr-container">
      <h1>QR-меню</h1>
      {{-- <textarea type="text" id="text-input" placeholder="Enter text or URL"></textarea> --}}
      <div class="qr-grid">
        <label for="bg-color-input">Цвет фона
          <input type="color" id="bg-color-input" value="#ffffff" title="QR Code Background Color">
        </label>
        <label for="fg-color-input">Цвет QR-кода
          <input type="color" id="fg-color-input" value="#000000" title="QR Code Color">
        </label>
        <label for="error-correction-input">Уровень коррекции ошибок 
          <select id="error-correction-input">
            <option value="L">L - Низкий (7%)</option>
            <option value="M">M - Средний (15%)</option>
            <option value="Q">Q - Квартиль (25%)</option>
            <option value="H">H - Высокий (30%)</option>
          </select>
        </label>
        <label for="margin-input">Внешнее поле (пиксели)
          <input type="number" id="margin-input" value="30" min="0" title="QR Code Margin">
        </label>
        <label for="resolution-input">Разрешение 
          <select id="resolution-input">
            <option value="700">700x700</option>
            <option value="800">800x800</option>
            <option value="900">900x900</option>
            <option value="1000" selected>1000x1000</option>
            <option value="1100">1100x1100</option>
            <option value="1200">1200x1200</option>
            <option value="1300">1300x1300</option>
          </select>
        </label>
        <label for="qr-style-input">Стиль QR-кода
          <select id="qr-style-input">
            <option value="dots">Точек</option>
            <option value="rounded">Округлено</option>
            <option value="classy">Классно</option>
            <option value="classy-rounded">Классно округлено</option>
            <option value="square" selected>Квадрат</option>
            <option value="extra-rounded">С дополнительными округлениями</option>
          </select>
        </label>
      </div>
      <div id="qrcode"></div>
      <label for="format-input">Формат 
          <select id="format-input">
            <option value="png" selected>PNG</option>
            <option value="svg">SVG</option>
            <option value="jpeg">JPEG</option>
            <option value="webp">WEBP</option>
          </select>
        </label><br/>
      <button id="download-btn" style="display:block;">Скачать QR-меню</button>
    </div>
        </div>
      </div>
    </div>
    <div class="body"></div>
  </div>
@endsection

@push('css')
    <style>
      body {
      background: #f5f8ff;
      font-family: "Exo 2", sans-serif;
      color: #252432;
      margin: 0px 0 0px;
      min-height: 100vh;
      /* background: url('https://i.ibb.co/X5FvYS4/fuadhasanshihab-qr-BG.jpg') no-repeat bottom; */
      background-size: cover;
      z-index:-1;
    }
    .qr-container {
      text-align: center;
      width: 100%;
      max-width: 500px;
      margin: 0px auto;
      margin-bottom: 30px;
      font-family: "Exo 2", sans-serif;
      background: rgba(231,239,255,0.3);
      backdrop-filter: blur(50px);
      padding: 40px 25px;
      border-radius: 25px;
      border: 1px solid white;
      box-shadow: 0px -0.5px 0px white;
    }
    h1 {
      font-size: 50px;
      line-height: .8;
      margin: 0px 0 40px;
      text-shadow: 3px 3px 0px #fff;
    }
    h1 span {
      color: #5b54ff;
      font-size: 55px;
    }
    .qr-grid {
      margin: 25px 0 30px;
      display: grid;
      gap: 20px;
      grid-template-columns: repeat(2, 1fr);
    }
    textarea {
      font-family: "Exo 2", sans-serif;
      width: calc(100% - 20px);
      padding: 10px;
      background: #f5f8ff;
      color: #252432;
      font-size: 17px;
      border: 1px solid #fff;
      border-radius: 4px;
    }
    ::placeholder {
      color: #252432;
      opacity: .99;
    }
    #format-input{
      background-color: #fff;
    }
    small{display:none;}
    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 4px 8px;
      margin: 4px 0 0;
      border: 1px solid #fff;
      border-radius: 2px;
      box-sizing: border-box;
      font-size: 14px;
      background: #f5f8ff;
      color: #000;
      font-family: "Exo 2", sans-serif;
    }
    input[type="color"] {
      width: 100%;
      height: 30px;
      margin: 4px 0 0px;
      padding: 2px 4px;
      border: 1px solid #fff;
      border-radius: 2px;
      box-sizing: border-box;
      background: #f5f8ff;
    }
    label {
      margin: 0px 0px;
      display: block;
      font-size: 13px;
    }

    button {
      width: 100%;
      padding: 12px;
      margin: 0px 0;
      border: none;
      border-radius: 6px;
      background-color: #5b54ff;
      color: #fff;
      font-size: 17px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: "Exo 2", sans-serif;
    }
    button:hover {
      background-color: #5f40ff;
      font-weight: 500;
    }
    #qrcode {
      margin: 35px 0 30px;
      display: flex;
      justify-content: center;
    }
    canvas {
      max-width: 100%;
      height: auto;
      border-radius: 2px;
    }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qr-code-styling/lib/qr-code-styling.js">  </script>
    <script>
      let qrCode = null;
      let slug = @json($slug);
      let qrMenu = 'https://qrmenu.netlify.app/'+slug;
      
      function generateQRCode() {
        var text = qrMenu;
        var bgColor = document.getElementById('bg-color-input').value;
        var fgColor = document.getElementById('fg-color-input').value;
        var errorCorrectionLevel = document.getElementById('error-correction-input').value;
        var margin = parseInt(document.getElementById('margin-input').value);
        var resolution = parseInt(document.getElementById('resolution-input').value);
        var qrStyle = document.getElementById('qr-style-input').value;

        var qrCodeDiv = document.getElementById('qrcode');

        if (text) {
          // Clear previous QR code if exists
          qrCodeDiv.innerHTML = "";

          // Create QR code
          qrCode = new QRCodeStyling({
            width: resolution,
            height: resolution,
            data: text,
            margin: margin,
            qrOptions: {
              errorCorrectionLevel: errorCorrectionLevel
            },
            dotsOptions: {
              type: qrStyle, // square, rounded, dots, etc.
              color: fgColor
            },
            backgroundOptions: {
              color: bgColor
            }
          });

          qrCode.append(qrCodeDiv);
        } else {
          // Display instruction text
          qrCodeDiv.innerHTML = '<p style="text-align: center; margin: 20px; color: #252432;font-weight:bold;">Please enter text or URL aboveto generate QR code.</p><a href="https://fuadhasanshihab.blogspot.com" style="display:none;">Fuad Hasan Shihab</a>';
          qrCode = null; // Reset qrCode object
        }
      }

      // Initialize QR code generation on input change
      ['input', 'change'].forEach(event => {
        // document.getElementById('text-input').addEventListener(event, generateQRCode);
        document.getElementById('bg-color-input').addEventListener(event, generateQRCode);
        document.getElementById('fg-color-input').addEventListener(event, generateQRCode);
        document.getElementById('error-correction-input').addEventListener(event, generateQRCode);
        document.getElementById('margin-input').addEventListener(event, generateQRCode);
        document.getElementById('resolution-input').addEventListener(event, generateQRCode);
        document.getElementById('qr-style-input').addEventListener(event, generateQRCode);
      });

      document.getElementById('download-btn').addEventListener('click', function() {
        var format = document.getElementById('format-input').value;
        if (qrCode) {
          qrCode.download({ name: 'qr-menu-'+slug, extension: format });
        } else {
          alert('Please generate a QR code first by entering text or a URL.');
        }
      });

      // Generate an initial instruction text
      generateQRCode();

    </script>
@endpush