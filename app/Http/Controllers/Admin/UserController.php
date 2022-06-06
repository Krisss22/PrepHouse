<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends AdminController
{

    protected string $sectionName = 'users';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin/users/list', [
            'sectionName' => $this->sectionName,
            'users' => User::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('admin/users/show', [
            'sectionName' => $this->sectionName,
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            var_dump(111);
//            $request->validate([
//                'inputJobVacancy' => 'required|max:25',
//                'inputQuestion' => 'required|max:500'
//            ]);

//            DB::table('users')
//                ->where('id', $id)
//                ->limit(1)
//                ->update([
//                    'job_vacancy' => $request->input('inputJobVacancy'),
//                    'question' => $request->input('inputQuestion'),
//                ]);
        }

        return view('admin/users/edit', [
            'sectionName' => $this->sectionName,
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return redirect('/admin/users/list');
    }
}
