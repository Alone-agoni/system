<?php
namespace Admin\Model;

use Think\Model;

class LogModel extends Model
{
    public static function store($data)
    {
        M('Log')->add($data);
    }
}