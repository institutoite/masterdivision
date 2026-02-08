<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentApprovalController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->with(['paymentProofs'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payments', [
            'users' => $users,
        ]);
    }

    public function approve(Request $request, User $user): RedirectResponse
    {
        $user->update(['is_paid' => true]);

        return redirect()->route('admin.payments.index');
    }

    public function revoke(Request $request, User $user): RedirectResponse
    {
        $user->update(['is_paid' => false]);

        return redirect()->route('admin.payments.index');
    }
}
