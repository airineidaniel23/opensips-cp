<?php
require_once(__DIR__."/../../../../system/dashboard/template/widget/widget.php");

class cdr_widget extends widget
{
    public $cdr_entries;

    function __construct($array) {
        parent::__construct($array['panel_id'], $array['widget_name'], 2, 2, $array['widget_name']);
        $this->set_cdr_entries();
    }


    function get_name() {
        return "CDR widget";
    }
    function display_test() {
        echo ('CDR Viewer entries:<br><br> <div style=" font-family: Helvetica; font-size: 150%;">'.$this->cdr_entries.'</div> </div>');
    }



    function echo_content() {
        $this->display_test();
    }

    function set_cdr_entries() {
        require(__DIR__."/../../lib/db_connect.php");
        $cdr_table = get_settings_value_from_tool("cdr_table", "cdrviewer");
        $sql = "select count(*) as no from ".$cdr_table;
        $stm = $link->prepare($sql);
        $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        $this->cdr_entries = $row[0]['no'];
    }

    function get_as_array() {
        return array($this->get_html(), $this->get_sizeX(), $this->get_sizeY());
    }

    public static function new_form($params = null) { 
        if (!$params['widget_name'])
            $params['widget_name'] = "CDR";
        form_generate_input_text("Name", "", "widget_name", null, $params['widget_name'], 20,null);
    }

}

?>