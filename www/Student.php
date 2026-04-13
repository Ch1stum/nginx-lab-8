<?php
class Student
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->createTable();
    }

    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            birth_date DATE NOT NULL,
            theme VARCHAR(50) NOT NULL,
            materials TINYINT(1) DEFAULT 0,
            format VARCHAR(20) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function add($name, $birth_date, $theme, $materials, $format)
    {
        $sql = "INSERT INTO students (name, birth_date, theme, materials, format) 
                VALUES (:name, :birth_date, :theme, :materials, :format)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':birth_date' => $birth_date,
            ':theme' => $theme,
            ':materials' => $materials,
            ':format' => $format
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM students ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
