<?php
class Fetch {
    public static function node($type, $data = array(), $children = array()) {
        return array(
            'type' => $type,
            'data' => $data,
            'children' => $children
        );
    }

    public static function render($node, $mapping = array()) {
        list($html, $meta) = self::metaRender($node, $mapping);
        return $html;
    }
    
    private static function mergeMeta($a, $b) {
        foreach ($b as $k => $values) {
            if (!isset($a[$k])) {
                $a[$k] = $values;
            } else {
                foreach($values as $v) {
                    $a[$k][] = $v;
                }
            }
        }
        return $a;
    }

    public static function metaRender($node, $mapping = array()) {
        $meta = array();
        foreach($node['children'] as $placement => $childs) {
            if (! isset($node['data'][$placement])) {
                $node['data'][$placement] = '';
            }
            foreach($childs as $child) {
                list($childHtml, $childMeta) = self::metaRender($child, $mapping);
                $meta = self::mergeMeta($meta, $childMeta);
                $node['data'][$placement] .= $childHtml;
            }
        }
        if (isset($mapping[$node['type']])) {
            $type = $mapping[$node['type']];
        } else {
            $type = $node['type'];
        }
        $file = ROOT . '/template/' . preg_replace('/_/', '/', $type) . '.phtml';
        $tpl = new FetchTemplate(); //TODO Wrap this in a static function
        $html = $tpl->render($file, $node['data'], $meta);
        $myMeta = $tpl->getAllMeta(); //TODO find a better way to do this
        $meta = self::mergeMeta($meta, $myMeta);
        return array($html, $meta);
    }
}
?>
