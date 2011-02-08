<?php
/*----------------------------------------------------------------------------*/
	
	namespace Apps\Wiki\Actors;
	
	class Open extends \Libs\Actor {
		public function execute(\Libs\DOM\Element $element) {
			parent::execute($element);
			
			$session = \Libs\Session::current();
			$constants = $session->constants();
			$parameters = $session->parameters();
			
			$url = (
				$parameters->{'document-url'} != ''
					? $parameters->{'document-url'}
					: 'index'
			);
			
			try {
				$content = file_get_contents($constants->{'app-dir'} . '/docs/' . $url . '.html');
				$element->nodeValue = htmlentities($content);
				$element->setAttribute('success', 'yes');
			}
			
			catch (\Exception $e) {
				$element->setAttribute('success', 'no');
				$element->setAttribute('message', $e->getMessage());
			}
		}
	}
	
/*----------------------------------------------------------------------------*/
?>