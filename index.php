<?php
require_once 'config.php';

$tree = Fetch::node(
    'page',
    array(),
    array(
        'content' => array (
            Fetch::node('frontpage')
        )
    )
);
echo Fetch::render($tree);
?>
