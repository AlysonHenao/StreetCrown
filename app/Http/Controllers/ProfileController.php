<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $viewData = [
            'title' => __('profile.title'),
            'user' => Auth::user(),
        ];

        return view('profile.show', ['viewData' => $viewData]);
    }

    public function edit(): View
    {
        $viewData = [
            'title' => __('profile.edit_title'),
            'user' => Auth::user(),
        ];

        return view('profile.edit', ['viewData' => $viewData]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        $user->setName($validated['name']);
        $user->setPhone($validated['phone']);
        $user->setAddress($validated['address']);
        $user->setCity($validated['city']);
        $user->setPostalCode($validated['postal_code']);
        $user->save();

        return redirect()->route('profile.show')
            ->with('success', __('profile.updated_successfully'));
    }
}