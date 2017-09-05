<?php
namespace tests\index\controller;

use tests\TestCase;

class IndexTest extends TestCase
{
public function testIndex()
{
$this->call('GET', '/');
$this->assertResponseOk();
}
}