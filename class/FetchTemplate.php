<?php
class FetchTemplate {
    private $meta = array();
    public function addMeta($key, $value) {
        if (!isset($this->meta[$key])) {
            $this->meta[$key] = array();
        }
        $this->meta[$key][] = $value;
    }

    public function getMeta($key) {
        if (!isset($this->meta[$key])) {
            return array();
        } else {
            return $this->meta[$key];
        }
    }

    /**
     * Returns the metadata for key with doublets removed.
     *
     * Order is preserved.
     */
    public function getMetaUniq($key) {
        $ret = array();
        $set = array();
        $m = $this->getMeta($key);
        foreach($m as $v) {
            if (isset($set[$v])) {
                continue;
            }
            $ret[] = $v;
            $set[$v] = 1;
        }
        return $ret;
    }

    public function getAllMeta() {
        return $this->meta;
    }

    public function render($_file, $_data, $_meta) {
        if (!file_exists($_file)) {
            throw new Exception('The template was not found: ' . $_file);
        }
        $this->meta = $_meta;
        unset($_data['_data']);
        unset($_data['_file']);
        foreach ($_data as $k => $v) {
            $$k = $v;
        }
        unset($_data);
        unset($_meta);
        ob_start();
        require $_file;
        return ob_get_clean();
    }
}
?>
