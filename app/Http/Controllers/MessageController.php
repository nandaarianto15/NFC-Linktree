<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of incoming messages.
     */
    public function index(Request $request)
    {
        $messages = $request->user()->messages()->paginate(15);
        return view('messages.index', compact('messages'));
    }

    /**
     * Remove the specified message from database.
     */
    public function destroy(Message $message)
    {
        if ($message->user_id !== Auth::id()) {
            abort(403);
        }

        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Store a message submitted from public profile CTA form.
     */
    public function storePublicMessage(Request $request, string $token)
    {
        $user = User::where('profile_token', $token)->firstOrFail();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'company' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $formattedMessage = "Perusahaan/Instansi: " . $request->company . "\n" .
                             "Asal Kota: " . $request->city . "\n\n" .
                             "Penjelasan Proyek:\n" . $request->message;

        $user->messages()->create([
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $formattedMessage,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda berhasil dikirim!'
        ]);
    }
}
