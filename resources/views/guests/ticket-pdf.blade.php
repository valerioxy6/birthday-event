<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biglietto PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #111827;
        }
        .ticket {
            border: 2px solid #111827;
            border-radius: 18px;
            margin: 18px;
            overflow: hidden;
        }
        .header {
            background: #111827;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 6px 0 0;
            font-size: 12px;
        }
        .content {
            padding: 24px;
            text-align: center;
        }
        .name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .qr {
            margin: 18px auto;
            width: 220px;
            background: white;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 14px;
        }
        .meta {
            font-size: 12px;
            color: #4b5563;
            margin-top: 14px;
            word-break: break-all;
        }
        .footer {
            padding: 16px 24px 24px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
       
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>Birthday Night</h1>
            <p>Biglietto personale di accesso</p>
        </div>

        <div class="content">
            <div class="name">{{ $guest->full_name }}</div>
            <div>Presenta questo QR code all’ingresso</div>

            <div class="qr">
    <img src="{{ $qrImage }}" alt="QR Code" style="width: 200px; height: 200px;">
</div>

            <div class="meta">
                Token: {{ $guest->token }}
            </div>
        </div>

        <div class="footer">
            Valido per un solo ingresso
        </div>
    </div>
</body>
</html>