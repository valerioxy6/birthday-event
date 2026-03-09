<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione evento</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top, rgba(255,80,120,.25), transparent 30%),
                radial-gradient(circle at bottom, rgba(70,120,255,.22), transparent 35%),
                linear-gradient(135deg, #0b1020, #151b35 45%, #090d18);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 520px;
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,.35);
        }
        .eyebrow {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: .8;
            margin-bottom: 10px;
        }
        h1 {
            margin: 0 0 12px;
            font-size: 36px;
            line-height: 1.1;
        }
        p {
            color: rgba(255,255,255,.82);
            margin-bottom: 24px;
        }
        label {
            display: block;
            margin: 14px 0 8px;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.06);
            color: white;
            outline: none;
        }
        input::placeholder { color: rgba(255,255,255,.45); }
        button {
            width: 100%;
            margin-top: 22px;
            border: 0;
            border-radius: 14px;
            padding: 15px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            background: linear-gradient(90deg, #ff4d8d, #8e6bff);
            color: white;
        }
        .error {
            color: #ff9db9;
            margin-top: 6px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="eyebrow">Guest list</div>
        <h1>Registrati all’evento</h1>
        <p>Inserisci nome e cognome per ottenere il tuo biglietto digitale con QR code.</p>

        <form action="{{ route('guests.store') }}" method="POST">
            @csrf

            <label for="first_name">Nome</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required placeholder="Es. Marco">
            @error('first_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="last_name">Cognome</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required placeholder="Es. Rossi">
            @error('last_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Genera il mio biglietto</button>
        </form>
    </div>
</body>
</html>