<?php
    if ($_SERVER['SERVER_NAME'] == 'localhost')
        echo "<span style ='color:red;'>subpages/documents/education_verification_form.php #INC142</span>";
?>
<div id="form_tab10">
    <input class="document_type" type="hidden" name="document_type" value="Education Verification"/>
    <input type="hidden" class="sub_docs_id" name="sub_doc_id" value="10"/>

    <div class="tab-content">
        <div class="tab-pane active" id="subtab_2_3">
            <form id="form_education">

                <?php

                    include_once 'subpages/filelist.php';
                    printdocumentinfo($did);
                    if (isset($sub4['att'])) {
                        listfiles($sub4['att'], "attachments/", "", false, 3);
                    }

                    $counter = 0;
                    if (isset($sub4['edu']) && count($sub4['edu'])) {
                        foreach ($sub4['edu'] as $emp) {
                            $counter++;
                            if ($counter != 1) {
                                if ($counter == 2) {
                                    ?>
                                    <div id="more_edu">
                                <?php
                                }
                                ?>
                                <div id="toremove">
                            <?php
                            }
                            ?>

                            <div class="form-group row">
                                <div class="col-md-9">
                                                        </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">School/College Name </label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="college_school_name[]"
                                           value="<?php echo $emp->college_school_name;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Address </label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address[]"
                                           value="<?php echo $emp->address;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Supervisor's Name</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="supervisior_name[]"
                                           value="<?php echo $emp->supervisior_name;?>"/>
                                </div>
                                <label class="control-label col-md-3">Phone #</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="supervisior_phone[]"
                                           value="<?php echo $emp->supervisior_phone;?>"/>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Supervisor's Email</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control email1" name="supervisior_email[]"
                                           value="<?php echo $emp->supervisior_email;?>"/>
                                </div>
                                <label class="control-label col-md-3">Secondary Email</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control email1" name="supervisior_secondary_email[]"
                                           value="<?php echo $emp->supervisior_secondary_email;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Education Start Date</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control date-picker" name="education_start_date[]"
                                           value="<?php echo $emp->education_start_date;?>"/>
                                </div>
                                <label class="control-label col-md-3">Education End Date</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control date-picker" name="education_end_date[]"
                                           value="<?php echo $emp->education_end_date;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Claims with this Tutor</label>

                                <div class="col-md-3">
                                    &nbsp;&nbsp;<input type="radio" name="claim_tutor[]" value="1"
                                                       <?php if ($emp->claim_tutor == '1'){ ?>checked="checked"<?php }?>/>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                                        type="radio" name="claim_tutor[]" value="0"
                                        <?php if ($emp->claim_tutor == '0'){ ?>checked="checked"<?php }?>/>&nbsp;&nbsp;&nbsp;&nbsp;No
                                </div>
                                <label class="control-label col-md-3">Date Claims Occured</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control date-picker" name="date_claims_occur[]"
                                           value="<?php echo $emp->date_claims_occur;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Education history confirmed by (Verifier Use
                                    Only):</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="education_history_confirmed_by[]"
                                           value="<?php echo $emp->education_history_confirmed_by;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-md-3 control-label">Highest grade completed : </label>

                                <div class="col-md-3">
                                    <select name="highest_grade_completed[]" class="form-control">
                                        <?php
                                            for ($i = 1; $i <= 8; $i++) {
                                                ?>
                                                <option value="<?php echo $i;?>"
                                                        <?php if ($emp->highest_grade_completed == $i){ ?>selected="selected"<?php }?> ><?php echo $i;?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-3 control-label">High School : </label>

                                <div class="col-md-3">
                                    <select name="high_school[]" class="form-control">
                                        <?php
                                            for ($i = 1; $i <= 4; $i++) {
                                                ?>
                                                <option value="<?php echo $i?>"
                                                        <?php if ($emp->high_school == $i){ ?>selected="selected"<?php }?>><?php echo $i;?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3 control-label">College : </label>

                                <div class="col-md-3">
                                    <select name="college[]" class="form-control">
                                        <?php
                                            for ($i = 1; $i <= 4; $i++) {
                                                ?>
                                                <option value="<?php echo $i?>"
                                                        <?php if ($emp->college == $i){ ?>selected="selected"<?php }?> ><?php echo $i;?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-3 control-label">Last School attended : </label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="last_school_attended[]"
                                           value="<?php echo $emp->last_school_attended;?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label">Date:</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control date-picker" name="date_time[]"
                                           value="<?php echo $emp->date_time;?>"/>
                                </div>

                                <label class="col-md-3 control-label" style="display: none;">Signature:</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" style="display: none;" name="signature[]"
                                           value="<?php echo $emp->signature;?>"/>
                                </div>


                            </div>
                            <div class="clearfix"></div>
                            <hr/>

                            <?php
                            if ($counter != 1) {
                                ?>
                                <div class="delete">
                                    <a href="javascript:void(0);" class="btn red" id="delete">Delete</a>
                                </div>
                                </div>

                                <?php
                                if ($counter == 2) {
                                    ?>
                                    </div>
                                <?php
                                }
                            }
                        }
                        if ($counter == 1) {
                            ?>
                            <div id="more_edu"></div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="form-group row">
                            <h4 class="control-label col-md-12">Past Education</h4>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">School/College Name : </label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="college_school_name[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Address : </label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="address[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Supervisor's Name : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="supervisior_name[]"/>
                            </div>
                            <label class="control-label col-md-3">Phone # : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="supervisior_phone[]"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label col-md-3">Supervisor's Email : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control email1" name="supervisior_email[]"/>
                            </div>
                            <label class="control-label col-md-3">Secondary Email : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control email1" name="supervisior_secondary_email[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Education Start Date : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="education_start_date[]"/>
                            </div>
                            <label class="control-label col-md-3">Education End Date : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="education_end_date[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Claims with this Tutor : </label>

                            <div class="col-md-3">
                                &nbsp;&nbsp;<input type="radio" name="claim_tutor[]" value="1"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                                    type="radio" name="claim_tutor[]" value="0"/>&nbsp;&nbsp;&nbsp;&nbsp;No
                            </div>
                            <label class="control-label col-md-3">Date Claims Occurred : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="date_claims_occur[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Education history confirmed by (Verifier Use Only)
                                : </label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="education_history_confirmed_by[]"/>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 control-label">Highest grade completed : </label>

                            <div class="col-md-3">
                                <select name="highest_grade_completed[]" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= 8; $i++) {
                                            ?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="col-md-3 control-label">High School
                                <small>(years attended)</small>
                                : </label>

                            <div class="col-md-3">
                                <select name="high_school[]" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= 4; $i++) {
                                            ?>
                                            <option value="<?php echo $i?>"><?php echo $i;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 control-label">College (years attended) : </label>

                            <div class="col-md-3">
                                <select name="college[]" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= 4; $i++) {
                                            ?>
                                            <option value="<?php echo $i?>"><?php echo $i;?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="col-md-3 control-label">Last School attended : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="last_school_attended[]"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 control-label">Date : </label>

                            <div class="col-md-3">
                                <input type="text" class="form-control date-picker" name="date_time[]"/>
                            </div>
                            <label class="col-md-3 control-label" style="display: none;">Signature:</label>

                            <div class="col-md-3">
                                <input type="text" class="form-control" style="display: none;" name="signature[]"/>
                            </div>

                        </div>
                        <div id="more_edu"></div>
                    <?php } ?>
                <div id="add_more_edu">
                    <p>&nbsp;</p>
                    <input type="hidden" name="count_more_edu" id="count_more_edu" value="1">
                    <a href="javascript:void(0);" class="btn green add_more_edu">Add More</a>
                </div>
                <?php
                    if (!isset($sub4['att']))
                        $sub4['att'] = array();
                    if (!count($sub4['att'])) {
                        ?>
                        <div class="form-group row" style="display:block;margin-top:5px; margin-bottom: 5px;">
                            <label class="control-label col-md-3">Attach File : </label>

                            <div class="col-md-9">
                                <input type="hidden" name="attach_doc[]" class="edu1"/>
                                <a href="javascript:void(0);" id="edu1" class="btn btn-primary">Browse</a> <span
                                    class="uploaded"></span>

                            </div>
                        </div>
                    <?php } ?>
                <div class="form-group row">
                    <div class="more_edu_doc"
                         data-edu="<?php if (count($sub4['att'])) echo count($sub4['att']); else echo '1'; ?>">
                        <?php
                            if (count($sub4['att']))//THIS SHOULD BE USING FILELIST.PHP!!!!!
                            {
                                $at = 0;
                                foreach ($sub4['att'] as $pa) {
                                    if($pa->attachment){
                                    $at++;
                                    ?>

                                    <div class="del_append_edu"><label class="control-label col-md-3"><?
                                                if ($at > 0 or $action == "add") {
                                                    echo "Attach File";
                                                }
                                            ?></label>

                                        <div class="col-md-6 pad_bot"><input type="hidden" class="edu<?php echo $at;?>"
                                                                             name="attach_doc[]"
                                                                             value="<?php echo $pa->attachment;?>"/><a
                                                href="#" id="edu<?php echo $at;?>" class="btn btn-primary">Browse</a>
                                            <?php if ($at > 1) { ?><a href="javascript:void(0);"
                                                                      class="btn btn-danger delete_edu_doc"
                                                                      onclick="$(this).parent().remove();">Delete</a><?php }?>
                                            <span
                                                class="uploaded"><?php echo $pa->attachment;?>  <?php if ($pa->attachment) {
                                                    $ext_arr = explode('.', $pa->attachment);
                                                    $ext = end($ext_arr);
                                                    $ext = strtolower($ext);
                                                    if (in_array($ext, $img_ext)) { ?><img
                                                        src="<?php echo $this->request->webroot; ?>attachments/<?php echo $pa->attachment; ?>"
                                                        style="max-width:120px;" /><?php } elseif (in_array($ext, $doc_ext)) { ?>
                                                        <a class="dl"
                                                           href="<?php echo $this->request->webroot; ?>attachments/<?php echo $pa->attachment; ?>">
                                                            Download</a><?php } else { ?><br/>
                                                        <video width="320" height="240" controls>
                                                            <source
                                                                src="<?php echo $this->request->webroot; ?>attachments/<?php echo $pa->attachment; ?>"
                                                                type="video/mp4">
                                                            <source
                                                                src="<?php echo $this->request->webroot; ?>attachments/<?php echo str_replace('.mp4', '.ogg', $pa->attachment); ?>"
                                                                type="video/ogg">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    <?php }
                                                }?></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <script>
                                        $(function () {
                                            fileUpload('edu<?php echo $at;?>');
                                        });
                                    </script>
                                <?php
                                }}
                            }
                        ?>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" name="count_more_edu_doc" id="count_more_edu_doc" value="1">
                        <a href="javascript:void(0);" class="btn btn-success moremore" id="add_more_edu_doc">Add
                            More</a>
                    </div>
                </div>

                <div class="clearfix"></div>

            </form>
            <script>
                $(function () {
                    <?php
                       if($this->request->params['action']=='addorder' || $this->request->params['action']=='add')
                       {
                           ?>
                    fileUpload('edu1');
                    <?php
                }
                ?>
                    //
                    $(".add_more_edu").click(function () {
                        $.ajax({
                            url: "<?php echo $this->request->webroot;?>subpages/documents/past_education.php",
                            success: function (res) {
                                $("#more_edu").append(res);
                                var current = $('#count_more_edu').val();
                                var counter = parseInt(current) + 1;

                                $('#count_more_edu').attr('value', counter);
                                $('.date-picker').datepicker({
                                    rtl: Metronic.isRTL(),
                                    orientation: "left",
                                    autoclose: true,
                                    format: 'yyyy-mm-dd'
                                });
                            }
                        });
                    });
                    $("#delete").live("click", function () {
                        $(this).parent().parent().remove();
                        var current = $('#count_more_edu').val();
                        var counter = parseInt(current) - 1;
                        $('#count_more_edu').attr('value', counter);
                    });

                    $('#add_more_edu_doc').click(function () {
                        var count = $('.more_edu_doc').data('edu');
                        $('.more_edu_doc').data('edu', parseInt(count) + 1);
                        $('.more_edu_doc').append('<div class="del_append_edu"><label class="control-label col-md-3"></label><div class="col-md-6 pad_bot"><input type="hidden" name="attach_doc[]" class="edu' + $('.more_edu_doc').data('edu') + '" /><a href="javascript:void(0);" id="edu' + $('.more_edu_doc').data('edu') + '" class="btn btn-primary">Browse</a> <a  href="javascript:void(0);" class="btn btn-danger delete_edu_doc">Delete</a> <span class="uploaded"></span></div></div><div class="clearfix"></div>');
                        fileUpload('edu' + $('.more_edu_doc').data('edu'));
                    });

                    $('.delete_edu_doc').live('click', function () {
                        var count = $('.more_edu_doc').data('edu');
                        $('.more_edu_doc').data(parseInt(count) - 1);
                        $(this).closest('.del_append_edu').remove();
                    });

                });
            </script>
        </div>
    </div>
</div>