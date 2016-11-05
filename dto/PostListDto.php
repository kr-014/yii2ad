<?php

namespace app\dto;

/**
 * PostListDto
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PostListDto
{
    public $id;
    public $title;
    public $slug;
    public $introtext;
    public $image;
    public $category_id;
    public $category_title;
    public $published_at;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
