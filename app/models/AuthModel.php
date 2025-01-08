<?php

class AuthModel
{
    private static $table = 'users';

    public static function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['role_id'] = $row['role_id'];

                return true;
            }
        }

        return false;
    }
}
