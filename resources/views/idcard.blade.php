<!DOCTYPE html>
<html>
<head>
    <title>Member ID Card Preview</title>
    <style>
        .container {
            border: 1px solid #000;
        }
        .id-card {
            border: 1px solid #000;
            padding: 20px;
            width: 400px;
            text-align: center;
            margin: 0 auto;
        }
        .id-card h1 {
            font-size: 1.5em;
        }
        .qr-code {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="qr-code">
            {!! htmlspecialchars_decode($qrcode) !!}
        </div>
        <div id="id-card" class="id-card">
            <h1>{{ $member->name }}</h1>
            <p>ID: {{ $member->code }}</p>
        </div>
    </div>
</body>
</html>
