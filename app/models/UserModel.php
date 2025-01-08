<?php

class UserModel
{
    private static $table = 'users';

    public static function getAllUser()
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . ' WHERE deleted_at IS NULL';
        $result = $conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getUserById($id)
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . ' WHERE id = ? AND deleted_at IS NULL';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public static function getAllDeletedUser()
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . ' WHERE deleted_at IS NOT NULL';
        $result = $conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function createUser($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $columns = [];
        $params = [];
        $types = "";

        $updatableFields = [
            'email' => 's',
            'password' => 's',
            'full_name' => 's',
            'telephone' => 's',
            'address' => 's',
            'instance_id' => 'i',
            'position' => 's',
            'role_id' => 'i',
        ];

        foreach ($updatableFields as $field => $type) {
            if (!empty($data[$field])) {
                $columns[] = $field;
                $params[] = $field === 'password'
                    ? password_hash($data[$field], PASSWORD_DEFAULT)
                    : $data[$field];
                $types .= $type;
            }
        }

        $columns[] = "created_at";
        $params[] = $created_at;
        $types .= "s";

        $query = "INSERT INTO " . self::$table . " (" . implode(', ', $columns) . ") VALUES (" . implode(', ', array_fill(0, count($columns), '?')) . ")";

        $conn = Database::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        return $stmt->execute();
    }

    public static function updateUser($data)
    {
        $id = $data['id'];
        $updated_at = date('Y-m-d H:i:s');

        $columns = [];
        $params = [];
        $types = "";

        $updatableFields = [
            'email' => 's',
            'password' => 's',
            'full_name' => 's',
            'telephone' => 's',
            'address' => 's',
            'instance_id' => 'i',
            'position' => 's',
            'role_id' => 'i',
        ];

        foreach ($updatableFields as $field => $type) {
            if (!empty($data[$field])) {
                $columns[] = "$field = ?";
                $params[] = $field === 'password'
                    ? password_hash($data[$field], PASSWORD_DEFAULT)
                    : $data[$field];
                $types .= $type;
            }
        }

        $columns[] = "updated_at = ?";
        $params[] = $updated_at;
        $types .= "s";

        $params[] = $id;
        $types .= "i";

        $query = "UPDATE " . self::$table . " SET " . implode(', ', $columns) . " WHERE id = ?";

        $conn = Database::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        return $stmt->execute();
    }


    public static function deleteUser($id)
    {
        $deleted_at = date('Y-m-d H:i:s');

        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET deleted_at = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $deleted_at, $id);

        return $stmt->execute();
    }

    public static function restoreUser($id)
    {
        $deleted_at = NULL;

        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET deleted_at = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $deleted_at, $id);

        return $stmt->execute();
    }

    public static function destroyUser($id)
    {
        $conn = Database::getConnection();
        $query = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public static function search($data)
    {
        $keyword = "%" . $data['keyword'] . "%";
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE (email LIKE ? OR full_name LIKE ? OR position LIKE ?) AND deleted_at IS NULL";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $keyword, $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function searchDeleted($data)
    {
        $keyword = "%" . $data['keyword'] . "%";
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE (email LIKE ? OR full_name LIKE ? OR position LIKE ?) AND deleted_at IS NOT NULL";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $keyword, $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
