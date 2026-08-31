<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', __('messages.Updated profile'));
    }
    public function editZas(Request $request, User $user = null): View
    {
        $authUser = $request->user();

        if (!$user) {
            $user = $authUser;
        }

        $users = null;

        if ($authUser->type === 'admin') {
            $users = User::orderBy('name')->get();
        }

        return view('profile.zas.edit', [
            'user' => $user,
            'users' => $users
        ]);
    }
    public function updateZas(Request $request, User $user = null): RedirectResponse
    {
        $authUser = $request->user();

        if (!$user) {
            $user = $authUser;
        }
        $request->validate([
            'name' => ['required', 'string','max:255'],
            'nickname' => ['required','string','max:50'],
            'email' =>['required','string','lowercase','email','max:255',
                Rule::unique(User::class)->ignore($user->id)],
            'num_partner' => ['required', 'integer',
                Rule::unique(User::class)->ignore($user->id)],
            'telephone' => ['nullable','string','max:20'],
            'age' => ['nullable','integer','min:6'],
            'language' => ['required','in:es,en,ca'],
        ]);

        $user->update([
            'nickname' => $request->nickname,
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'num_partner' => $request->num_partner,
            'telephone' => $request->telephone,
            'age' => $request->age,
            'language' => $request->language,
        ]);

        return Redirect::route('profile.zas.edit', $user->id)->with('status', __('messages.Updated profile'));
    }

    /**
     * Delete the user's account.
     */
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

    public function updateTheme(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => ['required', 'in:classic,elegant'],
        ]);

        $request->user()->update(['theme' => $request->theme]);

        return Redirect::back()->with('status', __('messages.Theme updated'));
    }

    public function deactivate(User $user)
    {
        $user->withdrawal_date = now();
        $user->save();

        return back()->with('status', __('messages.Unsubscribed user'));
    }

    public function reactivate(User $user)
    {
        $user->withdrawal_date = null;
        $user->save();

        return back()->with('status',  __('messages.Reactivated user'));
    }
}
