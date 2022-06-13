<?php

namespace Tests\Feature\Sale;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetSalesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_sales()
    {
        $this->markTestSkipped('TODO');
    }
}
