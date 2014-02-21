<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends ORM
{
    protected $_table_name = "comment";
    protected $_primary_key = 'id';
}