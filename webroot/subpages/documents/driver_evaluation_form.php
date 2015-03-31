<?php
 if($_SERVER['SERVER_NAME'] =='localhost'){ echo "<span style ='color:red;'>subpages/documents/driver_evaluation_form.php #INC141</span>"; }
include_once 'subpages/filelist.php';
printdocumentinfo($did);
if( isset($sub['de_at'])){  listfiles($sub['de_at'], "attachments/", "", false,3); }
 ?>
<form id="form_tab3">
<input class="document_type" type="hidden" name="document_type" value="Road test" />

<input type="hidden" class="sub_docs_id" name="sub_doc_id" value="3" id="af" />
<div class="clearfix"></div>
<hr />
                                                <div class="form-group row">
													<label class="control-label col-md-3">Driver name <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<input type="text" class="form-control" name="driver_name"/>
														
													</div>
												</div>
												<div class="form-group row">
													<label class="control-label col-md-3">D/L# <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control" name="d_l"/>
														
													</div>
												</div>
												<div class="form-group row">
													<label class="control-label col-md-3">Date <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<input type="text" placeholder="" class="form-control date-picker" name="issued_date"/>
														
													</div>
												</div>
												<div class="form-group row">
													<label class="control-label col-md-3">Transmission <span class="required">
													* </span>
													</label>
													<div class="col-md-9">
                                                        <div class="checkbox-list col-md-3 nopad">
															<label>
															<input type="checkbox" id="transmission_manual_shift_1" name="transmission_manual_shift" value="1"/> Manual Shift </label></div><div class="checkbox-list col-md-3 nopad">
															<label>
															<input type="checkbox" id="transmission_auto_shift_2" name="transmission_auto_shift" value="2"/> Auto Shift </label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group row">
													<label class="control-label col-md-3">Name of evaluator <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
                                                        <?php
                                                            $value="";
                                                            if(!$did){
                                                                $value = $this->request->session()->read('Profile.fname').' '.$this->request->session()->read('Profile.mname').' '.$this->request->session()->read('Profile.lname');
                                                            }
                                                        ?>

														<input type="text" placeholder="" class="form-control" name="name_evaluator" value="<?= $value; ?>" <?php if(strlen($value)>1) { echo " disabled"; }?> />
													</div>
												</div>
                                                
                                                <div class="form-group row">
													<label class="control-label col-md-3">Select <span class="required">
													* </span>
													</label>
													<div class="col-md-9">
														<div class="checkbox-list col-md-3 nopad">
															<label>
															<input type="checkbox" name="pre_hire" value="1"/> Pre Hire </label>
															<label>
															<input type="checkbox" name="post_accident" value="2"/> Post Accident </label>
														</div>
														<div class="checkbox-list col-md-3 nopad">
															<label>
															<input type="checkbox" name="post_injury" value="1"/> Post Injury </label>
															<label>
															<input type="checkbox" name="post_training" value="2"/> Post Training </label>
														</div>
                                                        <div class="checkbox-list col-md-3 nopad">
															<label>
															<input type="checkbox" name="annual" value="1"/> Annual </label>
															<label>
															<input type="checkbox" name="skill_verification" value="2"/> Skill Verification </label>
														</div>
													</div>
												</div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                <div class="scores">
                                                    <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption"><strong>Pre-trip Inspection:</strong> Fails to check the following</div>
                                                            </div>
                                                            
                                                            <div class="portlet-body" id="firstcheck">
                                                                <div class="col-md-6 checkbox-list">
                                                                    <label>
        															<input type="checkbox" name="fuel_tank" value="1" /> Fuel tank </label>
        															<label>
        															<input type="checkbox" name="all_gauges" value="1" /> All Gauges </label>
                                                                    <label>
        															<input type="checkbox" name="audible_air" value="1" /> Audible Air Leaks </label>
        															<label>
        															<input type="checkbox" name="wheels_tires" value="1" /> Wheels Tires </label>
                                                                    <label>
        															<input type="checkbox" name="trailer_brakes" value="1" /> Trailer Brakes </label>
                                                                    <label>
        															<input type="checkbox" name="trailer_airlines" value="1" /> Trailer Airlines </label>
                                                                    <label>
        															<input type="checkbox" name="inspect_5th_wheel" value="1" /> Inspect 5th Wheel </label>
                                                                    <label>
        															<input type="checkbox" name="cold_check" value="1" /> Cold Check </label>

                                                                    <label>
        															<input type="checkbox" class="1" name="seat_mirror" value="1" /> Seat and Mirror set up </label></div>
                                                                <div class="col-md-6">
        															<label>
        															<input type="checkbox" class="1" name="coupling" value="1" /> Coupling&nbsp; &nbsp; &nbsp; &nbsp;</label>

        															<label>
        															<input type="checkbox" class="1" name="lights_abs_lamps" value="1" /> Lights/ABS Lamps </label>
                                                                    <label>
        															<input type="checkbox" class="1" name="annual_inspection_strickers" value="1" /> Annual Inspection Stickers </label>
                                                                    <label>
        															<input type="checkbox" class="1" name="cab_air_brake_checked" value="1" /> In cab air brake checks </label>
                                                                    <label>
        															<input type="checkbox" class="1" name="landing_gear" value="1" /> Landing Gear </label>
                                                                    <label>
        															<input type="checkbox" class="1" name="emergency_exit" value="1" /> Emergency exit </label>
                                                                    <label>
                                                                        <input type="checkbox" class="1" name="paperwork" value="1" /> Paperwork </label>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <input class="form-control" type="hidden" name="total1" id="total1" <?php if(!$did){?>value="0"<?php }?> />
                                                            </div>
                                                        </div>

                                                            <div class="portlet box blue">
                                                                <div class="portlet-title">
                                                                    <div class="caption"><strong>Cornering:</strong></div>
                                                                </div>

                                                                <div class="portlet-body">
                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Signaling: not used / late / not cancelled
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_signaling_1" name="cornering_signaling" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_signaling_2" name="cornering_signaling" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_signaling_3" name="cornering_signaling" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_signaling_4" name="cornering_signaling" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Speed:  too fast / too slow/momentum
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_speed_1" name="cornering_speed" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_speed_2" name="cornering_speed" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_speed_3" name="cornering_speed" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_speed_4" name="cornering_speed" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Fails to get into proper:   lane / late / position
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_fails_1" name="cornering_fails" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_fails_2" name="cornering_fails" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_fails_3" name="cornering_fails" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_fails_4" name="cornering_fails" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Proper set up for turn
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_proper_set_up_turn_1" name="cornering_proper_set_up_turn" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_proper_set_up_turn_2" name="cornering_proper_set_up_turn" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_proper_set_up_turn_3" name="cornering_proper_set_up_turn" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_proper_set_up_turn_4" name="cornering_proper_set_up_turn" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Turns too: wide / cuts corner / jumps curb
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_turns_1" name="cornering_turns" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_turns_2" name="cornering_turns" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_turns_3" name="cornering_turns" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_turns_4" name="cornering_turns" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div>
                                                                        <div class="col-md-12">
                                                                            Use of wrong lane / impede traffic
                                                                        </div>
                                                                        <div class="col-md-12 radio-list">
                                                                            <label class="radio-inline">
                                                                                2<input type="radio" class="2" id="cornering_wrong_lane_impede_1" name="cornering_wrong_lane_impede" value="1"/></label>
                                                                            <label class="radio-inline">
                                                                                4<input type="radio" class="4" id="cornering_wrong_lane_impede_2" name="cornering_wrong_lane_impede" value="2"/></label>
                                                                            <label class="radio-inline">
                                                                                6<input type="radio" class="6" id="cornering_wrong_lane_impede_3" name="cornering_wrong_lane_impede" value="3"/></label>
                                                                            <label class="radio-inline">
                                                                                8<input type="radio" class="8" id="cornering_wrong_lane_impede_4" name="cornering_wrong_lane_impede" value="4"/></label>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption"><strong>Shifting:</strong> Fails to perform the following</div>
                                                            </div>

                                                            <div class="portlet-body">
                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Smooth take off's
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="shifting_smooth_take_off_1" name="shifting_smooth_take_off" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="shifting_smooth_take_off_2" name="shifting_smooth_take_off" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                            3<input type="radio" class="3" id="shifting_smooth_take_off_3" name="shifting_smooth_take_off" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                            4<input type="radio" class="4" id="shifting_smooth_take_off_4" name="shifting_smooth_take_off" value="4"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Proper gear selection
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="shifting_proper_gear_selection_1" name="shifting_proper_gear_selection" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="shifting_proper_gear_selection_2" name="shifting_proper_gear_selection" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                            3<input type="radio" class="3" id="shifting_proper_gear_selection_3" name="shifting_proper_gear_selection" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                            4<input type="radio" class="4" id="shifting_proper_gear_selection_4" name="shifting_proper_gear_selection" value="4"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Proper clutching
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="shifting_proper_clutching_1" name="shifting_proper_clutching" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="shifting_proper_clutching_2" name="shifting_proper_clutching" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                            3<input type="radio" class="3" id="shifting_proper_clutching_3" name="shifting_proper_clutching" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                            4<input type="radio" class="4" id="shifting_proper_clutching_4" name="shifting_proper_clutching" value="4"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Gear recovery
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="shifting_gear_recovery_1" name="shifting_gear_recovery" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="shifting_gear_recovery_2" name="shifting_gear_recovery" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                            3<input type="radio" class="3" id="shifting_gear_recovery_3" name="shifting_gear_recovery" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                            4<input type="radio" class="4" id="shifting_gear_recovery_4" name="shifting_gear_recovery" value="4"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Up/down shifting
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="shifting_up_down_1" name="shifting_up_down" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="shifting_up_down_2" name="shifting_up_down" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                            3<input type="radio" class="3" id="shifting_up_down_3" name="shifting_up_down" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                            4<input type="radio" class="4" id="shifting_up_down_4" name="shifting_up_down" value="4"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption"><strong>Driving:</strong></div>
                                                            </div>
                                                            
                                                            <div class="portlet-body" id="secondcheck">
                                                                <div>
                                                                    <div class="col-md-12">
            															Follows too closely 
                                                                    </div>
                                                                        <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">2<input type="radio" class="2" id="driving_follows_too_closely_1" name="driving_follows_too_closely" value="1"/></label>
                                                                        <label class="radio-inline">4<input type="radio" class="4" id="driving_follows_too_closely_2" name="driving_follows_too_closely" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_follows_too_closely_3" name="driving_follows_too_closely" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_follows_too_closely_4" name="driving_follows_too_closely" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div> 
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Improper choice of Lane 
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_improper_choice_lane_1" name="driving_improper_choice_lane" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_improper_choice_lane_2" name="driving_improper_choice_lane" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_improper_choice_lane_3" name="driving_improper_choice_lane" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_improper_choice_lane_4" name="driving_improper_choice_lane" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Fails to use mirrors properly 
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_fails_use_mirror_properly_1" name="driving_fails_use_mirror_properly" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_fails_use_mirror_properly_2" name="driving_fails_use_mirror_properly" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_fails_use_mirror_properly_3" name="driving_fails_use_mirror_properly" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_fails_use_mirror_properly_4" name="driving_fails_use_mirror_properly" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>  
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Signal: wrong / late / not used / not cancelled
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_signal_1" name="driving_signal" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_signal_2" name="driving_signal" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_signal_3" name="driving_signal" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_signal_4" name="driving_signal" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>  
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Fails to use caution at R.R. Xing	
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_fail_use_caution_rr_1" name="driving_fail_use_caution_rr" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_fail_use_caution_rr_2" name="driving_fail_use_caution_rr" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_fail_use_caution_rr_3" name="driving_fail_use_caution_rr" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_fail_use_caution_rr_4" name="driving_fail_use_caution_rr" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                                 <div>
                                                                    <div class="col-md-12">
            															Speed: too fast / too slow  	
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_speed_1" name="driving_speed" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_speed_2" name="driving_speed" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_speed_3" name="driving_speed" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_speed_4" name="driving_speed" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div> 
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Incorrect use of: clutch / brakes		
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_incorrect_use_clutch_brake_1" name="driving_incorrect_use_clutch_brake" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_incorrect_use_clutch_brake_2" name="driving_incorrect_use_clutch_brake" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_incorrect_use_clutch_brake_3" name="driving_incorrect_use_clutch_brake" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_incorrect_use_clutch_brake_4" name="driving_incorrect_use_clutch_brake" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Accelerator / gears / steering		
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_accelerator_gear_steer_1" name="driving_accelerator_gear_steer" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_accelerator_gear_steer_2" name="driving_accelerator_gear_steer" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_accelerator_gear_steer_3" name="driving_accelerator_gear_steer" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_accelerator_gear_steer_4" name="driving_accelerator_gear_steer" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Incorrect observation skills	
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_incorrect_observation_skills_1" name="driving_incorrect_observation_skills" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_incorrect_observation_skills_2" name="driving_incorrect_observation_skills" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_incorrect_observation_skills_3" name="driving_incorrect_observation_skills" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_incorrect_observation_skills_4" name="driving_incorrect_observation_skills" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                                <div>
                                                                    <div class="col-md-12">
            															Doesn't respond to instruction	
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
					                                                   <label class="radio-inline">
                                                                        2<input type="radio" class="2" id="driving_respond_instruction_1" name="driving_respond_instruction" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                        4<input type="radio" class="4" id="driving_respond_instruction_2" name="driving_respond_instruction" value="2"/></label>
                                                                        <label class="radio-inline">
                                                                        6<input type="radio" class="6" id="driving_respond_instruction_3" name="driving_respond_instruction" value="3"/></label>
                                                                        <label class="radio-inline">
                                                                        8<input type="radio" class="8" id="driving_respond_instruction_4" name="driving_respond_instruction" value="4"/></label>
                                                                    </div>
    							                                    <div class="clearfix"></div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="portlet box blue">
                                                            <div class="portlet-title">
                                                                <div class="caption"><strong>Backing:</strong> sight side / blind side | <em>Fails to</em></div>
                                                            </div>

                                                            <div class="portlet-body">
                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Uses proper set up
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_uses_proper_set_up_1" name="backing_uses_proper_set_up" value="1"/>
                                                                    </label>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Check vehicle path before / while backing
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_path_before_while_driving_1" name="backing_path_before_while_driving" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="backing_path_before_while_driving_2" name="backing_path_before_while_driving" value="2"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Use of 4 way flashers / city horn
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_use_4way_flashers_city_horn_1" name="backing_use_4way_flashers_city_horn" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="backing_use_4way_flashers_city_horn_2" name="backing_use_4way_flashers_city_horn" value="2"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Shows certainty while steering
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_show_certainty_while_steering_1" name="backing_show_certainty_while_steering" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="backing_show_certainty_while_steering_2" name="backing_show_certainty_while_steering" value="2"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Continually uses mirrors
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_continually_uses_mirror_1" name="backing_continually_uses_mirror" value="1"/></label>
                                                                        <label class="radio-inline">
                                                                            2<input type="radio" class="2" id="backing_continually_uses_mirror_2" name="backing_continually_uses_mirror" value="2"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Maintain proper speed
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_maintain_proper_seed_1" name="backing_maintain_proper_seed" value="1"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="col-md-12">
                                                                        Complete in a reasonable time and fashion
                                                                    </div>
                                                                    <div class="col-md-12 radio-list">
                                                                        <label class="radio-inline">
                                                                            1<input type="radio" class="1" id="backing_complete_reasonable_time_fashion_1" name="backing_complete_reasonable_time_fashion" value="1"/></label>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                    </div>

                                                        <div class="clearfix"></div>
                                                        </div>
                                                        <hr />

                                                
                                                

                                                <div class="form-group row">

													<div class="col-md-4">
                                                        <label class="control-label">Total score<span class="required"> * </span> </label>
														<input type="text" id="total_score" class="form-control" name="total_score"  <?php if(!$did){?>value="0"<?php }?>/>
														
													</div>


													<div class="col-md-4">
                                                        <label class="control-label">Auto shift<span class="required"> * </span> </label>
														<input type="text" class="form-control" name="auto_shift"/>
														
													</div>

													<div class="col-md-4">
                                                        <label class="control-label">Manual<span class="required"> * </span></label>
														<input type="text" class="form-control" name="manual"/>
														
													</div>
												</div>

                                                <div class="form-group row">
													<p class="center col-md-12 fontRed">The total score must be less than 20 to pass for Autoshift and 24 for Manual. Pass for a full trainee is less than 30</p>
												</div>
                                                <hr />
                                                <div class="form-group row">
                                                    <p class="control-label col-md-6"><strong>Summary</strong></p>
                                                </div>
                                                <div class="form-group row">
													<label class="control-label col-md-4">Recommended for hire <span class="required">
													* </span>
													</label>
													<div class="col-md-8 radio-list">
                                                        <div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_for_hire_1" name="recommended_for_hire" value="1"/> Yes </label></div><div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_for_hire_2" name="recommended_for_hire" value="0"/> No </label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group row">
													<label class="control-label col-md-4">Recommended as Full trainee <span class="required">
													* </span>
													</label>
													<div class="col-md-8 radio-list">
														<div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_full_trainee_1" name="recommended_full_trainee" value="1"/> Yes </label></div><div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_full_trainee_0" name="recommended_full_trainee" value="0"/> No </label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                <div class="form-group row">
													<label class="control-label col-md-4">Recommended fire hire with trainee <span class="required">
													* </span>
													</label>
													<div class="col-md-8 radio-list">
                                                        <div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_fire_hire_trainee_1" name="recommended_fire_hire_trainee" value="1"/> Yes </label></div><div class="checkbox-list col-md-3 nopad">
															<label class="radio-inline">
															<input type="radio" id="recommended_fire_hire_trainee_0" name="recommended_fire_hire_trainee" value="0"/> No </label>
														</div>
														<div id="form_payment_error">
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group row">
													<label class="control-label col-md-4">Comments <span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<textarea  placeholder="" class="form-control" name="comments" style="height:140px"></textarea>
														
													</div>
												</div>
                                                <div class="clearfix"></div>
                                                <?php
                                                        if(!isset($sub['de_at']))//THIS SHOULD BE USING FILELIST.PHP!!!!!
                                                        {
                                                            $sub['de_at'] = array();
                                                        }
                                                        
                                                        if(!count($sub['de_at'])){?>
                                                <div class="form-group row" style="display:block;margin-top:5px; margin-bottom: 5px;">
                                                    <label class="control-label col-md-4">Attach File : </label>
                                                    <div class="col-md-8">
                                                    <input type="hidden" class="road1" name="attach_doc[]" />
                                                    <a href="#" id="road1" class="btn btn-primary">Browse</a> <span class="uploaded"></span>
                                                    </div>
                                                   </div>
                                                   <?php }?>
                                                  <div class="form-group row">
                                                    <div id="more_driver_doc" data-road="<?php if(count($sub['de_at']))echo count($sub['de_at']);else echo '1';?>">
                                                       <?php
                                                        if(count($sub['de_at']))//THIS SHOULD BE USING FILELIST.PHP!!!!!!!!!!!!
                                                        {
                                                            $at=0;
                                                            foreach($sub['de_at'] as $pa)
                                                            {
                                                                if($pa->attachment){
                                                                $at++;
                                                                ?>
                                                                <div class="del_append_driver"><label class="control-label col-md-4">Attach File : </label><div class="col-md-6 pad_bot"><input type="hidden" class="road<?php echo $at;?>" name="attach_doc[]" value="<?php echo $pa->attachment;?>" /><a href="#" id="road<?php echo $at;?>" class="btn btn-primary">Browse</a> <?php if($at>1){?><a  href="javascript:void(0);" class="btn btn-danger" id="delete_driver_doc" onclick="$(this).parent().remove();">Delete</a><?php }?>
                                                                <span class="uploaded"><?php echo $pa->attachment;?>  <?php if($pa->attachment){$ext_arr = explode('.',$pa->attachment);$ext = end($ext_arr);$ext = strtolower($ext);if(in_array($ext,$img_ext)){?><img src="<?php echo $this->request->webroot;?>attachments/<?php echo $pa->attachment;?>" style="max-width:120px;" /><?php }elseif(in_array($ext,$doc_ext)){?><a class="dl" href="<?php echo $this->request->webroot;?>attachments/<?php echo $pa->attachment;?>">Download</a><?php }else{?><br />
                                                                <video width="320" height="240" controls>
                                                                <source src="<?php echo $this->request->webroot;?>attachments/<?php echo $pa->attachment;?>" type="video/mp4">
                                                                <source src="<?php echo $this->request->webroot;?>attachments/<?php echo str_replace('.mp4','.ogg',$pa->attachment);?>" type="video/ogg">
                                                                 Your browser does not support the video tag.
                                                                </video> 
                                                            <?php } }?></span>
                                                                </div></div><div class="clearfix"></div>
                                                                <script>
                                                                $(function(){
                                                                    fileUpload('road<?php echo $at;?>');
                                                                });
                                                                </script>
                                                                <?php
                                                            }}
                                                        }
                                                        ?> 
                                                    </div>
                                                    <div class="col-md-8">
                                                    </div>
                                                  </div>
                                                  
                                                  <div class="form-group row">
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="javascript:void(0);" class="btn btn-success" id="add_more_driver_doc">Add More</a>
                                                    </div>
                                                  </div>

</form>
                                                    
<div class="clearfix"></div>
 <script>
    $(function(){
        $('#firstcheck input[type="checkbox"]').change(function(){
            if(!$('#total1').val())
            {
                var total1 = 0;
            }
            else
            var total1 = parseInt($('#total1').val());
            if($(this).is(':checked'))
            {
                total1 = total1+1;
                $('#total1').val(total1);
                $('#total_score').val(parseInt($('#total_score').val())+1);
            }
            else
            {
                total1 = total1-1;
                $('#total1').val(total1);
                $('#total_score').val(parseInt($('#total_score').val())-1);
            }
            
        });
        
        $('.scores input[type="radio"]').change(function(){
            total2 = 0;
            $('#total_score').val($('#total1').val());
            $('.scores input[type="radio"]').each(function(){
            if($(this).is(':checked'))
            {
                total2 = total2+parseInt($(this).attr('class'));
            }
            });
            $('#total_score').val(total2 + parseInt($('#total1').val()));
        });
        
        
        <?php
        if($this->request->params['action']=='addorder' || $this->request->params['action']=='add')
        {
            ?>
            fileUpload('road1');
            <?php
        }
        ?>
//        
       $('#add_more_driver_doc').click(function(){
        var count = $('#more_driver_doc').data('road');
        $('#more_driver_doc').data('road',parseInt(count)+1);
        $('#more_driver_doc').append('<div class="del_append_driver"><label class="control-label col-md-4"></label><div class="col-md-8 pad_bot"><input type="hidden" class="road'+$('#more_driver_doc').data('road')+'" name="attach_doc[]" /><a href="#" id="road'+$('#more_driver_doc').data('road')+'" class="btn btn-primary">Browse</a> <a  href="javascript:void(0);" class="btn btn-danger" id="delete_driver_doc">Delete</a> <span class="uploaded"></span></div></div><div class="clearfix"></div>');
        fileUpload('road'+$('#more_driver_doc').data('road'));
       }); 
       
       $('#delete_driver_doc').live('click',function(){
         var count = $('#more_driver_doc').data('road');
        $('#more_driver_doc').data('road',parseInt(count)-1);
            $(this).closest('.del_append_driver').remove();
       });
       
        //$("#test2").jqScribble();
    });
    	
</script>                                               