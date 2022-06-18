<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Material;
use App\Models\Role;
use App\Models\Site;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class StudyController extends AdminController
{
    protected string $sectionName = 'study';

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        if (
            !$this->checkAccess('study_videos', Role::showAccessType)
            && !$this->checkAccess('study_books', Role::showAccessType)
            && !$this->checkAccess('study_materials', Role::showAccessType)
            && !$this->checkAccess('study_sites', Role::showAccessType)
        ) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/study/list', [
            'sectionName' => $this->sectionName,
            'topics' => Topic::query()->paginate(self::ITEM_ON_PAGE),
        ]);
    }

    /**
     * @param $topicId
     * @return Application|Factory|View|JsonResponse
     */
    public function videos($topicId)
    {
        if (!$this->checkAccess('study_videos', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/study/videos/videos', [
            'sectionName' => $this->sectionName,
            'videos' => Video::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    /**
     * @param $topicId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function createVideo($topicId, Request $request)
    {
        if (!$this->checkAccess('study_videos', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $videoModel = new Video();

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'link' => 'required|max:1000',
            ]);

            $imageName = null;
            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Video::IMAGES_PATH), $imageName);
            }

            Video::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => $imageName,
                'link' => $request->input('link'),
                'topic_id' => $topicId,
            ]);

            return redirect('/admin/study/list/' . $topicId . '/videos');
        }

        return view('admin/study/videos/create_or_edit_video', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'topicId' => $topicId,
            'video' => $videoModel,
        ]);
    }

    /**
     * @param $videoId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     */
    public function editVideo($videoId, Request $request)
    {
        if (!$this->checkAccess('study_videos', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $videoModel = Video::findORFail($videoId);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'link' => 'required|max:1000',
            ]);

            $updateParams = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'link' => $request->input('link'),
            ];

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Video::IMAGES_PATH), $imageName);
                $updateParams['image'] = $imageName;
            }

            $videoModel->update($updateParams);
        }

        return view('admin/study/videos/create_or_edit_video', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'video' => $videoModel,
            'topicId' => $videoModel->topic_id,
        ]);
    }

    /**
     * @param $videoId
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function deleteVideo($videoId)
    {
        if (!$this->checkAccess('study_videos', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $videoModel = Video::findORFail($videoId);
        $topicId = $videoModel->topic_id;
        $videoModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/videos');
    }

    /**
     * @param $topicId
     * @return Application|Factory|View|JsonResponse
     */
    public function books($topicId)
    {
        if (!$this->checkAccess('study_books', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/study/books/books', [
            'sectionName' => $this->sectionName,
            'books' => Book::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    /**
     * @param $topicId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function createBook($topicId, Request $request)
    {
        if (!$this->checkAccess('study_books', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $bookModel = new Book();

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'author' => 'required|max:100',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'file' => 'required',
            ]);

            $imageName = null;
            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Book::IMAGES_PATH), $imageName);
            }

            $fileName = null;
            if ($request->has('file')) {
                $fileName = time() . '.' . $request->file('file')->extension();
                $request->file('file')->move(storage_path('app/public/' . Book::FILES_PATH), $fileName);
            }

            Book::create([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'description' => $request->input('description'),
                'image' => $imageName,
                'file' => $fileName,
                'topic_id' => $topicId,
            ]);

            return redirect('/admin/study/list/' . $topicId . '/books');
        }

        return view('admin/study/books/create_or_edit_book', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'topicId' => $topicId,
            'book' => $bookModel,
        ]);
    }

    /**
     * @param $bookId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     */
    public function editBook($bookId, Request $request)
    {
        if (!$this->checkAccess('study_books', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $bookModel = Book::findORFail($bookId);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'author' => 'required|max:100',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'file' => '',
            ]);

            $updateParams = [
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'description' => $request->input('description'),
            ];

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Book::IMAGES_PATH), $imageName);
                $updateParams['image'] = $imageName;
            }

            if ($request->has('file')) {
                $fileName = time() . '.' . $request->file('file')->extension();
                $request->file('file')->move(storage_path('app/public/' . Book::FILES_PATH), $fileName);
                $updateParams['file'] = $fileName;
            }

            $bookModel->update($updateParams);
        }

        return view('admin/study/books/create_or_edit_book', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'book' => $bookModel,
            'topicId' => $bookModel->topic_id,
        ]);
    }

    /**
     * @param $bookId
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function deleteBook($bookId)
    {
        if (!$this->checkAccess('study_books', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $bookModel = Book::findORFail($bookId);
        $topicId = $bookModel->topic_id;
        $bookModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/books');
    }

    /**
     * @param $topicId
     * @return Application|Factory|View|JsonResponse
     */
    public function materials($topicId)
    {
        if (!$this->checkAccess('study_materials', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/study/materials/materials', [
            'sectionName' => $this->sectionName,
            'materials' => Material::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    /**
     * @param $topicId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function createMaterial($topicId, Request $request)
    {
        if (!$this->checkAccess('study_materials', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $materialModel = new Material();

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'file' => 'required',
            ]);

            $imageName = null;
            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Material::IMAGES_PATH), $imageName);
            }

            $fileName = null;
            if ($request->has('file')) {
                $fileName = time() . '.' . $request->file('file')->extension();
                $request->file('file')->move(storage_path('app/public/' . Material::FILES_PATH), $fileName);
            }

            Material::create([
                'title' => $request->input('title'),
                'image' => $imageName,
                'file' => $fileName,
                'topic_id' => $topicId,
            ]);

            return redirect('/admin/study/list/' . $topicId . '/materials');
        }

        return view('admin/study/materials/create_or_edit_material', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'topicId' => $topicId,
            'material' => $materialModel,
        ]);
    }

    /**
     * @param $bookId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     */
    public function editMaterial($bookId, Request $request)
    {
        if (!$this->checkAccess('study_materials', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $materialModel = Material::findORFail($bookId);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'file' => '',
            ]);

            $updateParams = [
                'title' => $request->input('title'),
            ];

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Material::IMAGES_PATH), $imageName);
                $updateParams['image'] = $imageName;
            }

            if ($request->has('file')) {
                $fileName = time() . '.' . $request->file('file')->extension();
                $request->file('file')->move(storage_path('app/public/' . Material::FILES_PATH), $fileName);
                $updateParams['file'] = $fileName;
            }

            $materialModel->update($updateParams);
        }

        return view('admin/study/materials/create_or_edit_material', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'material' => $materialModel,
            'topicId' => $materialModel->topic_id,
        ]);
    }

    /**
     * @param $materialId
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function deleteMaterial($materialId)
    {
        if (!$this->checkAccess('study_materials', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $materialModel = Material::findORFail($materialId);
        $topicId = $materialModel->topic_id;
        $materialModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/materials');
    }

    /**
     * @param $topicId
     * @return Application|Factory|View|JsonResponse
     */
    public function sites($topicId)
    {
        if (!$this->checkAccess('study_sites', Role::showAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        return view('admin/study/sites/sites', [
            'sectionName' => $this->sectionName,
            'sites' => Site::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    /**
     * @param $topicId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|RedirectResponse|Redirector
     */
    public function createSite($topicId, Request $request)
    {
        if (!$this->checkAccess('study_sites', Role::createAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $siteModel = new Site();

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'link' => 'required|max:1000',
            ]);

            $imageName = null;
            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Site::IMAGES_PATH), $imageName);
            }

            Site::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => $imageName,
                'link' => $request->input('link'),
                'topic_id' => $topicId,
            ]);

            return redirect('/admin/study/list/' . $topicId . '/sites');
        }

        return view('admin/study/sites/create_or_edit_site', [
            'action' => self::ACTION_CREATE,
            'sectionName' => $this->sectionName,
            'topicId' => $topicId,
            'site' => $siteModel,
        ]);
    }

    /**
     * @param $videoId
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     */
    public function editSite($videoId, Request $request)
    {
        if (!$this->checkAccess('study_sites', Role::updateAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $siteModel = Site::findORFail($videoId);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'link' => 'required|max:1000',
            ]);

            $updateParams = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'link' => $request->input('link'),
            ];

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(storage_path('app/public/' . Site::IMAGES_PATH), $imageName);
                $updateParams['image'] = $imageName;
            }

            $siteModel->update($updateParams);
        }

        return view('admin/study/sites/create_or_edit_site', [
            'action' => self::ACTION_EDIT,
            'sectionName' => $this->sectionName,
            'site' => $siteModel,
            'topicId' => $siteModel->topic_id,
        ]);
    }

    /**
     * @param $siteId
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function deleteSite($siteId)
    {
        if (!$this->checkAccess('study_sites', Role::deleteAccessType)) {
            return response()->json(["error" => "Access denied for your role"], 403);
        }

        $siteModel = Site::findORFail($siteId);
        $topicId = $siteModel->topic_id;
        $siteModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/sites');
    }
}
