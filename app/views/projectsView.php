<?php

	class projectsView extends View {

		public function client() {
			$this->title("Generatrix"); // Any common text should be added to app/settings/config.json in title-text
			$this->description("this is the description");
			$this->add('{ "css" : [ "/public/style/sales.css" ], "js" : [ ] }');

			$this->getBody()->appendContent(
				$this->loadSubView('header') .
				$this->loadSubView('projects') .
				$this->loadSubView('footer')
			);
		}

		public function edit() {
			$this->title("Generatrix"); // Any common text should be added to app/settings/config.json in title-text
			$this->description("this is the description");
			$this->add('{ "css" : [ "/public/style/sales.css" ], "js" : [ ] }');

			$this->getBody()->appendContent(
				$this->loadSubView('header') .
				$this->loadSubView('projects-edit') .
				$this->loadSubView('footer')
			);
		}

	}

?>
