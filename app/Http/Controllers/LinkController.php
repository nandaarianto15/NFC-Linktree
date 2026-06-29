<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255', 
        ]);

        $inputUrl = trim($request->url);

        if (preg_match('/^[0-9\-\+\s]+$/', $inputUrl)) {
            $number = preg_replace('/[^0-9]/', '', $inputUrl);

            if (str_starts_with($number, '0')) {
                $number = '62' . substr($number, 1);
            }
            
            if (str_starts_with($number, '8')) {
                $number = '62' . $number;
            }

            $inputUrl = "https://wa.me/" . $number;
        } else {
            if (!preg_match("~^(?:f|ht)tps?://~i", $inputUrl)) {
                $inputUrl = "https://" . $inputUrl;
            }
        }

        Link::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'url' => $inputUrl,
        ]);

        return redirect()->route('dashboard')->with('success', 'Link berhasil ditambahkan!');
    }

    public function destroy(Link $link)
    {
        if ($link->user_id !== Auth::user()->id) {
            abort(403);
        }

        $link->delete();

        return redirect()->route('dashboard')->with('success', 'Link berhasil dihapus!');
    }
}