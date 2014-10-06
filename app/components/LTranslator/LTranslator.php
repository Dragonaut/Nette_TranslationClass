<?php
namespace LTranslator;
use Nette\Application\UI\Control;

class LTranslator extends Control
{
	/** @var \Nette\Database\Context */
    private $db;

	public function __construct(\Nette\Database\Context $database)
    {
        $this->db = $database;
    }

    public function createTranslationFile($language = "cs") 
    {
    	// create an array from database
    	// array('hello' => 'hallo', 'bye' => 'tschüss');
    	$sql = "select t.variable, tr.translation
				from text t
				join text_translations tr on (t.id = tr.textId)
				where tr.language = \"$language\"";

		$texts = $this->db->fetchPairs($sql);//->fetchPairs('variable','translation');
		//a:3:{s:12:"welcome_text";s:8:"Vítejte";s:4:"home";s:5:"Domů";s:7:"contact";s:7:"Kontakt";}
		

		// check if exists folder for language files, if not create it
		if (!file_exists('languages')) {
		    mkdir('languages', 0777, true);
		}

    	// generate language file
    	if ($language == "en")
    		file_put_contents('languages/en.php', gzcompress(serialize($texts)));
    	else 
    		file_put_contents('languages/cs.php', gzcompress(serialize($texts)));
    	
    }

    public function getTranslation($language = "cs") 
    {
    	// loading language file
    	if ($language == "en") {
    		$file_contents = get_contents('languages/en.php');
			return unserialize(gzuncompress($file_contents));
		}
    	else {
    		$file_contents = get_contents('languages/cs.php');
			return unserialize(gzuncompress($file_contents));
    	}
    }


}