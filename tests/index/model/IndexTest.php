<?php
namespace tests\index\model;

use tests\TestCase;

class IndexTest extends TestCase
{
    public function testSearch()
    {
        $this->seeInDatabase('user', ['id' => 60]);
    }
}
