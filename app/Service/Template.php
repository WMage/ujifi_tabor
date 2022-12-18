<?php

namespace App\Service;

use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2018.08.16.
 * Time: 17:19
 */
class Template extends Singleton
{

    /**
     * @function generateSelect generates html option select from list by selected tag
     * @param string $name
     * @param array|Collection $list
     * @param string $selected id of default selected value
     * @param array $match field matching
     * @param bool $autoSubmit
     * @return string
     */
    public static function generateSelect($name, $list, $selected = "", $match = array('value', 'text'), bool $autoSubmit = false)
    {
        $s = $autoSubmit ? 'onchange="this.form.submit()"' : "";
        $ret = "<select name='$name' " . $s . ">\n";
        $ret .= "<option value='null'> -- Válassz! -- </option>";
        foreach ($list as $option) {
            $value = self::fetchValue($option, $match[0]);
            $text = self::fetchValue($option, $match[1]);
            $ret .= "<option " . (($selected == $value) ? ('selected=\'selected\'') : ('')) . " value='" . $value . "'>" . $text . "</option>\n";
        }
        $ret .= "</select>\n";
        return $ret;
    }

    private static function fetchValue($option, $value)
    {
        if (is_object($option) && method_exists($option, $value)) {
            return $option->$value();
        } else {
            return $option[$value];
        }
    }

    /**
     * @function generateCheckbox generates html Checkbox from list by selected array
     * @param string $name
     * @param array $list
     * @param array $selected id of default selected values
     * @param array $match field matching
     * @return string
     */
    public static function generateCheckbox(string $name, array $list, array $selected = [], array $match = ['ID', 'text']): string
    {
        $ret = "";
        foreach ($list as $option) {
            $ret .= "<input type='checkbox' name='" . $name . "[]' " . ((in_array($option[$match[0]], $selected)) ? ('checked=\'checked\'') : ('')) . " value='" . $option[$match[0]] . "'> - " . $option[$match[1]] . "<br />\n";
        }
        return $ret;
    }

    /**
     * @param string $name
     * @param array<int, array> $list list of array where $match's ID & VALUES placed
     * @param array $selected
     * @param array{ID:string, ROW:string, VALUES:array<string, string>} $match
     * @return string
     */
    public static function generateMultiCheckbox(string $name, array $list, array $selected = [], array $match = ['ID' => 'ID', 'ROW' => 'day', 'VALUES' => ['field_text'=>'field_value']]): string
    {
        $ret = '';
        foreach ($list as $option) {
            $ret .= $option[$match['ROW']] ?? ' - ';
            foreach ($match['VALUES'] as $fieldKey=>$fieldValue) {
                if ($option[$fieldKey] ?? false) {
                    $ret .= "<input type='checkbox' name='" . $name . "[]' value='$fieldKey-{$option[$match['ID']]}'> - " . $fieldValue;
                }
            }
            $ret .= "<br />\n";
        }
        return $ret;
    }

    //TODO: redirect need refactor to work
    public static function redirect($action = false, $ctrl = false)
    {
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

    public static function getNOWStr()
    {
        return date_create()->format('Y-m-d H:i:s');
    }

}
