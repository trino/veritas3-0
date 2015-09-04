<?php
    if (isset($profiles) && $profiles >0) {
        echo $msg . "<br/>";
    } else {
        echo "No re-qualifications found for this day (" . date('Y-m-d') . ")";
    }
?>


        <?php  if(isset($profiles) && $profiles> 0){

            foreach($arrs as $arr){
                
            $forms = $arr['forms'];
            $driver = $arr['driver'];
            echo $orders = $arr['order_id'];
            
            $driv = explode(',',$driver);
            $ord = explode(',',$orders);
            for($k=0;$k<count($driv);$k++)
            {
                //echo LOGIN.'orders/webservice/REQ/'.$forms.'/'.$driv[$k].'/'.$ord[$k];
                $ch = file_get_contents(LOGIN.'orders/webservice/REQ/'.$forms.'/'.$driv[$k].'/'.$ord[$k]);
               /*$ch = curl_init(LOGIN.'orders/webservice/REQ/'.$forms.'/'.$driv[$k].'/'.$ord[$k]);
               curl_exec($ch) or die('here');
               unset($ch);*/
               //var_dump($ch);
               
               
               
            }
        }
        }
        ?>

   