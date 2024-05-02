<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>:root{
        --bcg-color: #1a1a1a;
        --primary-color: #00b894;
        --border-radius: 12px;
        --secondary-color: #ffffff;
        --border-color: #2ecc71;
        --animation-duration: 0.5s;
    }
    
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--bcg-color);
    }
    
    .box{
        background-color: var(--primary-color);
        padding: 30px;
        width: 400px;
        border-radius: var(--border-radius);
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        animation: fadeIn 1s ease;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .qr-header h1{
        font-size: 26px;
        text-align: center;
        color: var(--secondary-color);
        margin-bottom: 24px;
        text-transform: uppercase;
    }
    
    .qr-header input, select{
        width: 100%;
        padding: 12px;
        margin-bottom: 12px;
        border-radius: var(--border-radius);
        font-size: 18px;
        outline: none;
        border: 2px solid var(--border-color);
        transition: border-color 0.3s ease;
    }
    
    .qr-header input:focus, select:focus{
        border-color: var(--primary-color);
    }
    
    .qr-header label{
        color: var(--secondary-color);
        font-size: 20px;
    }
    
    .qr-header div{
        display: flex;
        justify-content: space-between;
    }
    
    .qr-footer{
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }
    
    .qr-footer a{
        background-color: var(--secondary-color);
        text-decoration: none;
        font-size: 20px;
        padding: 14px 36px;
        margin-inline: 2px;
        color: var(--primary-color);
        font-weight: 600;
        border-radius: var(--border-radius);
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    .qr-footer a:hover{
        background-color: var(--primary-color);
        color: var(--secondary-color);
    }
    
    .qr-body{
        display: grid;
        place-items: center;
        padding:20px;
    }
    
    .qr-body img{
        max-width: 100%;
        max-height: 100%;
        margin-block: 10px;
        padding: 20px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        transition: border-color 0.3s ease;
    }
    
    .qr-body img:hover{
        border-color: var(--primary-color);
    }
    
    @media screen and (max-width:520px){
        .box{
            width: 80%;
        }
        .qr-footer a{
            padding: 12px;
            font-size: 16px;
        }
    }
    </style>
    <title>QR Code Generator | Code Traversal</title>
</head>
<body>
    <div class="box">
        <div class="qr-header">
            <h1>Generate QR Code</h1>
            <input type="text" placeholder="Type your text or URL" id="qr-text">
            <div>
            <label for="sizes">Select Size:</label>
            <select id="sizes">
                <option value="100">100x100</option>
                <option value="200">200x200</option>
                <option value="300">300x300</option>
                <option value="400">400x400</option>
                <option value="500">500x500</option>
                <option value="600">600x600</option>
                <option value="700">700x700</option>
                <option value="800">800x800</option>
                <option value="900">900x900</option>
                <option value="1000">1000x1000</option>
            </select>
        </div>
        </div>
        <div class="qr-body"></div>
        <div class="qr-footer">
            <a href="" id="generateBtn">Generate</a>
            <a href="" id="downloadBtn" download="QR_Code.png">Download</a>
        </div>
    </div>
    <script>const qrText = document.getElementById('qr-text');
        const sizes = document.getElementById('sizes');
        const generateBtn = document.getElementById('generateBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const qrContainer = document.querySelector('.qr-body');
        
        let size = sizes.value;
        generateBtn.addEventListener('click',(e)=>{
            e.preventDefault();
            isEmptyInput();
        });
        
        sizes.addEventListener('change',(e)=>{
            size = e.target.value;
            isEmptyInput();
        });
        
        downloadBtn.addEventListener('click', ()=>{
            let img = document.querySelector('.qr-body img');
        
            if(img !== null){
                let imgAtrr = img.getAttribute('src');
                downloadBtn.setAttribute("href", imgAtrr);
            }
            else{
                downloadBtn.setAttribute("href", `${document.querySelector('canvas').toDataURL()}`);
            }
        });
        
        function isEmptyInput(){
            // if(qrText.value.length > 0){
            //     generateQRCode();
            // }
            // else{
            //     alert("Enter the text or URL to generate your QR code");
            // }
            qrText.value.length > 0 ? generateQRCode() : alert("Enter the text or URL to generate your QR code");;
        }
        function generateQRCode(){
            qrContainer.innerHTML = "";
            new QRCode(qrContainer, {
                text:qrText.value,
                height:size,
                width:size,
                colorLight:"#fff",
                colorDark:"#000",
            });
        }
        </script>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</body>
</html>