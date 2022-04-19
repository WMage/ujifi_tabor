<?php
namespace App\Service;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2018.08.16.
 * Time: 17:19
 */
class Template extends Singleton {
    protected $headerTpl = 'view/header.phtml';
    protected $mainTpl = 'view/index.phtml';
    protected $footerTpl = 'view/footer.phtml';
    protected $jsFiles = array();
    protected $tplVars = array();
    protected $tplErrors = array();

    /**
     * @function generateSelect generates html option select from list by selected tag
     * @param string $name
     * @param array $list
     * @param string $selected id of default selected value
     * @param array $match field matching
     * @return string
     */
    public static function generateSelect($name, $list, $selected = "", $match = array('value', 'text')) {
        $ret = "<select name='$name'>\n";
        foreach ($list as $option) {
            $ret .= "<option " . (($selected == $option[$match[0]]) ? ('selected=\'selected\'') : ('')) . " value='" . $option[$match[0]] . "'>" . $option[$match[1]] . "</option>\n";
        }
        $ret .= "</select>\n";
        return $ret;
    }

    /**
     * @function generateChecbox generates html Checbox from list by selected array
     * @param string $name
     * @param array $list
     * @param array $selected id of default selected values
     * @param array $match field matching
     * @return string
     */
    public static function generateChecbox($name, $list, $selected = array(), $match = array('ID', 'text')) {
        $ret = "";
        foreach ($list as $option) {
            $ret .= "<input type='checkbox' name='" . $name . "[]' " . ((in_array($option[$match[0]], $selected)) ? ('checked=\'checked\'') : ('')) . " value='" . $option[$match[0]] . "'> - " . $option[$match[1]] . "<br />\n";
        }
        return $ret;
    }

    public static function redirect($action = false, $ctrl = false) {
        $base = "http://" . $_SERVER['SERVER_NAME'];
        $current = $base . $_SERVER['REQUEST_URI'];
        if (!$action && !$ctrl) {
            $target = @$_SERVER['HTTP_REFERER'];
            if ($target == $current) {
                $p = explode("/", $target);
                unset($p[(count($p) - 1)]);
                $target = implode("/", $p);
            }
        } elseif (!$ctrl) {
            $target = $base . "/$action/";
        } else {
            $target = $base . "/$ctrl/$action/";
        }
        if ($target == $current) return;

        header("Location: $target");
    }

    public static function getNOWStr(){
        return date_create()->format('Y-m-d H:i:s');
    }

    public function addError($msg, $key = '') {
        if (empty($key)) {
            $this->tplErrors[] = $msg;
        } else {
            $this->tplErrors[$key] = $msg;
        }
    }

    public function getErrors() {
        return $this->tplErrors;
    }

    public function hasErrors() {
        return (count($this->tplErrors) > 0);
    }

    public function registerJs($file) {
        if (!in_array($file, $this->jsFiles)) {
            $this->jsFiles[] = $file;
        }
    }

    public function assignVar($key, $value) {
        $this->tplVars[$key] = $value;
    }

    /**
     * @return string
     */
    public function getHeaderTpl() {
        return $this->headerTpl;
    }

    /**
     * @return string
     */
    public function getFooterTpl() {
        return $this->footerTpl;
    }

    /**
     * @return array
     */
    public function getJsFiles() {
        return $this->jsFiles;
    }

    /**
     * @return string html js files header
     */
    public function fetchJsFiles() {
        $ret = "";
        foreach ($this->jsFiles as $file) {
            $ret .= "<script src='" . $file . "'></script>\n";
        }
        return $ret;
    }
    /**
     * @return object ->header
     */
    /*public function getData() {
        return (object)array(
            'header' => $this->headerTpl,
            'footer' => $this->footerTpl,
            'jsFiles' => $this->jsFiles,
            'tplVars' => $this->tplVars
        );
    }*/

    /**
     * @param $urlData
     * @return string
     */
    public function getTplByUrlData($urlData) {
        $base = "view/";
        $path = strtolower($base . implode("/", $urlData) . ".phtml");
        if (file_exists($path)) {
            return $path;
        }
        if (count($urlData) == 2) {
            unset($urlData[1]);
        }
        array_unshift($urlData, CtrlMain::defaultCtrl);
        $path = strtolower($base . implode("/", $urlData) . ".phtml");
        if (file_exists($path)) {
            return $path;
        }
        return false;
    }

    public function getMainTpl() {
        return strtolower($this->mainTpl);
    }

    /**
     * @param $key
     * @return string|array
     */
    public function getVar($key) {
        if (!isset($this->tplVars[$key])) {
            if (substr($key, strlen($key) - 4) == 'list') {
                return array();
            }
            return "";
        }
        return $this->tplVars[$key];
    }

}