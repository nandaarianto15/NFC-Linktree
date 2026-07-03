<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Link;
use App\Models\User;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Portfolio;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $request->user()->load(['experiences', 'skills', 'portfolios', 'testimonials']);
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->except('photo'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->save();
        return Redirect::route('profile.edit')->with('success', 'Profil berhasil disimpan.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ── Experience ──

    public function storeExperience(Request $request): RedirectResponse
    {
        $request->validate([
            'company'     => 'required|string|max:100',
            'role'        => 'required|string|max:100',
            'period'      => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        $request->user()->experiences()->create($request->only('company', 'role', 'period', 'description') + [
            'sort_order' => ($request->user()->experiences()->max('sort_order') ?? 0) + 1,
        ]);

        return Redirect::route('profile.edit', '#pengalaman')->with('success', 'Pengalaman ditambahkan.');
    }

    public function destroyExperience(int $id): RedirectResponse
    {
        Experience::where('id', $id)->where('user_id', Auth::id())->delete();
        return Redirect::route('profile.edit', '#pengalaman')->with('success', 'Pengalaman dihapus.');
    }

    // ── Skill ──

    public function storeSkill(Request $request): RedirectResponse
    {
        $request->validate([
            'name'       => 'required|string|max:50',
            'percentage' => 'required|integer|min:1|max:100',
        ]);

        $request->user()->skills()->create([
            'name'       => $request->name,
            'percentage' => $request->percentage,
            'sort_order' => ($request->user()->skills()->max('sort_order') ?? 0) + 1,
        ]);

        return Redirect::route('profile.edit', '#keahlian')->with('success', 'Keahlian ditambahkan.');
    }

    public function destroySkill(int $id): RedirectResponse
    {
        Skill::where('id', $id)->where('user_id', Auth::id())->delete();
        return Redirect::route('profile.edit', '#keahlian')->with('success', 'Keahlian dihapus.');
    }
    
    // ── Portfolio ──

    public function storePortfolio(Request $request): RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|max:2048',
            'url'         => 'nullable|url|max:500',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios', 'public');
        }

        $request->user()->portfolios()->create($request->only('title', 'description', 'url') + [
            'image_path' => $imagePath,
            'sort_order' => ($request->user()->portfolios()->max('sort_order') ?? 0) + 1,
        ]);

        return Redirect::route('profile.edit', '#proyek')->with('success', 'Proyek ditambahkan.');
    }

    public function destroyPortfolio(int $id): RedirectResponse
    {
        $portfolio = Portfolio::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($portfolio->image_path) {
            Storage::disk('public')->delete($portfolio->image_path);
        }
        $portfolio->delete();
        return Redirect::route('profile.edit', '#proyek')->with('success', 'Proyek dihapus.');
    }

    // ── Testimonial ──

    public function storeTestimonial(Request $request): RedirectResponse
    {
        $request->validate([
            'client_name' => 'required|string|max:100',
            'client_role' => 'nullable|string|max:100',
            'content'     => 'required|string|max:500',
        ]);

        $request->user()->testimonials()->create($request->only('client_name', 'client_role', 'content') + [
            'sort_order' => ($request->user()->testimonials()->max('sort_order') ?? 0) + 1,
        ]);

        return Redirect::route('profile.edit', '#testimoni')->with('success', 'Testimoni ditambahkan.');
    }

    public function destroyTestimonial(int $id): RedirectResponse
    {
        Testimonial::where('id', $id)->where('user_id', Auth::id())->delete();
        return Redirect::route('profile.edit', '#testimoni')->with('success', 'Testimoni dihapus.');
    }

    // ── Resume ──

    public function updateResume(Request $request): RedirectResponse
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user = $request->user();

        // Hapus file lama jika ada (replace)
        if ($user->resume_path) {
            Storage::disk('public')->delete($user->resume_path);
        }

        $user->resume_path = $request->file('resume')->store('resumes', 'public');
        $user->save();

        return Redirect::route('profile.edit', '#resume')->with('success', 'Resume berhasil diupload.');
    }

    public function destroyResume(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->resume_path) {
            Storage::disk('public')->delete($user->resume_path);
            $user->resume_path = null;
            $user->save();
        }

        return Redirect::route('profile.edit', '#resume')->with('success', 'Resume dihapus.');
    }

    // ── Public ──

    public function showPublicProfile(string $token)
    {
        $user = User::where('profile_token', $token)
            ->with(['experiences', 'skills', 'portfolios', 'testimonials'])
            ->firstOrFail();

        return view('public-profile', [
            'user'         => $user,
            'links'        => $user->links()->get(),
            'experiences'  => $user->experiences,
            'skills'       => $user->skills,
            'portfolios'   => $user->portfolios,
            // 'testimonials' => $user->testimonials,
        ]);
    }
}