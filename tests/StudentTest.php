<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Student.php';

class StudentTest extends TestCase
{
    private $pdo;
    private $student;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->student = new Student($this->pdo);
    }

    public function testAddStudent()
    {
        $result = $this->student->add('Иван', '2000-01-01', 'clay', 1, 'online');

        $this->assertTrue($result);

        $all = $this->student->getAll();
        $this->assertCount(1, $all);

        $record = $all[0];
        $this->assertEquals('Иван', $record['name']);
        $this->assertEquals('2000-01-01', $record['birth_date']);
        $this->assertEquals('clay', $record['theme']);
        $this->assertEquals(1, $record['materials']);
        $this->assertEquals('online', $record['format']);
    }

    public function testGetAllEmpty()
    {
        $all = $this->student->getAll();
        $this->assertIsArray($all);
        $this->assertEmpty($all);
    }
}
