<?php

class User extends Model
{
    /* As a best practice we need to create a config file and store the sensitive data on it like the Hash Code */
    const password_hash = "$#kN0wl3dgEC1ty$#";

    public function create($name, $lastname, $email, $password)
    {
        $sql = "INSERT INTO api_users (name, lastname,email,password) VALUES (:name,:lastname,:email,:password)";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => openssl_encrypt($password, "AES-128-ECB", $this::password_hash)
        ]); 
    }

    public function showUser($email)
    {
        $sql = "SELECT * FROM api_users WHERE email = '" . $email ."'";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // public function showAllStudents()
    // {
    //     $sql = "SELECT * FROM api_users";
    //     $req = Database::getBdd()->prepare($sql);
    //     $req->execute();
    //     return $req->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function delete($id)
    // {
    //     $sql = 'DELETE FROM api_users WHERE id = ?';
    //     $req = Database::getBdd()->prepare($sql);
    //     return $req->execute([$id]);
    // }
}
?>