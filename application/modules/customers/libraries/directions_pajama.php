<?php

include_once 'mesurements_gents.php';

class directions_pajama extends details{
    
    public function fields($inserted=NULL){
        $pajama_selected = (object) json_decode($inserted);
        $table = '<strong style="text-align:center;">=======:: Pajama ::=======</strong>';
        $table .= '<table class="table table-bordered table-striped">
                          <tr>
                              <td>ঝুল</td>
                              <td>মহুরী</td>
                              <td>কোমর</td>
                              <td>হিপ</td>
                              <td>থাই</td>
                              <td>হাই</td>
                          </tr>
                          <tr>
                              <td><input type="text" name="pj_jul" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                              <td><input type="text" name="pj_mohuri" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                              <td><input type="text" name="pj_komor" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                              <td><input type="text" name="pj_hip" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                              <td><input type="text" name="pj_thai" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                              <td><input type="text" name="pj_high" class="form-control" value="'.$pajama_selected->pajama->jul.'"></td>
                          </tr>
                      </table>';
        return $table;
    }
    
    public function direction(){
        $directions_list = array(
            "pocket" => array(
							1=>"ক্রস পকেট বিট ",
							2=>"সাইড পকেট"
							),
            "hip" => array(
							1=>"1", 
							2=>"2"
							),		
            "cuting" => array(
							1=>"প্যান্ট কাটিং", 
							2=>"সিম্পল কাটিং"
							),							
            "bon" => array(
							1=>"কোমরে রাবার ও বন হবে ", 
							2=>"কোমরে রাবার ও বন হবে না"
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
                        if($selected->pajama->$key == $k) {
                            $checked = 'Checked="checked"';
                            $active = 'active';
                        }
                        $string .= '<label class="btn btn-primary '.$active.'">
                                        <input type="radio" name="pj_'.$key.'" '.$checked.' value="'.$k.'" autocomplete="off"> '.$val.'
                                      </label>';
                    }
                    $string .= "</div></td></tr>";
                }
                $string .= '</table>';
            return $string;
        }
}
