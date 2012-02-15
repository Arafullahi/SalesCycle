<?php

	class projectsController extends Controller {

		public function client() {
			$client_id = $this->getP3();

			if(!$client_id) {
				location('/clients');
			}

			$clients = new clients($this->getDb());
			$projects = new projects($this->getDb());

			$client = $clients->select('*', 'WHERE id="' . $client_id . '"');
			$this->set('client', $client);

			$project_list = $projects->select('*', 'WHERE client_id="' . $client_id . '" ORDER BY created DESC');
			$this->set('project_list', $project_list);
		}

		public function edit() {
			$client_id = $this->getP3();
			$this->set('client_id', $client_id);
			$project_id = $this->getP4();

			$clients = new clients($this->getDb());
			$projects = new projects($this->getDb());

			$method = $this->getPostValue('method');
			if($method == 'sales.projects.edit') {
				$client_id = $this->getPostValue('client_id');
				$project_id = $this->getPostValue('project_id');
				$project_name = $this->getPostValue('project_name');
				display($project_name);

				if( $client_id < 1 ) {
					location('/clients');
				} else {
					if( $project_id > 0 ) {
						// Update project name
						$return = $projects->update(array(
								'name' => $project_name
							), 'WHERE id="' . $project_id . '"');
							display($return);
					} else {
						// Create a new project
						$projects->insert(array(
								'client_id' => $client_id,
								'name' => $project_name,
								'created' => time()
							));
					}
					location('/projects/client/' . $client_id);
				}
			}

			if($client_id < 1) {
				location('/clients');
			}

			$client = $clients->select('*', 'WHERE id="' . $client_id . '"');
			if(isset($client[0]['id'])) {
				$this->set('client', $client[0]);
			} else {
				$this->set('client', $client);
			}

			if($project_id == 0) {
				$this->set('project', array());
			} else {
				$project = $projects->select('*', 'WHERE id="' . $project_id . '"');
				if(isset($project[0]['id'])) {
					$this->set('project', $project[0]);
				} else {
					$this->set('project', array());
				}
				
			}

		}

	}

?>
