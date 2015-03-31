<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") { include_once('/subpages/api.php'); } else { include_once('subpages/api.php'); }

class TrainingController extends AppController {
    public function nopermissions(){ return "You can not edit courses."; }
    //my pages\actions
    public function index()
    {
        if (isset($_GET["action"])) {
            if ($this->canedit()) {
                switch ($_GET["action"]) {
                    case "delete":
                        $this->deletequiz($_GET["quizid"]);
                        break;
                }
            } else {
                $this->Flash->error($this->nopermissions());
            }
        }
        $this->set('hasusertakenquiz', false);
        if (isset($_GET["quizid"])){
            $this->set('hasusertakenquiz', $this->hasusertakenquiz($_GET["quizid"], $this->getuserid() ));
            $this->set('results', $this->evaluateuser($_GET["quizid"],$this->getuserid() ));
            $this->getprofile($this->getuserid());
        }
        $this->set('enrolledquizzes', $this->enumenrolledquizzes($this->getuserid()));
        $this->enumquizes();
        $this->set('canedit', $this->canedit());
    }

    public function edit(){
        $this->set('canedit', $this->canedit());
        if (isset($_GET["action"])){
            if($this->canedit()) {
                switch ($_GET["action"]) {
                    case "delete":
                        $this->deletequestion($_GET["quizid"], $_GET["QuestionID"]);
                        break;
                    case "save":
                        $lastid = $this->savequiz($_POST);
                        if($lastid){$this->redirect('/training/edit?quizid=' . $lastid); }
                        break;
                }
            } else {
                $this->Flash->error($this->nopermissions());
            }
        }

        if (isset($_GET["quizid"]) && $this->canedit()) {
            //$table = TableRegistry::get('training_list');
            $quiz = $this->getQuizHeader($_GET["quizid"]);// $table->find()->where(['ID'=>$_GET["quizid"]])->first();
            $this->set('quiz',$quiz );
            $this->quiz();
        }
    }

    public function users(){
        if ($this->canedit()){
            if (isset($_GET["quizid"])) {
                if (isset($_GET['userid'])){
                    $action="unenroll";
                    if (isset($_GET["action"])){ $action = $_GET["action"];}
                    switch($action){
                        case "unenroll":
                            $this->unenrolluser($_GET["quizid"], $_GET['userid']);
                            $this->Flash->success('The user was unenrolled');
                            break;
                        case "deleteanswers":
                            $this->deleteanswers($_GET['userid'],$_GET["quizid"]);
                            $this->Flash->success("The user's answers for this quiz were deleted");
                            break;
                    }

                }
                $this->enumusers($_GET["quizid"]);
                $this->set('users2', $this->enumenrolledusers($_GET["quizid"]));
            } else {
                $this->enumquizes(true);
            }
        } else{
            $this->Flash->error($this->nopermissions());
        }
        $this->set('canedit', $this->canedit());
    }

    public function quiz(){
        $answers =  $this->getQuiz($_GET["quizid"]);
        $this->set('questions', $answers);
        if (count($_POST)>0){ $this->saveanswers($this->getuserid(), $answers, $_POST); }
        $userid = $this->getuserid();
        if ($this->canedit() && isset($_GET["userid"])){ $userid = $_GET["userid"];}
        $this->enumanswers($_GET["quizid"], $userid);
        $this->set('canedit', $this->canedit());
        $this->set('results', $this->evaluateuser($_GET["quizid"],$userid));
        $this->getprofile($userid);
    }

    public function video(){}//just a simple video player

    public function editquestion(){
        if ($this->canedit()){
            switch($_GET["action"]){
                case "save":
                    $this->savequestion($_POST);
                    break;
                case "delete":
                    $this->deletequestion($_GET["quizid"], $_GET["QuestionID"]);
                    break;
            }
            if (isset($_GET["QuestionID"])) {
                //echo "quizID= " . $_GET["quizid"] . " questionid=" . $_GET["QuestionID"];
                $table = TableRegistry::get('training_quiz');
                $quiz =  $table->find()->where(['QuizID'=>$_GET["quizid"], 'QuestionID'=> $_GET["QuestionID"]])->first();
                $this->set('question',$quiz );
            }
        } else {
            $this->Flash->error($this->nopermissions());
        }
        $this->set('canedit', $this->canedit());
    }

    public function certificate(){
        $userid = $this->getuserid();
        if (isset($_GET["userid"])){ $userid = $_GET["userid"];}
        $this->getprofile($userid);
        if (isset($_GET["quizid"])) {
            $quiz = $this->getQuizHeader($_GET["quizid"]);// $table->find()->where(['ID'=>$_GET["quizid"]])->first();
            $this->set('quiz', $quiz);
            $this->set("date", $this->getanswereddate($_GET["quizid"], $userid));
        }
        $this->set('canedit', $this->canedit());
    }







    //my API
    public function i2($post){
        foreach($post as $key => $value){//($temp=0; $temp<count($post); $temp+=1){
            //if (!is_numeric($post[$temp])) { $post2[$temp] = $this->clean($post[$temp]);  }
            if (!is_numeric($value) || $value == true) { $post2[$key] = $this->clean($value);  } else {$post2[$key] = $value;}
        }
        return $post2;
    }
    public function clean($text){
        return '"' . mysql_real_escape_string(trim($text)) . '"';
    }
    public function unclean($data){
        if (substr($data,0,1)== '"' && substr($data,-1) == '"'){$data = substr($data,1, strlen($data)-2);}
        $data = str_replace("\\r\\n", "\r\n", (trim($data))) ;
        return $data;
    }
    public function canedit(){
        return  $this->request->session()->read('Profile.super') or $this->request->session()->read('Profile.admin');
    }
    public function getuserid(){
        return $this->request->session()->read('Profile.id');
    }
    public function enumquizes($getapplicants = false){
        $table = TableRegistry::get('training_list')->find('all');
        if ($getapplicants){
               foreach($table as $quiz){
                   $quiz->applicants = $this->countapplicants($quiz->ID);
               }
        }
        $this->set('quizes',$table );
        return $table;
    }
    public function countapplicants($quizid){
        $table = TableRegistry::get("training_answers");
        $users =  $table->find('all',array('conditions' => array('QuizID' => $quizid), 'group' => 'UserID'));
        return $this->countobject($users);
    }
    public function countobject($object){
        return iterator_count($object);
    }

    public function getQuizHeader($QuizID){
        $table = TableRegistry::get('training_list');
        $quiz =  $table->find()->where(['ID'=>$QuizID])->first();
        return $quiz;
    }
    public function getQuiz($QuizID){
        $table = TableRegistry::get('training_quiz');
        //$answers =  $table->find()->where(['QuizID'=>$_GET["quizid"]]);
        $answers =  $table->find('all', array('conditions' => array('QuizID' => $QuizID), 'order' => array('QuestionID ASC') ));
        //$this->set('quizid',$_GET["quizid"]);
        //$answers= $this->paginate($answers);
        return $answers;
    }
    public function deletequiz($quizID){
        $table = TableRegistry::get('training_list');
        $table->deleteAll(array('ID' => $quizID), false);
        $table = TableRegistry::get('training_quiz');
        $table->deleteAll(array('QuizID' => $quizID), false);
        $table = TableRegistry::get('training_answers');
        $table->deleteAll(array('QuizID' => $quizID), false);
        $this->Flash->success('The quiz was deleted.');
    }
    public function deletequestion($QuizID, $QuestionID){
        $table = TableRegistry::get('training_quiz');
        $table->deleteAll(array('QuizID' => $QuizID, 'QuestionID' => $QuestionID), false);
        $table = TableRegistry::get('training_answers');
        $table->deleteAll(array('QuizID' => $QuizID, 'QuestionID' => $QuestionID), false);
        $this->Flash->success('The question was deleted.');
    }
    public function savequiz($post){//ID Name Description Attachments image
        $table = TableRegistry::get('training_list');
        $post=$this->i2($post);
        if (isset($post["ID"])){
            $table->query()->update()->set(['Name' => $post["Name"], 'Description' =>  $post["Description"], 'Attachments' => $post['Attachments'], 'image' => $post['image']])
                ->where(['ID' => $post["ID"]])
                ->execute();
            $this->Flash->success('The quiz was edited');
            return -1;
        } else { //new
            $table->query()->insert(['Name', 'Description', 'Attachments', 'image'])
             ->values(['Name' => $post["Name"], 'Description' => $post["Description"], 'Attachments' => $post['Attachments'], 'image' => $post['image']])->execute();
            $lastID = $this->newestquiz($post["Name"],$post["Description"],$post['Attachments'],$post['image']);
            $this->Flash->success('The quiz was created');
            return $lastID;
        }
    }

    public function newestquiz($Name, $Description, $Attachments, $image){
        $table = TableRegistry::get('training_list');
        $quiz =  $table->find('all', array('conditions' => array(['Name' => $Name, 'Description' =>  $Description, 'Attachments' => $Attachments, 'image' => $image]),'order' => array('ID' => 'DESC')))->first();
        if($quiz) {return $quiz->ID;}
    }

    public function savequestion($post){
        //$post=$this->i2($post);
        $table = TableRegistry::get('training_quiz');
        if($post['new'] == "true") {
            $table->query()->insert(['Question', 'QuizID', 'QuestionID', 'Answer', 'Choice0', 'Choice1', 'Choice2', 'Choice3', 'Choice4', 'Choice5', 'Picture'])
                ->values(['Question' => $post["Question"], 'QuizID' => $post["QuizID"], 'QuestionID' => $post['QuestionID'], 'Answer' => $post['answer'], 'Choice0' => $post['Choice0'], 'Choice1' => $post['Choice1'], 'Choice2' => $post['Choice2'], 'Choice3' => $post['Choice3'], 'Choice4' => $post['Choice4'], 'Choice5' => $post['Choice5'], 'Picture' => $post['Picture']])
                ->execute();
            $this->Flash->success('The question was created');
        }else{
            print_r($post);
            $table->query()->update()->set(['Question' => $post["Question"], 'Answer' => $post['answer'], 'Choice0' => $post['Choice0'], 'Choice1' => $post['Choice1'], 'Choice2' => $post['Choice2'], 'Choice3' => $post['Choice3'], 'Choice4' => $post['Choice4'], 'Choice5' => $post['Choice5'], 'Picture' => $post['Picture']])
                ->where(['QuizID' => $post['QuizID'], 'QuestionID' => $post['QuestionID']])->execute();
            $this->Flash->success('The question was saved');
        }
    }

    function lastQuery(){
        $dbo = $this->getDatasource();
        $logs = $dbo->_queriesLog;
        // return the first element of the last array (i.e. the last query)
        return current(end($logs));
    }

    public function hasusertakenquiz($QuizID, $UserID){
        $table = TableRegistry::get("training_answers");
        $options = array();
        $options['conditions'] = array('training_answers.QuizID = ' . $QuizID . ' AND training_answers.UserID = ' . $UserID);
        $options['group'] = 'training_answers.UserID';
        $users =  $table->find('all', $options)->first();
        return is_object($users);
    }
    public function enumusers($QuizID){//LEFT JOIN IS A PAIN!
        //$this->loadModel('TrainingAnswers');
        $table = TableRegistry::get("training_answers");
        $options = array();
        $options['conditions'] = array('training_answers.QuizID =' . $QuizID); //array('QuizID' => $QuizID);
        //$options['fields'] =  array('UserID');// 'profiles.fname', 'profiles.lname', 'profiles.username');
        //$options['joins'] = array(array('table' => 'profiles', 'alias' => 'profiles', 'type' => 'LEFT', 'conditions' => array('training_answers.UserID = profiles.id')));
        $options['group'] = 'training_answers.UserID';
        $users =  $table->find('all', $options)->contain("profiles");//->where(['training_answers.QuizID = ' . $QuizID . ' or 1=1'])
            //$users =  $table->find('all', array('conditions' => array('QuizID' => $QuizID), 'fields' =>  array('training_answers.UserID', 'profiles.fname', 'profiles.lname', 'profiles.username'), 'group' => 'training_answers.UserID', 'joins' => array(array('table' => 'profiles', 'alias' => 'profiles', 'type' => 'LEFT', 'conditions' => array('training_answers.UserID = profiles.id')))));
        $quiz = $this->getQuiz($QuizID);
        foreach($users as $user){
            $score = $this->gradetest($quiz,$QuizID, $user->UserID);
            //$user->questions = $score['questions'] ;
            //$user->correct = $score['correct'] ;
            //$user->percent = $score['percent'] ;
            $user->profile = $score;
        }
        $this->set('users',$users);
        /*
        foreach($users as $o){
            debug($o);//->profile->fname;
        }
        die();

        $users2= array();
        $table = TableRegistry::get("profiles");
        $options = array();
        foreach($users as $user){
            $options['conditions'] = array('id' => $user->UserID);
            $userdata=$table->find('all',$options)->first();
            $score = $this->gradetest($quiz,$QuizID, $user->UserID);
            print_r($score);
            $userdata->questions = $score['questions'] ;
            $userdata->correct = $score['correct'] ;
            $userdata->percent = $score['percent'] ;
            $users2[$user->UserID] = $userdata;
        }
        $this->set('users',$users2);
        */
    }

    public function gradetest($Quiz, $QuizID, $UserID){
        $answers = $this->enumanswers($QuizID, $UserID);
        $questions=0;
        $correct=0;
        $percent=0;
        foreach($Quiz as $question){
            foreach($answers as $answer) {
                if ($answer->QuestionID == $question->QuestionID) {
                    if ($question->Answer == $answer->Answer) {
                        $correct += 1;
                    }
                    $questions += 1;
                    continue;
                }
            }
        }
        if ($questions >0) { $percent = $correct/$questions*100;}
        return array('questions' => $questions, 'correct' => $correct, 'percent' => $percent);
    }

    public function getanswereddate($QuizID, $UserID){
        $table = TableRegistry::get("training_answers");
        $quiz =  $table->find('all', array('conditions' => array(['QuizID'=>$QuizID, 'UserID'=>$UserID]), 'order' => array('QuestionID ASC') ))->first();
        return $quiz->created;
    }

    public function enumanswers($QuizID, $UserID){
        $table = TableRegistry::get("training_answers");
        $quiz =  $table->find('all', array('conditions' => array(['QuizID'=>$QuizID, 'UserID'=>$UserID]), 'order' => array('QuestionID ASC') ));
        $this->set('useranswers',$quiz);
        return $quiz;
    }

    public function saveanswers($UserID, $Quiz, $Post){
        //debug($Quiz);
        $answers=0;
        $correct=0;
        foreach($Quiz as $question){//QuizID QuestionID
            $QuizID=$question->QuizID;
            $QuestionName = $question->QuizID . ":" . $question->QuestionID;
            $Answer = $Post[$QuestionName . "_answer"];
            $Flagged = false;
            if (isset($Post[$QuestionName . "_flaggedcheckbox"])){ $Flagged = $Post[$QuestionName . "_flaggedcheckbox"] == 1;}

            //echo "<P></P><BR>UserID: " . $UserID;
            //echo "<BR>Quiz ID: " . $question->QuizID;
            //echo "<BR>Question ID: " . $question->QuestionID;
            //echo "<BR>Answer: " . $Answer;
            //echo "<BR>Flagged: " . $Flagged ;
            if($question->Answer == $Answer){ $correct++;}
            $this->saveanswer($UserID, $question->QuizID, $question->QuestionID, $Answer, $Flagged);
            $answers+=1;
        }
        if($answers>0) {
            $profile=$this->getprofile($UserID);
            $score = round($correct / $answers * 100, 2);
            $message = $profile->username . " did not pass the course";
            if ($score>=50) { $message = $profile->username . " passed! <A href='Http://" . getHost() ;
                if (getHost("localhost") == "localhost") {
                    $appname =  $_SERVER['PHP_SELF'];
                    $slash = strpos($appname, "/", 2);
                    $appname = substr($appname, 0, $slash );
                    $message.=$appname;
                }
                $message.= "/training/certificate?quizid=" . $QuizID . "&userid=" . $UserID . "'>Click here to view your certificate</A>";
            }
            $message.= "<BR>You had a score of " . $score . "%";
            //$users = array($UserID, $this->whoenrolled($QuizID,$UserID ))
            $users = $this->enumsupers();
            $users[] = $UserID;
            $this->email($users, "IBMEE Course completion", $message);
            //http://localhost/veritas3/training/certificate?quizid=1
            $this->Flash->success($answers . ' answers were saved');
        }
    }

    public function email($to, $subject, $message){
        if(is_array($to)){
            foreach($to as $address){
                $this->email($address, $subject, $message);
            }
        } else {
            if(is_numeric($to)){
                $profile=$this->getprofile($to);
                $to=$profile->email;
            }
            if ($to) {
                if($to== "neotechni@gmail.com") {$to="roy@trinoweb.com";}
                $from = array('info@' . getHost("isbmee.com") => "ISB MEE");
                $this->Mailer->sendEmail($from, $to, $subject, $message);
            }
        }
    }

    public function deleteanswers($UserID, $QuizID){
        $table = TableRegistry::get("training_answers");
        $table->deleteAll(array('UserID'=>$UserID, 'QuizID'=>$QuizID), false);
    }
    public function saveanswer($UserID, $QuizID, $QuestionID, $Answer, $Flagged){
        $table = TableRegistry::get("training_answers");
        //$results = $table->find('all', array('conditions' => array('UserID'=>$UserID, 'QuizID'=>$QuizID, 'QuestionID'=> $QuestionID)))->first();
        $table->deleteAll(array('UserID'=>$UserID, 'QuizID'=>$QuizID, 'QuestionID'=> $QuestionID), false);
        //if(!$results) {
            $table->query()->insert(['UserID', 'QuizID', 'QuestionID', 'Answer', 'flagged', 'created'])
                ->values(['UserID' => $UserID, 'QuizID' => $QuizID, 'QuestionID' => $QuestionID, 'Answer' => $Answer, 'flagged' => $Flagged, 'created' => date("Y-m-d H:i:s")])->execute();
        //}else{
        //    $table->query()->update()->set(['UserID' => $UserID, 'QuizID' => $QuizID, 'QuestionID' => $QuestionID, 'Answer' => $Answer, 'flagged' => $Flagged])
        //        ->where(['UserID'=>$UserID, 'QuizID'=>$QuizID, 'QuestionID'=> $QuestionID])->execute();
        //}
    }
    public function getprofile($UserID, $set=true){
        $table = TableRegistry::get("profiles");
        $results = $table->find('all', array('conditions' => array('id'=>$UserID)))->first();
        if ($set) { $this->set('user',$results); }
        return $results;
    }

    public function assignContact($contact,$id,$status){
        file_put_contents("log.txt", "Contact: " . $contact .  " " . $id . " " . $status . "\r\n", FILE_APPEND);
    }
    public function assignProfile($profile,$id,$status){
        if ($status=="yes"){
            $this->enrolluser($id, $profile);
        } else {
            $this->unenrolluser($id, $profile);
        }
        die();
    }
    public function returnJSON($success){
        header('Content-type: application/json');
        $response_array=array();
        if($success){
            $response_array['status'] = 'success';
        }else {
            $response_array['status'] = 'error';
        }
        echo json_encode($response_array);
    }

    public function enrolluser($QuizID, $UserID){
        if(!$this->isuserenrolled($QuizID, $UserID)){
            $EnrolledBy = $this->getuserid();

            $table = TableRegistry::get("training_enrollments");
            $table->query()->insert(['QuizID', 'UserID'])->values(['QuizID' => $QuizID, 'UserID' => $UserID, 'EnrolledBy' => $EnrolledBy])->execute();

            $table = TableRegistry::get('sidebar');
            $table->query()->update()->set(['training' => 1])->where(['user_id' => $UserID])->execute();
            return true;
        }
    }
    public function unenrolluser($QuizID, $UserID){
        $table = TableRegistry::get("training_enrollments");
        $table->deleteAll(array('QuizID' => $QuizID, 'UserID' => $UserID), false);
    }
    public function enumenrolledusers($QuizID){
        $table = TableRegistry::get("training_enrollments");
        $results = $table->find('all', array('conditions' => array('QuizID'=>$QuizID)))->contain("profiles");
        return $results;
    }
    public function isuserenrolled($QuizID, $UserID){
        $table = TableRegistry::get("training_enrollments");
        $results = $table->find('all', array('conditions' => array('QuizID'=>$QuizID, 'UserID'=>$UserID)))->first();
        return is_object($results);
    }

    public function whoenrolled($QuizID, $UserID){
        $table = TableRegistry::get("training_enrollments");
        $results = $table->find('all', array('conditions' => array('QuizID' => $QuizID, 'UserID'=>$UserID), 'fields' => array('EnrolledBy')))->first();
        if ($results) { return $results->EnrolledBy;}
        return false;
    }

    public function enumenrolledquizzes($UserID){
        $table = TableRegistry::get("training_enrollments");
        $results = $table->find('all', array('conditions' => array('UserID'=>$UserID), 'fields' => array('QuizID')));
        return $results;
    }

    public function enumsupers($fieldname = "email"){
        $table = TableRegistry::get("profiles");
        $results = $table->find('all', array('conditions' => array('super'=>1)));
        $users=array();
        foreach($results as $user){
            $users[] = $user->$fieldname;
        }
        return $users;
    }

    function evaluateuser($QuizID, $UserID){
        $useranswers = $this->enumanswers($QuizID, $UserID);
        if (!is_object($useranswers)){ return ""; }
        $questions = $this->getQuiz($QuizID);
        $results = array("incorrect" => 0, "missing" => 0, "correct" => 0, "total" => 0, "datetaken" => $this->getdatetaken($useranswers));
        foreach ($questions as $question) {
            $result = $this->preprocess($this->usersanswer($useranswers, $question->QuestionID), $question->Answer);
            $results[$result] += 1;
            $results["total"] += 1;
        }
        return $results;
    }

    function preprocess($usersanswer, $correctanswer){
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
    function getdatetaken($useranswers){
        foreach ($useranswers as $answers) {
            if ($answers->created) { return $answers->created; }
        }
    }

    function usersanswer($useranswers, $questionid){
        if (isset($useranswers)) {
            foreach ($useranswers as $answers) {
                if ($answers->QuestionID == $questionid) {return $answers;}
            }
        }
    }






//API stolen from profilescontroller
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Settings');
        $this->loadComponent('Mailer');
    }
    public $paginate = [
        'limit' => 20,
        'order' => ['id' => 'DESC'],
    ];
    public function enroll() {
        if (isset($_GET["userid"]) AND isset($_GET["quizid"])) {//enrolluser
            if ($this->enrolluser($_GET["quizid"], $_GET["userid"])){
                $this->Flash->success(ucfirst($this->getprofile($_GET["userid"], false)->username) . ' was enrolled in ' . $this->unclean($this->getQuizHeader($_GET["quizid"])->Name));
            } else {
                $this->unenrolluser($_GET["quizid"], $_GET["userid"]);
                $this->Flash->success(ucfirst($this->getprofile($_GET["userid"], false)->username) . ' was unenrolled from ' . $this->unclean($this->getQuizHeader($_GET["quizid"])->Name));
            }
        }

        if(isset($_GET["new"])) {
            $users=$this->enumenrolledusers($_GET["quizid"]);
            $contacts=array();
            foreach($users as $user){
                $contacts[] = $user->UserID;
            }
            $this->set('profile', $contacts);
        }else {
            $this->set('doc_comp', $this->Document);
            $setting = $this->Settings->get_permission($this->request->session()->read('Profile.id'));
            $u = $this->request->session()->read('Profile.id');
            $this->set('ProClients', $this->Settings);
            $super = $this->request->session()->read('Profile.super');
            $condition = $this->Settings->getprofilebyclient($u, $super);
            if ($setting->profile_list == 0) {
                $this->Flash->error('Sorry, you don\'t have the required permissions.');
                return $this->redirect("/");
            }
            if (isset($_GET['draft'])) {
                $draft = 1;
            } else {
                $draft = 0;
            }
            $cond = 'drafts = ' . $draft;
            if (isset($_GET['searchprofile'])) {
                $search = $_GET['searchprofile'];
                $searchs = strtolower($search);
            }

            if (isset($_GET['filter_profile_type'])) {
                $profile_type = $_GET['filter_profile_type'];
            }
            if (isset($_GET['filter_by_client'])) {
                $client = $_GET['filter_by_client'];
            }
            $querys = TableRegistry::get('Profiles');

            if (isset($_GET['searchprofile']) && $_GET['searchprofile']) {
                if ($cond == '') {
                    $cond = $cond . ' (LOWER(title) LIKE "%' . $searchs . '%" OR LOWER(fname) LIKE "%' . $searchs . '%" OR LOWER(lname) LIKE "%' . $searchs . '%" OR LOWER(username) LIKE "%' . $searchs . '%" OR LOWER(address) LIKE "%' . $searchs . '%")';
                } else {
                    $cond = $cond . ' AND (LOWER(title) LIKE "%' . $searchs . '%" OR LOWER(fname) LIKE "%' . $searchs . '%" OR LOWER(lname) LIKE "%' . $searchs . '%" OR LOWER(username) LIKE "%' . $searchs . '%" OR LOWER(address) LIKE "%' . $searchs . '%")';
                }
            }

            if (isset($_GET['filter_profile_type']) && $_GET['filter_profile_type']) {
                if ($cond == '') {
                    $cond = $cond . ' (profile_type = "' . $profile_type . '" OR admin = "' . $profile_type . '")';
                } else {
                    $cond = $cond . ' AND (profile_type = "' . $profile_type . '" OR admin = "' . $profile_type . '")';
                }
            }
            if (isset($_GET['filter_by_client']) && $_GET['filter_by_client']) {
                $sub = TableRegistry::get('Clients');
                $que = $sub->find();
                $que->select()->where(['id' => $_GET['filter_by_client']]);
                $q = $que->first();
                $profile_ids = $q->profile_id;
                if (!$profile_ids) {
                    $profile_ids = '99999999999';
                }
                if ($cond == '') {
                    $cond = $cond . ' (id IN (' . $profile_ids . '))';
                } else {
                    $cond = $cond . ' AND (id IN (' . $profile_ids . '))';
                }
            }
            if ($this->request->session()->read('Profile.profile_type') == '2' && !$cond) {
                $condition['created_by'] = $this->request->session()->read('Profile.id');
            }
            if ($cond) {
                $query = $querys->find();
                $query = $query->where([$cond]);
            } else {
                $query = $this->Profiles->find()->where(['OR' => $condition, 'AND' => 'super = 0']);
            }
            if (isset($search)) {
                $this->set('search_text', $search);
            }
            if (isset($profile_type)) {
                $this->set('return_profile_type', $profile_type);
            }
            if (isset($client)) {
                $this->set('return_client', $client);
            }
            $query= $this->paginate($query);
            foreach($query as $profile){
                $profile->isenrolled = $this->isuserenrolled($_GET["quizid"], $profile->id);
            }
            $this->set('profiles',$query);
        }
    }
}