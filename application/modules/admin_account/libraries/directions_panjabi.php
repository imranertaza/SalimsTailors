<?php

include_once 'mesurements_gents.php';

class directions_panjabi extends details {
    
    public function fields($inserted=NULL){
        $panjabi_selected = (object) json_decode($inserted);
        $table = '<strong style="text-align:center;">=======:: PanJabi ::=======</strong>';
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
                              <td>হিপ</td>
                              <td>মহড়া</td>
                          </tr>
                          <tr>
                              <td><input type="text" name="pa_jul" class="form-control" value="'.$panjabi_selected->panjabi->jul.'"></td>
                              <td><input type="text" name="pa_buk" class="form-control" value="'.$panjabi_selected->panjabi->buk.'"></td>
                              <td><input type="text" name="pa_put" class="form-control" value="'.$panjabi_selected->panjabi->put.'"></td>
                              <td><input type="text" name="pa_hata" class="form-control" value="'.$panjabi_selected->panjabi->hata.'"></td>
                              <td><input type="text" name="pa_gola" class="form-control" value="'.$panjabi_selected->panjabi->gola.'"></td>
                              <td><input type="text" name="pa_mohuri" class="form-control" value="'.$panjabi_selected->panjabi->mohuri.'"></td>
                              <td><input type="text" name="pa_komor" class="form-control" value="'.$panjabi_selected->panjabi->komor.'"></td>
                              <td><input type="text" name="pa_shamna" class="form-control" value="'.$panjabi_selected->panjabi->shamna.'"></td>
                              <td><input type="text" name="pa_hip" class="form-control" value="'.$panjabi_selected->panjabi->hip.'"></td>
                              <td><input type="text" name="pa_mohora" class="form-control" value="'.$panjabi_selected->panjabi->mohora.'"></td>
                          </tr>
                      </table>';
        return $table;
    }

    
    public function direction(){
        $directions_list = array(
            "panjabi_style" => array(
								1=>"একছাটা পাঞ্জাবীহ", 
								2=>"কলিদার পঞ্জাবী"
								),
            "design" => array(
								1=>"হাতা ও প্লেটে পাইপিন ", 
								2=>"ডিজাইন হবে না"
								),
            "loose" => array(
								1=>"২। এ্যারো কলার ", 
								2=>"২।। এ্যারো কলার",
								3=>" ২।।। এ্যারো কলার",
								4=>" ৩ এ্যারো কলার",
								5=>"৩।এ্যারো কলার"
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
                        if($selected->panjabi->$key == $k) {
                            $checked = 'Checked="checked"';
                            $active = 'active';
                        }
                        $string .= '<label class="btn btn-primary '.$active.'">
                                        <input type="radio" name="pa_'.$key.'" '.$checked.' value="'.$k.'" autocomplete="off"> '.$val.'
                                      </label>';
                    }
                    $string .= "</div></td></tr>";
                }
                $string .= '</table>';
            return $string;
        }
}
