<?php

include_once 'mesurements_gents.php';

class directions_suit extends details {
    
    public function fields($inserted=NULL){
        $suit_selected = (object) json_decode($inserted);
        $table = '<strong style="text-align:center;">=======:: Suit Court ::=======</strong>';
        $table .= '<table class="table table-bordered table-striped">
                          <tr>
                              <td>ঝুল </td>
                              <td>বুক</td>
                              <td>পুট</td>
                              <td>হাতা</td>
                              <td>গলা</td>
                              <td>মহুরী</td>
                              <td>কোমর</td>
                              <td>সামনা</td>
                              <td>সেস্ত্য</td>
                              <td>ব্যক</td>
                              <td>হিপ</td>
                          </tr>
                          <tr>
                              <td><input type="text" name="su_jul" class="form-control" value="'.$suit_selected->suit->jul.'"></td>
                              <td><input type="text" name="su_buk" class="form-control" value="'.$suit_selected->suit->buk.'"></td>
                              <td><input type="text" name="su_put" class="form-control" value="'.$suit_selected->suit->put.'"></td>
                              <td><input type="text" name="su_hata" class="form-control" value="'.$suit_selected->suit->hata.'"></td>
                              <td><input type="text" name="su_gola" class="form-control" value="'.$suit_selected->suit->gola.'"></td>
                              <td><input type="text" name="su_mohuri" class="form-control" value="'.$suit_selected->suit->mohuri.'"></td>
                              <td><input type="text" name="su_komor" class="form-control" value="'.$suit_selected->suit->komor.'"></td>
                              <td><input type="text" name="su_shamna" class="form-control" value="'.$suit_selected->suit->shamna.'"></td>
                              <td><input type="text" name="su_shesth" class="form-control" value="'.$suit_selected->suit->sheste.'"></td>
                              <td><input type="text" name="su_back" class="form-control" value="'.$suit_selected->suit->back.'"></td>
                              <td><input type="text" name="su_hip" class="form-control" value="'.$suit_selected->suit->hip.'"></td>
                          </tr>
                      </table>';
        return $table;
    }
    
    
    public function direction(){
        $directions_list = array(
            "suit_style" => array(
							1=>"সিঙ্গেল ব্রেস কোট ", 
							2=>"ডবল ব্রেস কোট",
							3=>"শার্ট কলার কোট",
							4=>"্রন্স কোট"
							),
            "button" => array(
							1=>"১ বোতাম", 
							2=>" ২ বোতাম",
							3=>" ৩ বোতাম",
							4=>" ৪ বোতাম"),
            "round" => array(
							1=>"নিচে রাউন্ড", 
							2=>" নিচে সোজা"
							),
            "hand_but" => array(
							1=>"হাতাই ৩ বোতাম", 
							2=>"হাতাই ৪ বোতাম"
							),
            "side_open" => array(
							1=>"সাইড ওপেন হবে ",
							2=>"সাইড ওপেন হবে না"
							),
            "fiting" => array("ন্যারো কোট","ফিটিং কোট", "মিডিয়াম ফিটিং","লুজ ফিটিং"),				
            
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
                        if($selected->suit->$key == $k) {
                            $checked = 'Checked="checked"';
                            $active = 'active';
                        }
                        $string .= '<label class="btn btn-primary '.$active.'">
                                        <input type="radio" name="su_'.$key.'" '.$checked.' value="'.$k.'" autocomplete="off"> '.$val.'
                                      </label>';
                    }
                    $string .= "</div></td></tr>";
                }
                $string .= '</table>';
            return $string;
        }
}
