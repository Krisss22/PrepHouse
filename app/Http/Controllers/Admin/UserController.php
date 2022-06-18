<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{

    protected string $sectionName = 'users';

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin/users/list', [
            'sectionName' => $this->sectionName,
            'users' => User::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return view('admin/users/show', [
            'sectionName' => $this->sectionName,
            'user' => User::findOrFail($id)
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'surname' => 'required|string|max:100',
                'password' => 'required|string|min:8',
                'email' => 'required|email',
                'role' => 'required|integer',
            ]);

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return redirect('/admin/users/list');
        }

        return view('admin/users/edit', [
            'sectionName' => $this->sectionName,
            'action' => self::ACTION_CREATE,
            'user' => new User(),
            'roles' => Role::all()
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, int $id)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'surname' => 'required|string|max:100',
                'password' => 'max:20',
                'email' => 'required|email',
                'role' => 'required|integer',
            ]);

            $user = User::findOrFail($id);

            if ($validated['password'] && $validated['password'] !== '') {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect('/admin/users/list');
        }

        return view('admin/users/edit', [
            'sectionName' => $this->sectionName,
            'user' => User::findOrFail($id),
            'action' => self::ACTION_EDIT,
            'roles' => Role::all()
        ]);
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function delete(int $id)
    {
        User::findOrFail($id)->delete();

        return redirect('/admin/users/list');
    }
}
