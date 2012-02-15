<?php

	class clientsController extends Controller {

		public function base() {
			$clients = new clients($this->getDb());
			$clients->leftjoin('projects', 'projects.client_id = clients.id');

			$sort = $this->getGetValue('sort');

			$sort_by = 'clients.name';
			if($sort == 'date') $sort_by = 'clients.created DESC';

			$list = $clients->select('clients.id, clients.name, clients.company, clients.email, clients.created, COUNT(*) AS projects_id_count, projects.id', 'GROUP BY clients.id ORDER BY ' . $sort_by);
			$this->set('list', $list);
		}

		public function edit() {
			$client_id = $this->getP3();
			$this->set('client_id', $client_id);
			$clients = new clients($this->getDb());

			$method = $this->getPostValue('method');
			if($method == 'sales.clients.edit') {
				$id = $this->getPostValue('id');
				$name = $this->getPostValue('name');
				$company = $this->getPostValue('company');
				$email = $this->getPostValue('email');

				if($id > 0) {
					// Update client
					$clients->update(array(
							'name' => $name,
							'company' => $company,
							'email' => $email
						), 'WHERE id="' . $id . '"');
				} else {
					// Add new client
					$clients->insert(array(
							'name' => $name,
							'company' => $company,
							'email' => $email,
							'created' => time()
						));
				}
				location('/clients');
			}
			
			$data = $clients->select('*', 'WHERE id="' . $client_id. '"');

			if( !isset($data[0]['id']) ) {
				$this->set('data', $data);
			} else {
				$this->set('data', $data[0]);
			}
		}

	}

?>
