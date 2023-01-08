<?php

namespace Tests\Feature\Admin;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function testOpenPageWithoutLogin(): void
    {
        $response = $this->get('/admin/tags/list');

        $response->assertStatus(302);
    }

    public function testOpenPageWithUserLogin(): void
    {
        $user = User::where(['role' => 0])->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/tags/list');

        $response->assertStatus(403);
    }

    public function testOpenPageWithAdminLogin(): void
    {
        $user = User::where(['role' => 1])->first();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/tags/list');

        $response->assertStatus(200);
    }

    public function testCreateTagNameOverOneHundred() : void
    {
        $user = User::where(['role' => 1])->first();

        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/admin/tags/create', [
                'name' => $this->randString(101),
            ]);

        $this->assertCount(0, Tag::all());
    }

    public function testCreateTagNameWithOneHundred() : void
    {
        $user = User::where(['role' => 1])->first();

        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/admin/tags/create', [
                'name' => $this->randString(100),
            ]);

        $this->assertCount(1, Tag::all());
    }

    public function testUpdateNotExistTag(): void
    {
        $user = User::where(['role' => 1])->first();
        $tag = Tag::factory()->create([
            'name' => 'test'
        ]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/admin/tags/edit/' . ($tag->id + 1), [
                'name' => $this->randString(100),
            ]);

        $response->assertStatus(404);
    }

    public function testUpdateExistTag(): void
    {
        $user = User::where(['role' => 1])->first();
        $tag = Tag::factory()->create([
            'name' => 'test'
        ]);
        $newName = $this->randString(100);

        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/admin/tags/edit/' . $tag->id, [
                'name' => $newName,
            ]);

        $updatedTag = Tag::findOrFail($tag->id);
        $this->assertEquals($updatedTag->name, $newName);
    }

    public function testDropNotExistTag(): void
    {
        $user = User::where(['role' => 1])->first();
        $tag = Tag::factory()->create([
            'name' => 'test'
        ]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/tags/delete/' . ($tag->id + 1));

        $response->assertStatus(404);
    }

    public function testDropExistTag(): void
    {
        $user = User::where(['role' => 1])->first();
        $tag = Tag::factory()->create([
            'name' => 'test'
        ]);

        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/tags/delete/' . $tag->id);

        $this->assertCount(0, Tag::all());
    }

    public function testGetJson(): void
    {
        $user = User::where(['role' => 1])->first();
        Tag::factory()->create([
            'name' => 'test'
        ]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/admin/tags/get-json');

        $this->assertEquals($response->getContent(), json_encode(Tag::all()));
    }

    /**
     * @param int|null $length
     * @return string
     */
    private function randString(?int $length): string
    {
        $str = '';
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }
}
