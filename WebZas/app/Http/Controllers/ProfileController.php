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

        return Redirect::route('profile.edit')->with('status', 'Perfil actualizado');
    }
    public function editZas(Request $request, User $user = null): View
    {
        $authUser = $request->user();

        // Si no se pasa usuario, editar el propio
        if (!$user) {
            $user = $authUser;
        }

        $users = null;

        // Si es admin, cargar lista de usuarios
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
        ]);

        $user->update([
            'nickname' => $request->nickname,
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'num_partner' => $request->num_partner,
            'telephone' => $request->telephone,
            'age' => $request->age,
        ]);

        return Redirect::route('profile.zas.edit', $user->id)->with('status', 'Perfil actualizado');
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
}
