<?php
    $settings = $this->requestAction('settings/get_settings');
    $sidebar = $this->requestAction("settings/get_side/" . $this->Session->read('Profile.id'));
    include_once('subpages/api.php');
    $language = $this->request->session()->read('Profile.language');
    $strings = CacheTranslations($language, array("training_%", "forms_save", "score_incomplete"),$settings);
?>
<h3 class="page-title">
    <?= $strings["training_quiz"] ?>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?php echo $this->request->webroot; ?>"><?= $strings["dashboard_dashboard"] ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo $this->request->webroot; ?>training"><?= $strings["index_training"] ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href=""><?= $strings["training_quiz"] ?></a>
        </li>
    </ul>
    <div class="page-toolbar">
        <!--div id="dashboard-report-range" style="padding-bottom: 6px;" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase visible-lg-inline-block">&nbsp;</span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div-->
    </div>
    <a href="javascript:window.print();" class="floatright btn btn-info"><?= $strings["dashboard_print"] ?></a>
</div>

<?php
    $question = 0;
    $QuizID = $_GET["quizid"];
    function clean($data, $datatype = 0) {
        if (is_object($data)) {
            switch ($datatype) {
                case 0:
                    $data->Description = clean($data->Description);
                    $data->Name = clean($data->Name);
                    $data->Attachments = clean($data->Attachments);
                    $data->image = clean($data->image);
                    return $data;
                    break;
                case 1:
                    $data->Question = clean($data->Question);
                    $data->Picture = clean($data->Picture);
                    $data->Choice0 = clean($data->Choice0);
                    $data->Choice1 = clean($data->Choice1);
                    $data->Choice2 = clean($data->Choice2);
                    $data->Choice3 = clean($data->Choice3);
                    $data->Choice4 = clean($data->Choice4);
                    $data->Choice5 = clean($data->Choice5);
                    return $data;
                    break;
            }
        }
        if (substr($data, 0, 1) == '"' && substr($data, -1) == '"') {
            $data = substr($data, 1, strlen($data) - 2);
        }
        $data = str_replace("\\r\\n", "\r\n", trim($data));
        return $data;
    }

    function processnumber($string, $number){
        if(strpos($string, "%#%") === false){ return $string . " " . $number;}
        return str_replace("%#%", $number, $string);;
    }

    function question($strings, $section) {
        global $question;
        switch ($section) {
            case "0":
                echo '<div class="row"><div class="col-md-12"><div class="portlet box blue-steel"><div class="portlet-title">';
                echo '<div class="caption"><i class="fa fa-graduation-cap"></i>';
                echo processnumber($strings["training_questionnumber"], $question);
                echo '</div></div><div class="portlet-body">';
                echo '<div class="row"><div class="col-md-2">';
                break;
            case "1":
                echo '</div><div class="col-md-10">';
                break;
            case "2":
                echo '</div></div></div></div></div></div>';
                break;
        }
    }

    function answers($strings, $QuizID, $QuestionID, $text, $answers, $Index = 0, $usersanswer, $correctanswer) {
        $disabled = "";
        $selected = -1;
        $iscorrect = false;
        if (is_object($usersanswer)) {
            $disabled = " disabled";
            $selected = $usersanswer->Answer;
        }
        $Qold = $QuestionID;
        $QuestionID = $QuizID . ':' . $Index;
        echo '<input type="hidden" name="' . $QuestionID . ':sequencecheck" value="' . $Qold . '" />';
        echo '<div class="qtext"><p>' . $text . '</p></div>';
        echo '<div class="ablock"><div class="prompt">' . $strings["training_selectone"] . ':';
        if ($correctanswer == -1) {
            echo " <font color='red'><B>" . $strings["training_missing"] . "</B></font>";
        }
        echo '</div><div class="answer"><TABLE>';
        for ($temp = 0; $temp < count($answers); $temp += 1) {
            if (strlen(trim($answers[$temp])) > 0) {
                echo '<TR><TD valign="top"><div class="r' . $temp . '" nowrapstyle="white-space: nowrap;">';
                echo '<input type="radio" name="' . $QuestionID . '_answer" value="' . $temp . '" id="' . $QuestionID . ":" . $temp . '" required' . $disabled;
                if ($selected == $temp) {
                    echo " checked";
                }
                echo '/></TD><TD><label for="' . $QuestionID . ":" . $temp . '">' . chr($temp + ord("a")) . ". " . $answers[$temp];
                if (is_object($usersanswer) && $selected == $temp) {
                    if ($correctanswer == $temp) {
                        echo " <font color='green'><B>" . $strings["training_correct"] . "!</B></font>";
                        $iscorrect = true;
                    } else {
                        echo " <font color='red'><B>" . $strings["training_incorrect"] . "</B></font>";
                    }
                }
                echo '</label></div></TD></TR>';
            }
        }
        echo '</TABLE></DIV></DIV>';
        return $iscorrect;
    }

    function questionheader($strings, $QuizID, $QuestionID, $markedOutOf, $Index = 0, $usersanswer) {
        $flagged = "";
        $answered = $strings["training_notanswered"];
        if (is_object($usersanswer)) {
            if ($usersanswer->flagged) {
                $flagged = " checked";
            }
            $flagged .= " disabled";
            $answered = $strings["training_answered"];
        }
        $QuestionID = $QuizID . ':' . $Index;
        echo '<div class="state">' . $answered . '</div><div class="grade">' . processnumber($strings["training_outof"], $markedOutOf) . '</div>';
        //echo '<div class="questionflag editable" aria-atomic="true" aria-relevant="text" aria-live="assertive">';
        //echo '<input type="hidden" name="' . $QuestionID . '_flagged" value="0" />';
        //echo '<input type="checkbox" id="' . $QuestionID . '_flaggedcheckbox" name="' . $QuestionID . '_flaggedcheckbox" value="1" ' . $flagged . '/>';
        //*<input type="hidden" value="qaid=16821&amp;qubaid=873&amp;qid=55&amp;slot=1&amp;checksum=6e752fddd87489abd0ec093720443089&amp;sesskey=JiVfZNWBDK&amp;newstate=" class="questionflagpostdata" /> I DONT KNOW WHAT THIS IS FOR
        //echo '<label id="' . $QuestionID . '_flaggedlabel" for="' . $QuestionID . '_flaggedcheckbox">';
        //echo '<img alt=' . $Index . ' src="http://asap-training.com/theme/image.php?theme=aardvark&amp;component=core&amp;rev=1415027139&amp;image=i%2Funflagged" alt="Not flagged" id="' . $Index . ':flaggedimg" /></label></div>';
    }

    function preprocess($usersanswer, $correctanswer) {
        $correct = "missing";
        if (is_object($usersanswer)) {
            $correct = "incorrect";
            if ($usersanswer->Answer == -1) {
                $correct = "missing";
            } elseif ($correctanswer == $usersanswer->Answer) {
                $correct = "correct";
            }
        }
        return $correct;
    }

    function FullQuestion($strings, $QuizID, $text, $answers, $index = 0, $markedOutOf = "1.00", $usersanswer, $correctanswer) {
        global $question;
        $question += 1;
        $correct = "incorrect";
        if (is_object($usersanswer)) {
            if ($usersanswer->Answer == -1) {
                $correct == "missing";
            }
        }
        question($strings, 0);
        questionheader($strings, $QuizID, $question, $markedOutOf, $index, $usersanswer);
        question($strings, 1);
        if (answers($strings, $QuizID, $question, $text, $answers, $index, $usersanswer, $correctanswer)) {
            $correct = "correct";
        }
        question($strings, 2);
        return $correct;
    }

    if (is_object($useranswers)) {
        if ($results["missing"] < $results["total"]) {
            PrintResults($strings, $results, $user);
        }
    }

    function PrintResults($strings, $results, $user) {
        if ($results['total'] > 0) {//http://localhost/veritas3/img/profile/172647_974786.jpg
            //debug($user); <label class="control-label">Profile Type : </label>
            echo '<div class="row"><div class="col-md-12"><div class="portlet box yellow"><div class="portlet-title">';
            echo '<div class="caption"><i class="fa fa-graduation-cap"></i>';
            //'Results for: ' . ucfirst($user->fname) . " " . ucfirst($user->lname) . " (" . ucfirst($user->username) . ") on " . $results['datetaken'] ;
            echo ProcessVariables("training_resultsfor", $strings["training_resultsfor"], array("fname" => ucfirst($user->fname), "lname" => ucfirst($user->lname), "username" => ucfirst($user->username), "date" => $results['datetaken']));

            echo '</div></div><div class="portlet-body"><div class="row">';
            echo '<div class="col-md-2"><img src="../img/profile/' . $user->image . '" style="max-height: 100px; max-width: 100px;"></div>';
            PrintResult($strings["training_incorrect"], $results['incorrect']);
            PrintResult($strings["training_missing"], $results['missing']);
            PrintResult($strings["training_correct"], $results['correct']);
            $score = $results['correct'] / $results['total'] * 100;
            PrintResult($strings["training_score"], round($score, 2) . "%");
            if ($score >= $results['pass']) {
                PrintResult($strings["training_grade"], "<font color='green'>" . $strings["training_pass"] . "</A>");
            } else {
                PrintResult($strings["training_grade"], "<font color='red'>" . $strings["training_fail"] . "</A>");
            }
            echo '</font></div>';
            if ($score >= $results['pass']) {

                //     echo $this->request->webroot;
                //   echo $this->request->webroot; die();


          //      $link232 = $this->request->webroot . 'training/certificate?quizid=' . $_GET['quizid'] . '&userid=' . $user->id;
                $link232 = 'certificate?quizid=' . $_GET['quizid'] . '&userid=' . $user->id;

                echo '<CENTER><a class=" btn btn-danger" href="' . $link232 . '">' . $strings["training_viewcertificate"] . '</A></CENTER>';

            }
            echo '</div></div>';
        }
    }

    function usersanswer($useranswers, $questionid){
        if (isset($useranswers)) {
            foreach ($useranswers as $answers) {
                if ($answers->QuestionID == $questionid) {return $answers;}
            }
        }
    }

    function PrintResult($name, $number){
        echo '<div class="col-md-2"><label class="control-label">' . $name . ': </label><BR><DIV align="center"><H2>' . $number . '</H2></div></div>';
    }

    $results = array("incorrect" => 0, "missing" => 0, "correct" => 0, "total" => 0);
    echo '<form action="quiz?quizid=' . $_GET["quizid"] . '" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="responseform">';


    foreach ($questions as $question) {
        $question = clean($question, 1);
        $answer = usersanswer($useranswers, $question->QuestionID);
        $result = FullQuestion($strings, $QuizID, $question->Question, array($question->Choice0, $question->Choice1, $question->Choice2, $question->Choice3, $question->Choice4, $question->Choice5), $question->QuestionID, "1.00", $answer, $question->Answer);
        //$results[$result] += 1;
        //$results["total"] += 1;
    }
    if (is_object($answer)) {
        //PrintResults($strings, $results, $user);
    } else {
        echo '<DIV align="center"><button type="submit" class="btn blue" style="margin-bottom: 15px;" onclick="return confirm(' . "'" . $strings["training_areyousure"] . "'" . ');"><i class="fa fa-check"></i> ' . $strings["forms_save"] . '</button></DIV>';
    }
    echo "</form>";
    //}
?>

</div></div></div></div></div>