<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahsulot Qo'shish</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: none;
        }

        .parameter-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .parameter-group input,
        .parameter-group select {
            flex: 1;
        }

        .add-parameter-btn {
            margin-top: 10px;
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-parameter-btn:hover {
            background-color: #0056b3;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-actions .cancel-btn {
            background: #ccc;
            color: #333;
        }

        .form-actions .submit-btn {
            background: #28a745;
            color: #fff;
        }

        .form-actions .submit-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Mahsulot Qo'shish</h2>
        <form id="productForm">
            <div class="form-group">
                <label for="productName">Mahsulot nomi (Русский)</label>
                <input type="text" id="productName" name="productName" placeholder="Mahsulot nomini kiriting" required>
            </div>
            <div class="form-group">
                <label for="category">Kategoriya</label>
                <select id="category" name="category" required>
                    <option value="">Kategoriyani tanlang</option>
                    <option value="electronics">Elektronika</option>
                    <option value="clothing">Kiyim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Tafsilot (Русский)</label>
                <textarea id="description" name="description" rows="3" placeholder="Mahsulotingiz tavsifini yozing"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Narx</label>
                <input type="number" id="price" name="price" placeholder="Narxni kiriting" required>
            </div>
            <div class="form-group">
                <label for="unit">O'lchov Birligi</label>
                <select id="unit" name="unit" required>
                    <option value="">O'lchov birligini tanlang</option>
                    <option value="kg">kg</option>
                    <option value="pcs">dona</option>
                </select>
            </div>
            <div id="parameters">
                <h3>Mahsulot xususiyatlari</h3>
            </div>
            <button type="button" id="addParameter" class="add-parameter-btn">+ Parametr qo'shing</button>
            <div class="form-actions">
                <button type="button" class="cancel-btn">Bekor qilish</button>
                <button type="submit" class="submit-btn">Qo'shish</button>
            </div>
        </form>
    </div>

    <script>
        const parametersDiv = document.getElementById('parameters');
        const addParameterBtn = document.getElementById('addParameter');

        addParameterBtn.addEventListener('click', () => {
            const parameterGroup = document.createElement('div');
            parameterGroup.className = 'parameter-group';

            parameterGroup.innerHTML = `
                <input type="text" name="parameterName[]" placeholder="Masalan: Portsiya/hajm" required>
                <select name="parameterUnit[]">
                    <option value="">O'lchov birligi</option>
                    <option value="kg">kg</option>
                    <option value="pcs">dona</option>
                </select>
                <input type="number" name="parameterPrice[]" placeholder="Narxni kiriting" required>
            `;

            parametersDiv.appendChild(parameterGroup);
        });

        document.getElementById('productForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Form submitted!');
        });
    </script>
</body>
</html>
