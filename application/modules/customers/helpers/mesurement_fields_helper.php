<?php
function selecting_notice_table(){
    $table = '<table class="table table-bordered table-striped">
                          <tr>
                              <td>Please select any type...</td>
                          </tr>
                          </table>';
    return $table;
}



/*function pant_direction(){
    $directions_list = array(
        "Pocket" => array("X", "Side"),
        "Hip" => array("1", "2"),
        "Cutting" => array("Double taken", "State"),
        "Shamna Down" => array("Yes", "No", "Halka"),
        "Back Sheap" => array("Yes","No", "Halka"),
    );
    return $directions_list;
}
    
function pant_direction_html(){
            $string = NULL;
            $directions = pant_direction();
            foreach($directions as $key=>$options) {
                $string .= "<b>".$key." : </b>";
                foreach($options as $k=>$val){
                    $string .= '<input type="radio" name="'.$key.'" value="'.$k.'"> '.$val.' ';
                }
                $string .= "</br>";
            }
        return $string;
    }*/