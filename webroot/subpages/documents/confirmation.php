<?php
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        echo "<span style ='color:red;'>subpages/documents/confirmation.php #INC138</span>";
    }
    $forms = '';
    if (isset($_GET['forms'])) {
        $forms = $_GET['forms'];
    }
    else
        $forms = $this->requestAction('/orders/getProNum');

    $allattachments = array();// new AppendIterator;
    if (isset($pre_at['attach_doc'])) {
        $allattachments = merge($allattachments, $pre_at['attach_doc']);
    }
    if (isset($sub['da_at'])) {
        $allattachments = merge($allattachments, $sub['da_at']);
    }
    if (isset($sub['de_at'])) {
        $allattachments = merge($allattachments, $sub['de_at']);
    }
    if (isset($sub2['con_at'])) {
        $allattachments = merge($allattachments, $sub2['con_at']);
    }
    if (isset($sub3['att'])) {
        $allattachments = merge($allattachments, $sub3['att']);
    }
    if (isset($sub4['att'])) {
        $allattachments = merge($allattachments, $sub4['att']);
    }

    function merge($dest, $src)
    {
        foreach ($src as $item) {
            $dest[] = $item;
        }
        return $dest;
        //if (is_object($src)) { $dest->append($src); }
        //if (is_array($src)) { $dest = array_merge($dest, $src); }
        //return dest;
    }

    
        $forms_arr = explode(',', $forms);
    
    $p = $forms_arr;
?>
<div class="note note-success">
    <h3 class="block col-md-12">MEE Order Confirmation</h3>

    <div class="clearfix"></div>
</div>

<input type="hidden" id="confirmation" value="1"/>


<div class="row col-md-6">

    <div class="form-group">
        <label class="control-label col-md-12">Recruiter Name : </label>

        <div class="col-md-12">
            <input disabled="disabled" type="text" class="form-control" name="conf_recruiter_name"
                   id="conf_recruiter_name"
                   value="<?php if (isset($modal->conf_recruiter_name)) echo $modal->conf_recruiter_name; else echo $this->request->session()->read('Profile.fname') . ' ' . $this->request->session()->read('Profile.lname'); ?>"/>
        </div>


        <label class="control-label col-md-12" style="margin-top: 5px;">Driver Name : </label>

        <div class="col-md-12">
            <input type="text" class="form-control" name="conf_driver_name" id="conf_driver_name"
                   value="<?php if (isset($modal->conf_driver_name)) echo $modal->conf_driver_name; ?>"/>
        </div>


        <label class="control-label col-md-12" style="margin-top: 5px;">Date : </label>

        <div class="col-md-12">
            <input disabled="disabled" type="text" class="form-control date-picker" name="conf_date" id="conf_date"
                   value="<?php if (isset($modal->conf_date)) echo $modal->conf_date; else {
                       echo date('Y-m-d');
                   } ?>"/>
        </div>
    </div>
    <p>&nbsp;</p>

    <div class="col-md-12"><label>Products Selected :</label>

        <div class="clearfix"></div>

        <?php
            $lineclass = "even";//set to "" for old list, even or odd to table


            if ($lineclass == "") {
            } else {
                echo '<table class="table" style="margin-bottom: 0px;"><tbody>';
            }

            function PrintLine($lineclass, $name, $id, $cnt)
            {
                if ($cnt) {
                    $check = "<input ";
                    if ($cnt) {
                        $check .= 'checked ';
                    }
                    $check .= 'disabled="disabled" type="checkbox" name="' . $id . '" value=""/>';

                    if ($lineclass == "") {
                        echo '<li><div class="col-md-10"><i class="fa fa-file-text-o"></i> ' . $name . '</div><div class="col-md-2">';
                        echo $check . '</div><div class="clearfix"></div></li>';
                        return "";
                    }

                    echo '<tr class="' . $lineclass . '" role="row"><td width="45"><i class="fa fa-file-text-o"></i></td>';
                    echo '<td>' . $name . '</td><td>' . $check . '</td></tr>';
                    if ($lineclass == "even") {
                        return "odd";
                    } else {
                        return "even";
                    }
                }
                return $lineclass;
            }

            if ($p) {
                foreach ($p as $pp) {
                    $title = $this->requestAction('/orders/getProductTitle/' . $pp);
                    if (is_object($title)) {
                        $lineclass = PrintLine($lineclass, $title->title, "prem_nat", $pp);
                    }
                }
            }
            if ($lineclass == "") {
                // echo '</ul>';
            } else {
                echo '<TR><TD colspan="3"></TD></TR></tbody></table>';
            }

        ?>

    </div>
</div>

<div class="row col-md-6">
    <div class="form-group">

        <label class="control-label col-md-12">Please sign here to confirm your submission :</label>
        <input type="hidden" name="recruiter_signature" id="recruiter_signature"
               value="<?php if (isset($modal->recruiter_signature) && $modal->recruiter_signature) echo $modal->recruiter_signature; ?>"/>

        <?php
            include('canvas/confirmation_signature.php');
        ?>

    </div>
</div>


<div class="clearfix"></div>


<!-- DONT REMOVE / USED FOR WEBSERVICE .... DO NOT CHANGE THE STRUCTURE OF DIV INSIDE NOT EVEN AN ENTER-->
<div class="attachments_all" style="display: none;">
    <?php //THIS SHOULD BE USING FILELIST.PHP!!!!!

        function listattachments($name, $array)
        {
            echo '<div class="' . $name . '">';
            $c1 = 0;
            foreach ($array as $pat) {
                $c1++;
                if ($c1 == 1) {
                    echo $pat->attachment;
                } else {
                    echo ',' . $pat->attachment;
                }
            }
            echo '</div>';
        }

        if (isset($pre_at['attach_doc'])) {
            listattachments("pre", $pre_at['attach_doc']);
        }
        if (isset($sub['da_at'])) {
            listattachments("da", $sub['da_at']);
        }
        if (isset($sub['de_at'])) {
            listattachments("de", $sub['de_at']);
        }
        if (isset($sub2['con_at'])) {
            listattachments("con", $sub2['con_at']);
        }
        if (isset($sub3['att'])) {
            listattachments("emp", $sub3['att']);
        }
        if (isset($sub4['att'])) {
            listattachments("edu", $sub4['att']);
        }
    ?>
</div>


<script>
    $(function () {
        <?php if($this->request->params['action'] != 'vieworder'  && $this->request->params['action']!= 'view'){?>
        $("#test1").jqScribble();
        <?php }?>
    });

    function addImage() {
        var img = prompt("Enter the URL of the image.");
        if (img !== '')$("#test").data("jqScribble").update({backgroundImage: img});
    }
</script>