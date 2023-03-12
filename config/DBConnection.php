<?php
class DBConnection
{
    public function getConnection()
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=BT3_BTTH03', 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'ERROR!';
            print_r($e);
        }
        return $conn;
    }
}
?>