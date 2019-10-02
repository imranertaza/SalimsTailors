<?php

//use details;

include_once 'mesurements_gents.php';

class directions_pant extends details {
    
    public function fields($inserted=NULL){
        $pant_selected = (object) json_decode($inserted);
        $table = '<strong style="text-align:center;">=======:: Pant ::=======</strong>';
        $table .= '<table class="table table-bordered table-striped">
                          <tr>
                              <td>ঝুল</td>
                              <td>মহুরী</td>
                              <td>কোমর</td>
                              <td>সামনা</td>
                              <td>ব্যক</td>
                              <td>হাটু</td>
                              <td>হিপ</td>
                              <td>থাই</td>
                              <td>হাই</td>
                          </tr>
                          <tr>
                              <td><input type="text" name="p_jul" class="form-control" value="'.$pant_selected->pant->jul.'"></td>
                              <td><input type="text" name="p_mohuri" class="form-control" value="'.$pant_selected->pant->mohuri.'"></td>
                              <td><input type="text" name="p_komor" class="form-control" value="'.$pant_selected->pant->komor.'"></td>
                              <td><input type="text" name="p_shamna" class="form-control" value="'.$pant_selected->pant->shamna.'"></td>
                              <td><input type="text" name="p_back" class="form-control" value="'.$pant_selected->pant->back.'"></td>
                              <td><input type="text" name="p_hatu" class="form-control" value="'.$pant_selected->pant->hatu.'"></td>
                              <td><input type="text" name="p_hip" class="form-control" value="'.$pant_selected->pant->hip.'"></td>
                              <td><input type="text" name="p_thai" class="form-control" value="'.$pant_selected->pant->thai.'"></td>
                              <td><input type="text" name="p_high" class="form-control" value="'.$pant_selected->pant->high.'"></td>
                          </tr>
                      </table>';
        return $table;
    }
 
    public function direction(){
        $directions_list = array(
            "pocket" => array(
                            1=>"ক্রস পকেট বিট ",
                            2=>"সাইড পকেট",
                        ),
            "hip_pocket" => array(
                            1=>"১ হিপ",
                            2=>"২ হিপ",
                            3=>"১ হিপ সিঙ্গেল বন",
                            4=>"২ হিপ সিঙ্গেল বন",
                            5=>"১ হিপ সিঙ্গেল বন ঘাট বোতাম",
                            6=>"২ হিপ সিঙ্গেল বন বোতাম",
                        ),
            "taken" => array(
                            1 => "ডাবল টেকিইন",
                            2 => "এস্ট্রেট কাটিং",
                        ),
            "shamna_down" => array(
                            1 => "সামনা ডউন হবে",
                            2 => "সামনা ডউন না",
                            3 => "সামনা ডউন হালকা",
                        ),
            "back_shape" => array(
                            1 => "ব্যাক সেফ হবে",
                            2 => "ব্যাক সেফ না",
                            3 => "ব্যাক সেফ হালকা",
                        ),
			"mobile_pocket" => array(
                            1 => "মোবাইল পকেট হবে ",
                            2 => "মোবাইল পকেট হবে না",
                            
                        ),
			"folding" => array(
                            1 => "ফোল্ডীং হবে",
                            2 => "ফোল্ডীং হবে না",
                            
                        ),
			"shaliy" => array(
                            1 => "ম্যাচ সেলাই",
                            2 => "চাপ সেলাই",
                            
                        ),
			"sticker" => array(
                            1 => "হবে",
                            2 => "হবে না",
                            
                        ),
			"cuting" => array(
                            1 => "ন্যারো কাটিং",
                            2 => "সেমিন্যারো",
                            3 => "লুজ ফিটিং",
                        ),
        );
        return $directions_list;
    }
    
    public function direction_html($inserted=NULL){
                $selected = (object) json_decode($inserted);
                $directions = $this->direction();
                $string = '<table class="table table-bordered table-striped">';
                foreach($directions as $key=>$options) {
                    $string .= '<tr><td width="20%"><b>'.ucwords(str_replace("_", " ", $key)).' : </b></td>';
                    $string .= '<td width="80%"><div class="btn-group" data-toggle="buttons">';
                    foreach($options as $k=>$val){
                        $checked = $active = NULL;
                        if($selected->pant->$key == $k) {
                            $checked = 'Checked="checked"';
                            $active = 'active';
                        }
                        $string .= '<label class="btn btn-primary '.$active.'">
                                        <input type="radio" name="p_'.$key.'" '.$checked.' value="'.$k.'" autocomplete="off"> '.$val.'
                                      </label>';
                    }
                    $string .= "</div></td></tr>";
                }
                $string .= '</table>';
            return $string;
        }

}
