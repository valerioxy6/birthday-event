<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
        ]);

        $firstName = trim($validated['first_name']);
        $lastName = trim($validated['last_name']);

        $existingGuest = Guest::where('first_name', $firstName)
            ->where('last_name', $lastName)
            ->first();

        if ($existingGuest) {
            return redirect()->route('guests.ticket', $existingGuest->token);
        }

        $guest = Guest::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'slug_name' => Str::slug($firstName . ' ' . $lastName),
            'token' => (string) Str::uuid(),
        ]);

        return redirect()->route('guests.ticket', $guest->token);
    }

    public function ticket(string $token)
    {
        $guest = Guest::where('token', $token)->firstOrFail();

        $qrImage = $this->makeQrImage(route('guests.checkin', $guest->token));

        return view('guests.ticket', compact('guest', 'qrImage'));
    }

    public function downloadPdf(string $token)
    {
        $guest = Guest::where('token', $token)->firstOrFail();

        $qrImage = $this->makeQrImage(route('guests.checkin', $guest->token));

        $pdf = Pdf::loadView('guests.ticket-pdf', compact('guest', 'qrImage'))
            ->setPaper('a6', 'portrait');

        return $pdf->download('biglietto-' . $guest->slug_name . '.pdf');
    }

    public function checkin(string $token)
    {
        $guest = Guest::where('token', $token)->first();

        if (! $guest) {
            return response()->view('guests.invalid', [], 404);
        }

        if ($guest->checked_in) {
            return view('guests.already-used', compact('guest'));
        }

        $guest->update([
            'checked_in' => true,
            'checked_in_at' => now(),
        ]);

        return view('guests.success', compact('guest'));
    }

    private function makeQrImage(string $data): string
    {
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_H,
            'scale' => 8,
        ]);

        return (new QRCode($options))->render($data);
    }
}