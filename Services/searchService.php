<?php 
declare(strict_types=1);
namespace MyApp\Services;
use MyApp\Database;

class SearchService{
    private $db;
    public function __construct(Database $db){
        $this->db = $db;
    }

    public function performSearch($query)
        {
        $sql = "SELECT * FROM shop WHERE title LIKE ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("s", $query);

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}