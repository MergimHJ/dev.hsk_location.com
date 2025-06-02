<?php

function checkin()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        render('checkin.php');
    } else {
        $stmt = db()->prepare('SELECT id, password FROM operator WHERE username = ?', [$_POST['username']]);
        $stmt->execute([$_POST['username']]);
        $operator = $stmt->fetch();
        if (!$operator || $operator['password'] !== $_POST['password']) {
            render('checkin.php', ['error' => 'huhuhu say the magic word']);
        } else {
            $_SESSION['active_user'] = $operator['id'];
            header('Location: /admin');
        }
    }
}

function bye()
{
    session_destroy();
    header('Location: /');
}