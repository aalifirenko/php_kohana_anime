<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog extends ORM
{
    protected $_table_name = "blog";
    protected $_primary_key = 'id';
}