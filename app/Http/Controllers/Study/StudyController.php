<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Material;
use App\Models\Site;
use App\Models\Topic;
use App\Models\Video;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    protected string $sectionName = 'study';

    public function index()
    {
        $topics = Topic::all();

        $topicsAndMaterials = [];

        foreach ($topics as $topic) {
            $topicsAndMaterials[] = [
                'topic' => $topic,
                'materialsCount' => count($topic->books) + count($topic->materials) + count($topic->videos) + count($topic->sites)
            ];
        }

        return $this->view('study/index', [
            'topicsAndMaterials' => $topicsAndMaterials
        ]);
    }

    public function topicMaterialsList(int $topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $videos = Video::query()->where('topic_id', '=', $topicId)->limit(3)->get();
        $books = Book::query()->where('topic_id', '=', $topicId)->limit(3)->get();
        $materials = Material::query()->where('topic_id', '=', $topicId)->limit(6)->get();
        $sites = Site::query()->where('topic_id', '=', $topicId)->limit(3)->get();

        return $this->view('study/topic_materials', [
            'videos' => $videos,
            'books' => $books,
            'materials' => $materials,
            'sites' => $sites,
            'topicId' => $topicId,
            'topicName' => $topic->name,
        ]);
    }

    public function videosList(int $topicId) {
        return $this->view('study/videos', [
            'videos' => Video::query()->where('topic_id', '=', $topicId)->get(),
        ]);
    }

    public function booksList(int $topicId) {
        return $this->view('study/books', [
            'books' => Book::query()->where('topic_id', '=', $topicId)->get(),
        ]);
    }

    public function materialsList(int $topicId) {
        return $this->view('study/materials', [
            'materials' => Material::query()->where('topic_id', '=', $topicId)->get(),
        ]);
    }

    public function sitesList(int $topicId) {
        return $this->view('study/sites', [
            'sites' => Site::query()->where('topic_id', '=', $topicId)->get(),
        ]);
    }
}
