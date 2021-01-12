<?php
/**
 * Created by PhpStorm.
 * User: ailus
 * Date: 18.07.19
 * Time: 21:40
 */

namespace Monsters\FormBuilder;

class ItemsList extends Control
{
    const TYPE_CUSTOM = 0;
    const TYPE_RADIO = 1;
    const TYPE_CHECKBOX = 2;

    private $_items = [];

    private $_type;

    public function __construct($name, $label, $id, $type = self::TYPE_CUSTOM, $is_error = false, $error_text = '')
    {
        $this->_type = $type;
        parent::__construct($name, $label, $id, $is_error, $error_text);
    }

    public function addItem($id, $name)
    {
        $this->_items[$id] = $name;
    }

    public function getItems()
    {
        return $this->_items;
    }
}