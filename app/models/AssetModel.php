<?php

class AssetModel
{
    private static $table = 'Assets';

    public static function getAllAsset()
    {
        $conn = Database::getConnection();
        $query = "SELECT a.*, u.id AS user_id, u.full_name AS user_full_name, u.position AS user_position
                    FROM " . self::$table . " a
                    LEFT JOIN users u ON a.user_id = u.id
                    WHERE a.deleted_at IS NULL";
        $result = $conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getAssetById($id)
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . ' WHERE id = ? AND deleted_at IS NULL';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public static function getAllDeletedAsset()
    {
        $conn = Database::getConnection();
        $query = "SELECT a.*, u.id AS user_id, u.full_name AS user_full_name
                    FROM " . self::$table . " a
                    LEFT JOIN users u ON a.user_id = u.id
                    WHERE a.deleted_at IS NOT NULL";
        $result = $conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function createAsset($data)
    {
        $created_at = date('Y-m-d H:i:s');

        $columns = [];
        $params = [];
        $types = "";

        $updatableFields = [
            'name' => 's',
            'purchase_date' => 's',
            'warranty_expiry' => 's',
            'description' => 's',
            'user_id' => 'i',
            'instance_id' => 'i',
            'qty' => 'i',
        ];

        foreach ($updatableFields as $field => $type) {
            if (!empty($data[$field])) {
                $columns[] = $field;
                $params[] = $data[$field];
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

    public static function updateAsset($data)
    {
        $id = $data['id'];
        $updated_at = date('Y-m-d H:i:s');

        $columns = [];
        $params = [];
        $types = "";

        $updatableFields = [
            'name' => 's',
            'purchase_date' => 's',
            'warranty_expiry' => 's',
            'description' => 's',
            'user_id' => 'i',
            'instance_id' => 'i',
            'qty' => 'i',
        ];

        foreach ($updatableFields as $field => $type) {
            if (!empty($data[$field])) {
                $columns[] = "$field = ?";
                $params[] = $data[$field];
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



    public static function deleteAsset($id)
    {
        $deleted_at = date('Y-m-d H:i:s');

        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET deleted_at = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $deleted_at, $id);

        return $stmt->execute();
    }

    public static function restoreAsset($id)
    {
        $deleted_at = NULL;

        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET deleted_at = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $deleted_at, $id);

        return $stmt->execute();
    }

    public static function destroyAsset($id)
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
        $query = "SELECT a.*, u.id AS user_id, u.full_name AS user_full_name, u.position AS user_position
                    FROM " . self::$table . " a
                    LEFT JOIN users u ON a.user_id = u.id
                    WHERE a.name LIKE ? AND a.deleted_at IS NULL";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function searchDeleted($data)
    {
        $keyword = "%" . $data['keyword'] . "%";
        $conn = Database::getConnection();
        $query = "SELECT a.*, u.id AS user_id, u.full_name AS user_full_name, u.position AS user_position
                    FROM " . self::$table . " a
                    LEFT JOIN users u ON a.user_id = u.id
                    WHERE a.name LIKE ? AND a.deleted_at IS NOT NULL";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
