<?php

namespace App\Models;

use App\Models\BaseModel;
use PDO;

class Category extends BaseModel {

    protected function getCatergoriesWithChildren() {
        $sql = "
            SELECT 
                categories.id,
                categories.name,
                categories.description,
                parent_categories.id AS parent_category_id,
                parent_categories.name AS parent_category_name,
                GROUP_CONCAT(child_categories.name ORDER BY child_categories.id SEPARATOR ', ') AS children_categories_names,
                GROUP_CONCAT(child_categories.id ORDER BY child_categories.id SEPARATOR ', ') AS children_categories_ids
            FROM 
                categories
            LEFT JOIN 
                categories AS parent_categories ON categories.parent_id = parent_categories.id
            LEFT JOIN 
                categories AS child_categories ON child_categories.parent_id = categories.id
            GROUP BY 
                categories.id;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, Category::class);

        return $result;
    }

    protected function getCategoryWithChildren($id) {
        $sql = "
            SELECT 
                categories.id,
                categories.name,
                categories.description,
                parent_categories.id AS parent_category_id,
                parent_categories.name AS parent_category_name,
                GROUP_CONCAT(child_categories.name ORDER BY child_categories.id SEPARATOR ', ') AS children_categories_names,
                GROUP_CONCAT(child_categories.id ORDER BY child_categories.id SEPARATOR ', ') AS children_categories_ids
            FROM 
                categories
            LEFT JOIN 
                categories AS parent_categories ON categories.parent_id = parent_categories.id
            LEFT JOIN 
                categories AS child_categories ON child_categories.parent_id = categories.id
            WHERE 
                categories.id = :id
            GROUP BY 
                categories.id;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchObject(Category::class);

        return $result;
    }

    public function save () {
        $query = $this->db->prepare('INSERT INTO categories (name, description, parent_id) VALUES (:name, :description, :parent_id)');
        $query->execute([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);
    }

    public function update () {
        $query = $this->db->prepare('UPDATE categories SET name = :name, description = :description, parent_id = :parent_id WHERE id = :id');
        $query->execute([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);
    }

}