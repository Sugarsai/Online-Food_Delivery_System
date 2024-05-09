<?php
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;
use MyApp\Services\SearchService;

class SearchController{
    private $db;
    private $searchService;
    public function __construct(){
        $this->db = Database::getInstance();
        $this->searchService = new SearchService($this->db);
    }

    public function search($query)
    {
        $query = strip_tags($query);

        $results = $this->searchService->performSearch($query);

        return $results;
    }
}