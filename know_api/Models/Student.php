<?php
class Student extends Model
{
    public function create($name, $lastname)
    {
        $sql = "INSERT INTO students (name, lastname) VALUES (:name,:lastname)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'name' => $name,
            'lastname' => $lastname,
        ]);
    }

    public function showStudent($id)
    {
        $sql = "SELECT * FROM students WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function showAllStudents($limit, $current_page)
    {
        $offset = ($current_page - 1) * $limit;
        $sql = "SELECT * FROM students LIMIT " . $offset .",". $limit;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalStudentsPages($limit){
        $sql = "SELECT * FROM students";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $total_rows = $req->rowCount();
        return ceil($total_rows / $limit); /* Total of pages */
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM students WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>