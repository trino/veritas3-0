<?php
    if ($_SERVER['SERVER_NAME'] == 'localhost')
        echo "<span style ='color:red;'>subpages/documents/consent_form.php #INC139</span>";
    include_once 'subpages/filelist.php';
    printdocumentinfo($did);
    if (isset($sub2)) { listfiles($sub2['con_at'], "attachments/", "", false, 3);     }
?>
<form id="form_consent">
    <div class="form-group row">
        <h3 class="col-md-12">Consent for the release of police information and disclosure of personal information</h3>
    </div>
    <div class="gndn">
        <div class="form-group row">

            <div class="col-md-4"><label class="control-label">Surname : </label>
                <input type="text" class="form-control required" name="last_name"/>
            </div>

            <div class="col-md-4"><label class="control-label">First Name : </label>
                <input type="text" class="form-control required" name="first_name"/>
            </div>

            <div class="col-md-4"><label class="control-label">Middle Name : </label>
                <input type="text" class="form-control" name="mid_name"/>
            </div>

            <div class="col-md-4"><label class="control-label">
                    <small>Previous Surname(s) or Maiden Name(s) :</small>
                </label>
                <input type="text" class="form-control" name="previous_last_name"/>
            </div>

            <div class="col-md-4"><label class="control-label">Place of Birth (Country) : </label>
                <input type="text" class="form-control" name="place_birth_country"/>
            </div>


            <div class="col-md-4"><label class="control-label">Date of Birth : </label>
                <input type="text" class="form-control date-picker required" placeholder="YYYY-MM-DD"
                       name="birth_date"/>
            </div>

            <div class="col-md-4"><label class="control-label">Sex : </label>
                <input type="text" class="form-control" name="sex"/>
            </div>

            <div class="col-md-4"><label class="control-label">Phone Number : </label>
                <input type="text" class="form-control" name="phone"/>
            </div>


            <div class="col-md-4"><label class="control-label">Aliases : </label>
                <input type="text" class="form-control" name="aliases"/>
            </div>


            <div class="col-md-4"><label class="control-label">Drivers License Number : </label>
                <input type="text" class="form-control required" name="driver_license_number"/>
            </div>

            <div class="col-md-4"><label class="control-label">Driver’s License was issued in :</label>
                <?php provinces("driver_license_issued"); ?>
            </div>


            <div class="col-md-4"><label class="control-label">Applicants Email : </label>
                <input type="text" class="form-control email1 " name="applicants_email"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-6">Current Address : </label>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <input type="text" class="form-control required" placeholder="Street and Number"
                       name="current_street_address"/>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="Apt/Unit" name="current_apt_unit"/>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control required" placeholder="City" name="current_city"/>
            </div>
            <div class="col-md-2">
                <?php provinces("current_province"); ?>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control required" placeholder="Postal Code" name="current_postal_code"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-9">Previous Address (if you have not lived at Current Address for more
                than 5 years): </label>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Street and Number" name="previous_street_address"/>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="Apt/Unit" name="previous_apt_unit"/>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="City" name="previous_city"/>
            </div>
            <div class="col-md-2">
                <?php provinces("previous_province"); ?>
                <!-- <input type="text" class="form-control" placeholder="Province" name="previous_province"/> -->
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Postal Code" name="previous_postal_code"/>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <p>I hereby consent to the search of the following:</p>
                <ul>
                    <li>Driver Record/ Abstract - Please specify Province or State (Region where Driver's License Issued)</li>
                    <li>Insurance History - Please specify Province or State (Region where Driver's License Issued)</li>
                    <li>Employment Verifications</li>
                    <li>TransClick (Aptitude Test)</li>
                    <li>Check DL</li>
                    <li>Employment Verification (Drug test information and Claims History)</li>
                </ul>
                <p>I hereby consent to a criminal record search (Adult) through both the: </p>
                <ul>
                    <li>Local Police Records which includes Police Information Portal (PIP) Firearms Interest Person
                        (FIP)and Niche RMS
                    </li>
                    <li>RCMP National Repository of Criminal Records which will be conducted based on name(s), date of
                        birth and declared criminal record (as per Section 9.6.4 of the CCRTIS Dissemination policy)
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <h4>*Authorization to Release Clearance Report or Any Police Information</h4>

                <p>I certify that the information I have supplied is correct and true to the best of my knowledge. I
                    consent
                    to the release of a Criminal Record or any Criminal Information to ISB Canada and its partners, and
                    to
                    the Organization Requesting Search named below and its designated agents and/or partners. All data
                    is
                    subject to provincial, state, and federal privacy legislation.</p>

                <p>The criminal record search will be performed by a police service. I hereby release and forever
                    discharge
                    all members and employees of the Processing Police Service from any and all actions, claims and
                    demands
                    for damages, loss or injury howsoever arising which may hereafter be sustained by myself or as a
                    result
                    of the disclosure of information by the Processing Police Service to ISB Canada and its
                    partners.</p>

                <p>*I hereby release and forever discharge all agents from any claims, actions demands for damages,
                    injury
                    or loss which may arise as a result of the disclosure of information by any of the information
                    sources
                    including but not limited to the Credit Bureau or Department of Motor Vehicles to the designated
                    agents
                    and/or their partners and representatives. </p>

                <p>*I am aware and I give consent that the records named above may be transmitted electronically or in
                    hard
                    copy within Canada and to the country from where the search was requested as indicated below. By
                    signing
                    this waiver, I acknowledge full understanding of the content on this consent form.</p>
            </div>
        </div>

        <div class="form-group row">
            <label style="  text-align: left;" class="control-label col-md-11">Applicant's Signature- by signing this form you agree and consent to
                the terms and release of information listed on this form : </label>


        </div>
        <div class="form-group col-md-6">
            <?php include('canvas/consent_signature_driver2.php'); ?>
        </div>
        <div class="form-group col-md-6">
            <?php include('canvas/consent_signature_witness2.php'); ?>
        </div>

        <div class="clearfix"></div>
        <div class="form-group row">


            <div class="col-md-4"><label class="control-label">Company Name Requesting Search : </label>
                <input type="text" class="form-control" name="company_name_requesting"/>
            </div>


            <div class="col-md-4"><label class="control-label">Printed Name of Company Witness : </label>
                <input type="text" class="form-control" name="printed_name_company_witness"/>
            </div>

            <div class="col-md-4"><label class="control-label">Company Location (Country): </label>
                <input type="text" class="form-control" name="company_location"/>
            </div>

        </div>

        <div class="clearfix"></div>
    </div>


    <div class="clearfix"></div>
    <hr/>

    <div class="form-group row">
        <strong class="col-md-12">
            Declaration of Criminal Record
        </strong>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <p>*When declaration is submitted, it must be accompanied by the Consent for the Release of Police
                Information
                form.</p>
            <h4>PART 1 - DECLARATION OF CRIMINAL RECORD (if applicable) - Completed by Applicant</h4>

            <div class="form-group row">


                <div class="col-md-4"><label class="control-label">Surname: </label>
                    <input type="text" class="form-control" name="criminal_surname"/>
                </div>


                <div class="col-md-4"><label class="control-label">Given Name: </label>
                    <input type="text" class="form-control" name="criminal_given_name"/>
                </div>

                <div class="col-md-4"><label class="control-label">Sex: </label>
                    <SELECT name="criminal_sex" class="form-control">
                        <OPTION>Male</OPTION>
                        <OPTION>Female</OPTION>
                    </SELECT>
                    <!--<input type="text" class="form-control" name="criminal_sex"/>-->
                </div>


                <div class="col-md-4"><label class="control-label">Date of Birth : </label>
                    <input type="text" class="form-control date-picker" placeholder="YYYY-MM-DD"
                           name="criminal_date_birth"/>
                </div>

                <div class="col-md-4"><label class="control-label">Date: </label>
                    <input type="text" class="form-control date-picker" placeholder="YYYY-MM-DD" name="criminal_date"
                           value="<?php echo date("Y-m-d"); ?>"/>
                </div>
            </div>


            <div class="form-group row">
                <label class="control-label col-md-3">Current Address: </label>

                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Address" name="criminal_current_address"/>
                </div>
                <div class="col-md-3">
                    <?php provinces("criminal_current_province"); ?>
                    <!--                 <input type="text" class="form-control" placeholder="Province" name="criminal_current_province"/>-->
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Postal Code"
                           name="criminal_current_postal_code"/>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <strong>DECLARATION OF CRIMINAL RECORD</strong>
            <ul>
                <li>does not constitute a Certified Criminal Record by the RCMP</li>
                <li>may not contain all criminal record convictions.</li>
            </ul>
        </div>

        <div class="col-md-12">
            <strong>DO NOT DECLARE THE FOLLOWING:</strong>
            <ul>
                <li>Absolute discharges or Conditional discharges, pursuant to the Criminal Code, section 730.</li>
                <li>Any charges for which you have received a Pardon, pursuant to the Criminal Records Act.</li>
                <li>Any offences while you were a "young person" (twelve years old but less than eighteen years old),
                    pursuant to the Youth Criminal Justice Act.
                </li>
                <li>Any charges for which you were not convicted, for example, charges that were withdrawn, dismissed,
                    etc.
                </li>
                <li>Any provincial or municipal offences.</li>
                <li>Any charges dealt with outside of Canada.</li>
            </ul>
        </div>

        <div class="col-md-12">
            <strong>NOTE:</strong>

            <p>A Certified Criminal Record can only be issued based on the submission of fingerprints to the RCMP
                National Repository of Criminal Records.</p>
        </div>

        <div class="col-md-12">
            <div class="table-scrollable">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Offence</th>
                        <th>Date of Sentence</th>
                        <th>Location</th>
                    </tr>
                    </thead>
                    <?php
                        $i = 0;
                        if (isset($sub2) && $sub2) {
                            foreach ($sub2['con_cri'] as $con_cri) {
                                $co[$i] = $con_cri->offence;
                                $cd[$i] = $con_cri->date_of_sentence;
                                $cl[$i] = $con_cri->location;

                                $i++;
                            }
                        }
                        if ($i <= 7) {
                            for ($j = $i; $j <= 7; $j++) {
                                $co[$j] = '';
                                $cd[$j] = '';
                                $cl[$j] = '';
                            }
                        }

                    ?>
                    <?php
                        for ($k = 0; $k < 8; $k++) {
                            ?>
                            <tr>
                                <td><input type="text" class="form-control" name="offence[]"
                                           value="<?php echo $co[$k]; ?>"/>
                                </td>
                                <td><input type="text" class="form-control date-picker" name="date_of_sentence[]"
                                           value="<?php echo $cd[$k]; ?>"/></td>
                                <td><input type="text" class="form-control" name="location[]"
                                           value="<?php echo $cl[$k]; ?>"/></td>
                            </tr>
                        <?php
                        }
                    ?>

                </table>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
    <hr/>

    <div class="form-group row">
        <h3 class="col-md-12">
            Mandatory use for all account holders
        </h3>

        <div class="gndn">
            <div class="col-md-12">
                <h4>Important Notice Regarding Background Reports From The PSP Online Service</h4>
            </div>
            <div class="col-md-12">
                <p>

                <div class="col-md-5">1.&nbsp;&nbsp;In connection with your application for employment with</div>
                <div class="col-md-3"><input type="text" class="form-control" name="psp_employer"/></div>
                <div class="col-md-4">("Prospective Employer"), Prospective Employer,</div>
                <br/><br/> its employees, agents or contractors may obtain one or more reports regarding your driving,
                and
                safety inspection history from the Federal Motor Carrier Safety Administration (FMCSA).</p>
                <p>When the application for employment is submitted in person, if the Prospective Employer uses any
                    information it obtains from FMCSA in a decision to not hire you or to make any other adverse
                    employment
                    decision regarding you, the Prospective Employer will provide you with a copy of the report upon
                    which
                    its decision was based and a written summary of your rights under the Fair Credit Reporting Act
                    before
                    taking any final adverse action. If any final adverse action is taken against you based upon your
                    driving history or safety report, the Prospective Employer will notify you that the action has been
                    taken and that the action was based in part or in whole on this report.</p>

                <p>When the application for employment is submitted by mail, telephone, computer, or other similar
                    means, if
                    the Prospective Employer uses any information it obtains from FMCSA in a decision to not hire you or
                    to
                    make any other adverse employment decision regarding you, the Prospective Employer must provide you
                    within three business days of taking adverse action oral, written or electronic notification: that
                    adverse action has been taken based in whole or in part on information obtained from FMCSA; the
                    name,
                    address, and the toll free telephone number of FMCSA; that the FMCSA did not make the decision to
                    take
                    the adverse action and is unable to provide you the specific reasons why the adverse action was
                    taken;
                    and that you may, upon providing proper identification, request a free copy of the report and may
                    dispute with the FMCSA the accuracy or completeness of any information or report. If you request a
                    copy
                    of a driver record from the Prospective Employer who procured the report, then, within 3 business
                    days
                    of receiving your request, together with proper identification, the Prospective Employer must send
                    or
                    provide to you a copy of your report and a summary of your rights under the Fair Credit Reporting
                    Act.</p>

                <p>The Prospective Employer cannot obtain background reports from FMCSA unless you consent in
                    writing.</p>

                <p>If you agree that the Prospective Employer may obtain such background reports, please read the
                    following
                    and sign below:</p>
            </div>
            <div class="col-md-12">
                <p>

                <div class="col-md-2">2.&nbsp;&nbsp;I authorize</div>
                <div class="col-md-3"><input type="text" class="form-control" name="authorize_name_hereby"/></div>
                <div class="col-md-7">("Prospective Employer") to access the FMCSA Pre-Employment Screening Program PSP
                </div>
                </p><br/><br/>

                <p>system to seek information regarding my commercial driving safety record and information regarding my
                    safety inspection history. I understand that I am consenting to the release of safety performance
                    information including crash data from the previous five (5) years and inspection history from the
                    previous three (3) years. I understand and acknowledge that this release of information may assist
                    the
                    Prospective Employer to make a determination regarding my suitability as an employee.</p>

                <p>3.&nbsp;&nbsp;I further understand that neither the Prospective Employer nor the FMCSA contractor
                    supplying the crash and safety information has the capability to correct any safety data that
                    appears to
                    be incorrect. I understand I may challenge the accuracy of the data by submitting a request to
                    https://dataqs.fmcsa.dot.gov. If I am challenging crash or inspection information reported by a
                    State,
                    FMCSA cannot change or correct this data. I understand my request will be forwarded by the DataQs
                    system
                    to the appropriate State for adjudication.</p>

                <p>4.&nbsp;&nbsp;Please note: Any crash or inspection in which you were involved will display on your
                    PSP
                    report. Since the PSP report does not report, or assign, or imply fault, it will include all
                    Commercial
                    Motor Vehicle (CMV) crashes where you were a driver or co-driver and where those crashes were
                    reported
                    to FMCSA, regardless of fault. Similarly, all inspections, with or without violations, appear on the
                    PSP
                    report. State citations associated with FMCSR violations that have been adjudicated by a court of
                    law
                    will also appear, and remain, on a PSP report.</p>

                <p>I have read the above Notice Regarding Background Reports provided to me by Prospective Employer and
                    I
                    understand that if I sign this consent form, Prospective Employer may obtain a report of my crash
                    and
                    inspection history. I hereby authorize Prospective Employer and its employees, authorized agents,
                    and/or
                    affiliates to obtain the information authorized above.</p>

                <label class="control-label col-md-2">Date : </label>

                <div class="col-md-2">
                    <input type="text" class="form-control date-picker" name="authorize_date"/>
                </div>
                <!--<label class="control-label col-md-3">Signature: </label>
                <div class="col-md-3">
                    <input type="hidden" class="form-control" name="authorize_signature"/>
                </div>-->
                <input type="hidden" class="form-control" name="authorize_signature"/>

                <label class="control-label col-md-3"> Name (Please Print): </label>

                <div class="col-md-5">
                    <input type="text" class="form-control" name="authorize_name"/>
                </div>
            </div>
            <div class="col-md-12">
                <p>NOTICE: This form is made available to monthly account holders by NICT on behalf of the U.S.
                    Department
                    of Transportation, Federal Motor Carrier Safety Administration (FMCSA). Account holders are required
                    by
                    federal law to obtain an Applicant's written or electronic consent prior to accessing the
                    Applicant's
                    PSP report. Further, account holders are required by FMCSA to use the language provided in
                    paragraphs
                    1-4 of this document to obtain an Applicant's consent. The language must be used in whole, exactly
                    as
                    provided. The language may be included with other consent forms or language at the discretion of the
                    account holder, provided the four paragraphs remain intact and the language is unchanged.</p>

                <p>LAST UPDATED 10/29/2012</p>
            </div>

            <div class="form-group col-md-6">
                <?php include('canvas/consent_signature_driver.php'); ?>
            </div>
            <div class="form-group col-md-6">
                <?php include('canvas/consent_signature_witness.php'); ?>
            </div>

            <div class="clearfix"></div>

            <?php
                /*
                $at=0;
                if(isset($sub2['con_at']))
                {

                    foreach($sub2['con_at'] as $pa)
                    {
                      $at++;

                    ?>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-3">Attach Document <?php echo $at;?>: </label>
                    <div class="col-md-9">
                    <input type="hidden" name="attach_doc[]" class="consent<?php echo $at;?>" value="<?php echo $pa->attach_doc;?>" />
                    <a href="javascript:void(0);" id="consent<?php echo $at;?>" class="btn btn-primary">Browse</a> <span class="uploaded"><?php echo $pa->attach_doc;?></span>
                    </div>
                    </div>
                    <?php
                    }
                }
                if($at==0)
                {
                    $at++;
                    ?>
                    <div class="form-group col-md-12">
                    <label class="control-label col-md-3">Attach Document <?php echo $at;?>: </label>
                    <div class="col-md-9">
                    <input type="hidden" name="attach_doc[]" class="consent<?php echo $at;?>" value="" />
                    <a href="javascript:void(0);" id="consent<?php echo $at;?>" class="btn btn-primary">Browse</a> <span class="uploaded"></span>
                    </div>
                    </div>
                    <?php
                    $at=1;
                }
                if($at==1)
                {
                    ?>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3">Attach Document 2: </label>
                    <div class="col-md-9">
                        <input type="hidden" name="attach_doc[]" class="consent2" />
                        <a href="javascript:void(0);" id="consent2"  class="btn btn-primary">Browse</a> <span class="uploaded"></span>
                    </div>
                </div>
                <?php
                }
                */
            ?>
            <?php
                if (!isset($sub2['con_at'])) {
                    $sub2['con_at'] = array();
                }
                if (!count($sub2['con_at'])) {
                    ?>
                    <div class="form-group col-md-12" style="display:block;margin-top:5px; margin-bottom: 5px;">
                        <label class="control-label col-md-3">Attach ID: </label>

                        <div class="col-md-9">
                            <input type="hidden" name="attach_doc[]" class="consent1"/>
                            <a href="javascript:void(0);" id="consent1" class="btn btn-primary">Browse</a>
                            <span class="uploaded"></span>
                        </div>
                    </div>
                <?php } ?>
            <div class="form-group col-md-12">
                <div id="more_consent_doc"
                     data-consent="<?php if (count($sub2['con_at'])) echo count($sub2['con_at']); else echo '1'; ?>">
                    <?php
                        if (count($sub2['con_at'])) {
                            $at = 0;
                            foreach ($sub2['con_at'] as $pa) {
                                if($pa->attachment){
                                $at++;
                                ?>
                                <div class="del_append_consent">
                                    <label class="control-label col-md-3">Attach File : </label>

                                    <div class="col-md-6 pad_bot">
                                        <input type="hidden" class="consent<?php echo $at; ?>" name="attach_doc[]"
                                               value="<?php echo $pa->attachment; ?>"/>
                                        <a href="#" id="consent<?php echo $at; ?>" class="btn btn-primary">Browse</a>
                                        <a href="javascript:void(0);" class="btn btn-danger" id="delete_doc"
                                           onclick="$(this).parent().remove();">Delete</a>
                                    <span class="uploaded"><?php echo $pa->attachment; ?>  <?php if ($pa->attachment) {
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
                                        } ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <script>
                                    $(function () {
                                        fileUpload('consent<?php echo $at;?>');
                                    });
                                </script>
                            <?php
                            }}
                        }
                    ?>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <a href="javascript:void(0);" class="btn btn-success moremore" id="add_more_consent_doc">Add
                        More</a>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
</form>


<script>
    $(function () {
        <?php if($this->request->params['action'] != 'vieworder' && $this->request->params['action']!= 'view'){?>
        $("#test3").jqScribble();
        $("#test4").jqScribble();
        $("#test5").jqScribble();
        $("#test6").jqScribble();
        <?php }?>

        <?php
        if($this->request->params['action']=='addorder' || $this->request->params['action']=='add')
        {
            ?>
        fileUpload('consent1');

        <?php
    }
    ?>

        $('#add_more_consent_doc').click(function () {
            var count = $('#more_consent_doc').data('consent');
            $('#more_consent_doc').data('consent', parseInt(count) + 1);
            $('#more_consent_doc').append('<div class="del_append_consent"><label class="control-label col-md-3"></label><div class="col-md-6 pad_bot"><input type="hidden" name="attach_doc[]" class="consent' + $('#more_consent_doc').data('consent') + '" /><a id="consent' + $('#more_consent_doc').data('consent') + '" href="javascript:void(0);" class="btn btn-primary">Browse</a> <a  href="javascript:void(0);" class="btn btn-danger" id="delete_consent_doc">Delete</a> <span class="uploaded"></span></div></div><div class="clearfix"></div>');
            fileUpload('consent' + $('#more_consent_doc').data('consent'));
        });

        $('#delete_consent_doc').live('click', function () {
            $(this).closest('.del_append_consent').remove();
        });
    });
</script></div>