<?php

class Member_model extends CRUD_Model {

    // You must always define the table and the primary key
    public $table = 'posts';
    public $primary_key = 'posts.post_id';
}