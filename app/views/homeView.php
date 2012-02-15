<?php

	class homeView extends View {

		public function base() {
			$this->title("Generatrix"); // Any common text should be added to app/settings/config.json in title-text
			$this->description("this is the description");
			$this->add('{ "css" : [ "/public/style/sales.css" ], "js" : [ ] }');

			$this->getBody()->appendContent(
				$this->loadSubView('header') .
				$this->loadSubView('body') .
				$this->loadSubView('footer')
			);
		}

		public function update() {
			$this->title("Generatrix"); // Any common text should be added to app/settings/config.json in title-text
			$this->description("this is the description");
			$this->add('{ "css" : [ "/public/style/sales.css" ], "js" : [ "/public/javascript/update.js" ] }');

			$this->getBody()->appendContent(
				$this->loadSubView('header') .
				$this->loadSubView('body-update') .
				$this->loadSubView('footer')
			);
		}

	}

?>
