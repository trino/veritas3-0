<?php
/**
 * Created by PhpStorm.
 * User: Van
 * Date: 4/15/2015
 * Time: 1:44 PM
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;


class TransComponent extends Component {
    //http://www.onlamp.com/pub/a/php/2002/06/13/php.html
    //http://stackoverflow.com/questions/1450037/how-to-load-language-with-gettext-in-php
    // I18N support information here
    /*  code doesn't work for french
    function setup(){
        $language = $this->request->session()->read('Profile.language');

        $acceptablelanguages = array("en_US", "fr_FR");
        if (!in_array($language, $acceptablelanguages)) {
            $language = $acceptablelanguages[0];
        }//default to english

        putenv("LANG=$language");
        putenv("LANGUAGE=$language");
        putenv("LC_ALL=$language");
        setlocale(LC_ALL, $language);

        // Set the text domain as 'messages'
        $domain = 'default';
        bindtextdomain($domain, "C:/wamp/www/veritas3-0/Locale");//www/veritsa3-0/,   Locale
        textdomain($domain);
    }
    */
    public function getLanguage($UserID = ""){
        if($UserID) {
            if (is_numeric($UserID)) {//is a number, use it as a user id
                $Table = TableRegistry::get('profiles')->find()->select()->where(["id" => $UserID])->first()->language;
            } else {//is not a number, assume it's a language
                return ucfirst($UserID);
            }
        } else{//the user is logged in, use session variable

        }
        if($Table){return $Table;}
        return "English";//assume english
    }

    public function getString($String, $Variables = "", $UserID=""){
        $Table = TableRegistry::get('strings')->find()->select()->where(["Name" => $String])->first();
        if(!$Table){return "[" . $String . " NOT FOUND]";}
        $language = $this->getLanguage($UserID);
        if($language=="Debug"){return "[" . $String . "]";}
        $text = $Table->$language;
        if(!$text){ return "[" . $String . " is missing the " . $language. " translation]";}
        if(is_array($Variables)){
            foreach($Variables as $Key => $Value){
                if (substr($Key, 0, 1) != "%") {$Key = "%" . $Key;}
                if (substr($Key, -1) != "%") {$Key .= "%";}
                if($language == "Debug"){
                    $text.= " [" . $Key . "=" . $Value . "]";
                } else {
                    $text = str_replace($Key, $Value, $text);
                }
            }
        }
        return $text;
    }
}