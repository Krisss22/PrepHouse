<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SentQuestion;
use Illuminate\Http\Request;

class SentQuestionController extends AdminController
{

    protected string $sectionName = 'sent-questions';

    public function index()
    {
        return view('admin/sent-question/list', [
            'sectionName' => $this->sectionName,
            'sentQuestions' => SentQuestion::query()->paginate(self::ITEM_ON_PAGE)
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('admin/sent-question/show', [
            'sectionName' => $this->sectionName,
            'sentQuestion' => SentQuestion::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        SentQuestion::findOrFail($id)->delete();

        return redirect('/admin/sent-questions/list');
    }

}
