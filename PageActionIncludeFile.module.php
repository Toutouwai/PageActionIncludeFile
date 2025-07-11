<?php namespace ProcessWire;

class PageActionIncludeFile extends PageAction implements Module {

	protected $filesDir;

	/**
	 * Construct
	 * 
	 */
	public function __construct() {
		parent::__construct();
		$this->filesDir = $this->wire()->config->paths->templates . 'PageActionIncludeFile/';
	}

	/**
	 * Configure
	 * 
	 * @return InputfieldWrapper
	 * 
	 */
	public function ___getConfigInputfields() {
		$modules = $this->wire()->modules;
		$fieldset = parent::___getConfigInputfields();
		$actionFiles = $this->wire()->files->find($this->filesDir, ['extensions' => 'php', 'returnRelative' => true]);
		if($actionFiles) {
			/** @var InputfieldSelect $f */
			$f = $modules->get('InputfieldSelect');
			$f->name = 'selectedAction';
			$f->label = $this->_('Select action file');
			foreach($actionFiles as $actionFile) {
				$label = substr($actionFile, 0, -4);
				$f->addOption($actionFile, $label);
			}
			$f->required = true;
			$fieldset->add($f);
		} else {
			/** @var InputfieldMarkup $f */
			$f = $modules->get('InputfieldMarkup');
			$f->label = $this->_('No action files found');
			$f->value = sprintf($this->_('Add your custom action files to %s.'), '<code>' . $this->wire()->config->urls->templates . 'PageActionIncludeFile/</code>');
			$fieldset->add($f);
		}
		return $fieldset; 
	}

	/**
	 * Run action on the given page
	 * 
	 * @param Page $item
	 * @return bool
	 *
	 */ 
	protected function ___action($item) {
		if($this->selectedAction) {
			$this->wire()->files->include($this->filesDir . $this->selectedAction, ['item' => $item]);
			return true;
		}
		return false; 
	}

	/**
	 * Install
	 */
	public function ___install() {
		// Create PageActionIncludeFile directory
		$this->wire()->files->mkdir($this->filesDir);
	}
	
}

