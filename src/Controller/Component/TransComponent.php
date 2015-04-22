<?php
/**
 * Created by PhpStorm.
 * User: Van
 * Date: 4/15/2015
 * Time: 1:44 PM
 */

namespace App\Controller\Component;


class TransComponent
{
    //http://www.onlamp.com/pub/a/php/2002/06/13/php.html
//http://stackoverflow.com/questions/1450037/how-to-load-language-with-gettext-in-php
// I18N support information here
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
}