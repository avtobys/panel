<?php

class User
{
    public $id = 0;

    public function __construct($user_id)
    {
        global $dbh;
        if ($user_id) {
            $sth = $dbh->prepare("SELECT * FROM `users` WHERE `id` = ?");
            $sth->execute([$user_id]);
            $user = $sth->fetch(PDO::FETCH_OBJ);
            if ($user) {
                foreach ($user as $prop => $value) {
                    $this->$prop = $value;
                }
                if ($_SESSION['user_id'] && $_SESSION['user_id'] == $this->id && strtotime($this->date_online) + ONLINE_UPDATE_TIMEOUT <= time()) {
                    $this->setOnline();
                }
            }
        }
    }

    public function setPassword($password)
    {
        global $dbh;
        $sth = $dbh->prepare("UPDATE `users` SET `md5password` = ? WHERE `id` = ?");
        $sth->execute([md5($password), $this->id]);
        $this->md5password = md5($password);
        return $sth->rowCount();
    }

    public function setRoot($root)
    {
        global $dbh;
        $sth = $dbh->prepare("UPDATE `users` SET `root` = ? WHERE `id` = ?");
        $sth->execute([$root, $this->id]);
        $this->root = abs(intval($root));
        return $sth->rowCount();
    }

    public function setOnline()
    {
        global $dbh;
        $dbh->exec("UPDATE `users` SET `date_online` = NOW() WHERE `id` = $this->id");
    }
}
