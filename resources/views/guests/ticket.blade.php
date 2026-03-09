<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo biglietto</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255,77,141,.24), transparent 30%),
                radial-gradient(circle at bottom right, rgba(142,107,255,.22), transparent 35%),
                linear-gradient(135deg, #080b15, #0f1630 50%, #060810);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .ticket {
            width: 100%;
            max-width: 620px;
            border-radius: 28px;
            overflow: hidden;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            box-shadow: 0 24px 70px rgba(0,0,0,.38);
            backdrop-filter: blur(10px);
        }
        .top {
            padding: 28px 28px 16px;
            background: linear-gradient(90deg, rgba(255,77,141,.18), rgba(142,107,255,.18));
        }
        .badge {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: rgba(255,255,255,.12);
            margin-bottom: 14px;
        }
        h1 {
            margin: 0;
            font-size: 34px;
        }
        .subtitle {
            margin-top: 8px;
            color: rgba(255,255,255,.78);
        }
        .body {
            padding: 28px;
            text-align: center;
        }
        .guest {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .hint {
            color: rgba(255,255,255,.74);
            margin-bottom: 24px;
        }
        .qr {
            display: inline-flex;
            background: white;
            padding: 18px;
            border-radius: 22px;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 24px;
            flex-wrap: wrap;
        }
        .btn {
            text-decoration: none;
            border-radius: 14px;
            padding: 14px 18px;
            font-weight: bold;
        }
        .btn-primary {
            background: linear-gradient(90deg, #ff4d8d, #8e6bff);
            color: white;
        }
        .btn-secondary {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            color: white;
        }
        .footer {
            padding: 0 28px 28px;
            text-align: center;
            color: rgba(255,255,255,.58);
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="top">
            <div class="badge">Evento • Accesso personale</div>
            <h1>Birthday Night</h1>
            <div class="subtitle">Mostra questo QR all’ingresso del locale</div>
        </div>

        <div class="body">
            <div class="guest">{{ $guest->full_name }}</div>
            <div class="hint">Il tuo invito digitale è stato generato con successo</div>

            <div class="qr">
    <img src="{{ $qrImage }}" alt="QR Code Biglietto" style="width: 260px; height: 260px; display:block;">
</div>

            <div class="actions">
                <a class="btn btn-primary" href="{{ route('guests.ticket.pdf', $guest->token) }}">
                    Scarica PDF
                </a>

                <a class="btn btn-secondary" href="{{ route('guests.create') }}">
                    Registra un altro invitato
                </a>
            </div>
        </div>

        <div class="footer">
            QR valido per un solo ingresso • Controllo accessi all’entrata
        </div>
    </div>
</body>
</html>