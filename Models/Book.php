<?php

namespace App\Models;

use App\Models\BaseModel;

class Book extends BaseModel {

    protected function totalBooks() {
        $sql = "SELECT SUM(books.stock) as total_stock FROM books;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result ? (int)$result['total_stock'] : 0;
    }
    
    protected function booksWithAuthorAndPublisher() {
        $sql = "
            SELECT 
                books.title, 
                books.id,
                authors.name AS author, 
                authors.id AS author_id, 
                books.price, 
                books.stock, 
                books.published_date AS published, 
                publishers.name AS publisher,
                publishers.id AS publisher_id
            FROM 
                books 
            JOIN 
                authors ON books.author_id = authors.id 
            JOIN 
                publishers ON books.publisher_id = publishers.id;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result ? $result : [];
    }
}