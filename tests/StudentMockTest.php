<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Student.php';

class StudentMockTest extends TestCase
{
    private $pdoMock;
    private $student;

    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);

        $this->pdoMock->expects($this->once())
            ->method('exec')
            ->willReturn(true);

        $this->student = new Student($this->pdoMock);
    }

    public function testAddWithMock()
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        $result = $this->student->add('Петя', '1999-05-10', 'drawing', 0, 'offline');

        $this->assertTrue($result);
    }
}
