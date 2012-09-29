<?php
class FetchBase {
    protected static function getType() {
        return get_called_class();
    }

    protected static function getData() {
        return array();
    }

    protected static function getChildren() {
        return array();
    }

    public static function get() {
        return Fetch::node(
            static::getType(),
            static::getData(),
            static::getChildren()
        );
    }
}
?>
