<?php

include_once 'mesurements_gents.php';

class directions_shirt extends details {
    
    public function fields($inserted=NULL){
        $shirt_selected = (object) json_decode($inserted);
        $table = '<strong style="text-align:center;">=======:: Shirt ::=======</strong>';
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
							  <td>ব্যক</td>
                          </tr>
						  
						
                                
                          <tr>
                              <td><input type="text" name="s_jul" class="form-control" value="'.$shirt_selected->shirt->jul.'"></td>
                              <td><input type="text" name="s_buk" class="form-control" value="'.$shirt_selected->shirt->buk.'"></td>
                              <td><input type="text" name="s_put" class="form-control" value="'.$shirt_selected->shirt->put.'"></td>
                              <td><input type="text" name="s_hata" class="form-control" value="'.$shirt_selected->shirt->hata.'"></td>
                              <td><input type="text" name="s_gola" class="form-control" value="'.$shirt_selected->shirt->gola.'"></td>
                              <td><input type="text" name="s_mohuri" class="form-control" value="'.$shirt_selected->shirt->mohuri.'"></td>
                              <td><input type="text" name="s_komor" class="form-control" value="'.$shirt_selected->shirt->komor.'"></td>
                              <td><input type="text" name="s_shamna" class="form-control" value="'.$shirt_selected->shirt->shamna.'"></td>
                              <td><input type="text" name="s_hip" class="form-control" value="'.$shirt_selected->shirt->hip.'"></td>
                              <td><input type="text" name="s_mohoda" class="form-control" value="'.$shirt_selected->shirt->mohoda.'"></td>
                              <td><input type="text" name="s_back" class="form-control" value="'.$shirt_selected->shirt->back.'"></td>
							  
							  
                          </tr>
                      </table>';
        return $table;
    }
    
    public function direction(){
        $directions_list = array(
            "cutting" => array(
							1=>"চাইনিজ শার্ট ", 
							2=>"হাফ ফ্লাইং শার্ট ", 
							3=>"হাফ চাইনিজ শার্ট", 
							4=>"Full ফ্লাইং শার্ট"
							),
			
		
			
            "pocket" => array(
							1=>"১ পকেট ", 
							2=>" ১।। পকেট", 
							3=>"2"
							),
            "clolor" => array(
							1=>"২। এ্যারো কলার ", 
							2=>" ২।। এ্যারো কলার",
							3=>" ২।।। এ্যারো কলার",
							4=>" ৩ এ্যারো কলার",
							5=>"৩।এ্যারো কলার"
							),
            "plate" => array(
							1=>"১।। সেলাই প্লেট", 
							2=>" ১।। সেলাই প্লেট  ভেতরে ভাজ", 
							3=>" ১। সেলাই প্লেট ", 
							4=>" ১। সেলাই প্লেট  ভেতরে ভাজ"
							),
            "shali" => array(
							1=>"ডাবল চাপ সেলাই",
							2=>" চাপ সেলাই", 
							3=>"সিমপিল সেলাই"
							),
			"loose" => array(
							1=>"১ লুজ",
							2=>"১।। লুজ", 
							3=>"১।।।  লুজ",
							4=>"২ লুজ"
							),
							
			"istekar" => array(
							1=>"বাদইস্টিকার হবে",
							2=>"বাদইস্টিকার বাদ", 
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
                        if($selected->shirt->$key == $k) {
                            $checked = 'Checked="checked"';
                            $active = 'active';
                        }
                        $string .= '<label class="btn btn-primary '.$active.'">
                                        <input type="radio" name="s_'.$key.'" '.$checked.' value="'.$k.'" autocomplete="off"> '.$val.'
                                      </label>';
                    }
                    $string .= "</div></td></tr>";
                }
                $string .= '</table>';
            return $string;
        }
}
