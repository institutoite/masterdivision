<?php

namespace App\Http\Controllers;

use App\Models\PaymentProof;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentProofController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ]);

        $file = $validated['payment_proof'];
        $path = $file->store('payment-proofs', 'public');

        PaymentProof::create([
            'user_id' => $request->user()->id,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('verification.pending')
            ->with('status', 'Comprobante enviado. Estamos verificando tu pago.');
    }
}
