<?php

namespace App\Presenters;

use Nette,
	App\Model,
	Ltranslator\Ltranslator;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	/** @var \Nette\Database\Context */
    private $db;

	public function __construct(\Nette\Database\Context $database)
    {
        $this->db = $database;
    }

	public function renderDefault()
	{
		$ltranslator = new LTranslator($this->db);
		$ltranslator->createTranslationFile("cs");
		//$this->template->texts = 'any value';
	}

}
