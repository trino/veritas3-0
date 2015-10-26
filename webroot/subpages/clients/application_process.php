<strong>Check documents to add in the application process</strong>

                                                

                                                <form action="" id="displayform7" method="post">
                                                    <table class="table table-light table-hover sortable2">
                                                        
                                                        <?php
                                                            //$subdoc = $this->requestAction('/clients/getSub');
                                                            $subdoccli = $this->requestAction('/clients/getSubCliApplication/' . $id);
                                                            $u = 0;
                                                            

                                                                foreach ($subdoccli as $subcl) {
                                                                    $u++;
                                                                    $sub = $this->requestAction('/clients/getFirstSub/' . $subcl->sub_id);
                                                                    if ($sub) {
                                                                        ?>
                                                                        <tr id="subd_<?php echo $sub->id; ?>"
                                                                            class="sublisting2">
                                                                            <td>

                            <span
                                id="sub_<?php echo $sub['id']; ?>"><?= ucfirst($sub[getFieldname('title', $language)]) . $Trans; ?></span>
                                                                            </td>

                                                                            <?php
                                                                                $csubdoc = $this->requestAction('/settings/all_settings/0/0/client/' . $id . '/' . $sub->id);
                                                                            ?>
                                                                            
                                                                            <td>
                                                                                <input <?php if ($csubdoc['display_application'] == 1) { ?> checked="checked" <?php } ?>
                                                                                    type="checkbox" id="check<?= $u ?>"
                                                                                    onclick="if($(this).is(':checked')){$(this).closest('td').find('.fororder').val('1');}else {$(this).closest('td').find('.fororder').val('0');}"/>
                                                                                <label for="check<?= $u ?>"><? $strings["clients_show"]; ?>:</label>

                                                                                <input class="fororder" type="hidden"
                                                                                       value="<?php if ($csubdoc['display_application'] == 1) {
                                                                                           echo '1';
                                                                                       } else { ?>0<?php } ?>"
                                                                                       name="clientO[<?php echo $sub->id; ?>]"/>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $u; ?>
                                                                            </td>
                                                                        </tr>

                                                                    <?php
                                                                    }
                                                                }
                                                            


                                                        ?>

                                                    </table>

                                                    <!--end profile-settings-->

                                                    <?php
                                                        if (!isset($disabled)) {
                                                            ?>

                                                            <div
                                                                class="margin-top-10 alert alert-success display-hide flash"
                                                                style="display: none;">
                                                                <button class="close" data-close="alert"></button>
                                                                <?= $strings["forms_datasaved"];?>
                                                            </div>

                                                            <div class="form-actions top chat-form"
                                                                 style="height:75px; margin-bottom:-1px;padding-right: 30px;margin-right: -10px;margin-left: -10px;"
                                                                 align="right">
                                                                <div class="row">
                                                                    <a href="javascript:void(0)" id="save_display7"
                                                                       class="btn btn-primary"  <?php echo $is_disabled ?>>
                                                                        <?= $strings["forms_savechanges"]; ?> </a>

                                                                </div>
                                                            </div>



                                                        <?php
                                                        }
                                                    ?>

                                                </form>
                                    