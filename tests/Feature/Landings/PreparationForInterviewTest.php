<?php

namespace Tests\Feature\Landings;

use Tests\TestCase;

class PreparationForInterviewTest extends TestCase
{
    /** @return void */
    public function testLoadPage(): void
    {
        $response = $this->get('/landing/preparation-for-interviews');

        $response->assertStatus(200);
    }
}
