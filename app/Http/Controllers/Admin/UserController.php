<?php
// Author: Alyson Henao

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $role = $request->query('role');

        $query = User::query()->orderByDesc('id');

        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if (!empty($role)) {
            $query->where('role', $role);
        }

        $viewData = [];
        $viewData['title'] = __('user.admin_list_title');
        $viewData['subtitle'] = __('user.admin_list_subtitle');
        $viewData['users'] = $query->paginate(30)->appends($request->query());
        $viewData['search'] = $search;
        $viewData['role'] = $role;
        $viewData['roles'] = [
            'admin' => 'Admin',
            'user' => 'User',
        ];

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('user.edit_title');
        $viewData['subtitle'] = __('user.edit_subtitle');
        $viewData['user'] = User::findOrFail($id);
        $viewData['roles'] = [
            'admin' => 'Admin',
            'user' => 'User',
        ];

        return view('admin.user.edit')->with('viewData', $viewData);
    }

    public function update(UpdateUserRoleRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        return redirect()
            ->route('admin.user.index')
            ->with('success', __('user.updated_successfully'));
    }
}