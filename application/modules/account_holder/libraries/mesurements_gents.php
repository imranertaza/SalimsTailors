<?php

abstract class details {
    
    public function details_array(){
        $details = array(
                        "pant" => array(
                            "jul" => "",
                            "mohuri" => "",
                            "komor" => "",
                            "shamna" => "",
                            "back" => "",
                            "hip" => "",
                            "thai" => "",
                            "high" => "",
                            "hatu" => "",				
                            "pocket" => "1",		
                            "hip_pocket" => "1",
                            "taken" => "1",
                            "shamna_down" => "3",
                            "back_shape" => "3",
                            "mobile_pocket" => "2",
                            "folding" => "2",
                            "shaliy" => "2",
                            "sticker" => "2",
                            "cuting" => "2",
                        ),
                        "shirt" => array(
                                "jul" => "",
								"buk" => "",
                                "put" => "",
                                "hata" => "",
                                "gola" => "",
                                "mohuri" => "",
                                "komor" => "",
                                "shamna" => "",
                                "back" => "",
                                "mohoda" => "",
                                "hip" => "",
                                "cutting" => "1",
                                "pocket" => "2",
                                "clolor" => "5",
                                "plate" => "2",					
                                "shali" => "1",
                                "loose" => "2",
                                "istekar" => "1",			
                            ),
                        "suit" => array(
                                "jul" => "",
                                "buk" => "",
                                "put" => "",
                                "hata" => "",
                                "gola" => "",
                                "mohuri" => "",
                                "komor" => "",
                                "mohora" => "",
                                "shamna" => "",
                                "back" => "",
                                "sheste" => "",
                                "hip" => "",
                                "suit_style" => "1",
                                "button" => "2",
                                "round" => "1",
                                "hand_but" => "1",
                                "side_open" => "2",					
                                "fiting" => "1",								
                                
                                
                        ),
                        "panjabi" => array(
                                "jul" => "",
                                "buk" => "",
                                "put" => "",
                                "hata" => "",
                                "gola" => "",
                                "mohuri" => "",
                                "komor" => "",
                                "shamna" => "",
                                "mohora" => "",
                                "hip" => "",
                                "panjabi_style" => "1",
                                "design" => "2",
                                "loose" => "3",
                        ),
                        "pajama" => array(
                            "jul" => "",
                            "mohuri" => "",
                            "komor" => "",
                            "hip" => "",
                            "thai" => "",
                            "high" => "",
                            "hatu" => "",							
                            "pocket" => "2",							
                            "hip" => "1",                   					
                            "cuting" => "1",
                            "bon" => "1",
                            
                        ),
                    );
        return $details;
    }
         
    public function direction_json(){
        $json = json_encode($this->details_array());
        return $json;
    }
        
}
