<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Material;
use App\Models\Site;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudyController extends AdminController
{
    protected string $sectionName = 'study';

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin/study/list', [
            'sectionName' => $this->sectionName,
            'topics' => Topic::query()->paginate(self::ITEM_ON_PAGE),
        ]);
    }

    public function videos($topicId)
    {
        return view('admin/study/videos/videos', [
            'sectionName' => $this->sectionName,
            'videos' => Video::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    public function createVideo($topicId, Request $request)
    {
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

    public function editVideo($videoId, Request $request)
    {
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

    public function deleteVideo($videoId)
    {
        $videoModel = Video::findORFail($videoId);
        $topicId = $videoModel->topic_id;
        $videoModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/videos');
    }

    public function books($topicId)
    {
        return view('admin/study/books/books', [
            'sectionName' => $this->sectionName,
            'books' => Book::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    public function createBook($topicId, Request $request)
    {
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

    public function editBook($bookId, Request $request)
    {
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

    public function deleteBook($bookId)
    {
        $bookModel = Book::findORFail($bookId);
        $topicId = $bookModel->topic_id;
        $bookModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/books');
    }

    public function materials($topicId)
    {
        return view('admin/study/materials/materials', [
            'sectionName' => $this->sectionName,
            'materials' => Material::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    public function createMaterial($topicId, Request $request)
    {
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

    public function editMaterial($bookId, Request $request)
    {
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

    public function deleteMaterial($materialId)
    {
        $materialModel = Material::findORFail($materialId);
        $topicId = $materialModel->topic_id;
        $materialModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/materials');
    }

    public function sites($topicId)
    {
        return view('admin/study/sites/sites', [
            'sectionName' => $this->sectionName,
            'sites' => Site::query()->where('topic_id', $topicId)->paginate(self::ITEM_ON_PAGE),
            'topicId' => $topicId,
        ]);
    }

    public function createSite($topicId, Request $request)
    {
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

    public function editSite($videoId, Request $request)
    {
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

    public function deleteSite($siteId)
    {
        $siteModel = Site::findORFail($siteId);
        $topicId = $siteModel->topic_id;
        $siteModel->delete();

        return redirect('/admin/study/list/' . $topicId . '/sites');
    }
}
