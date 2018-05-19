<?php namespace app\models;

class User extends \Model
{
    public static $_table_use_short_name = true;

    public static $_table = 'user';
    public static $_id_column = 'user_id';
}
