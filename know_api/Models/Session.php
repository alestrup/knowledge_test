<?php
class Session extends Model
{
    public function create($user_id, $token, $last_activity, $remember)
    {
        $sql = "INSERT INTO sessions (user_id, token, last_activity, remember) VALUES (:user_id,:token,:last_activity,:remember)";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'user_id' => $user_id,
            'token' => $token,
            'last_activity' => $last_activity,
            'remember' => $remember
        ]);
    }

    public function getSession($token, $user_id)
    {
        $sql = "SELECT * FROM sessions WHERE token ='" . $token."' AND user_id = ".$user_id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteSession($token, $user_id)
    {
        $sql = "DELETE FROM sessions WHERE token ='" . $token ."' AND user_id = ".$user_id;

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSession($token, $user_id, $last_activity)
    {
        $sql = "UPDATE sessions SET last_activity=:last_activity WHERE token ='" . $token."' AND user_id = ".$user_id;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'last_activity' => $last_activity
        ]);
    }

    public function deleteAllSessions($user_id){
        $sql = "DELETE FROM sessions WHERE $user_id = ". $user_id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}
?>