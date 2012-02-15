<?php

	//https://mail.google.com/mail/?view=cm&ui=2&tf=0&to=sudhanshu@vxtindia.com&fs=1
	//https://mail.google.com/mail/u/0/?shva=1#label/Nathan+Meisner

	class homeController extends Controller {

		public function base() {
			$projects = new projects($this->getDb());
			$projects->leftjoin('clients', 'projects.client_id = clients.id');
			$projects->leftjoin('status', 'projects.status_id = status.id');

			$type = $this->getP3();
			if(!$type) $type = 'sales';
			$this->set('type', $type);

			$sort = $this->getGetValue('sort');
			if(!$sort) $sort = 'status';

			$sort_by = '';
			if($sort == 'date') {
				$sort_by = 'ORDER BY status.date DESC';
			} else if($sort == 'client') {
				$sort_by = 'ORDER BY clients.name';
			} else if($sort == 'project') {
				$sort_by = 'ORDER BY projects.name';
			} else {
				$sort_by = 'ORDER BY projects.status DESC, projects.status_created DESC';
			}

			$list = $projects->select('projects.id, projects.name, projects.status, projects.created, clients.id, clients.name, clients.company, clients.email, clients.created, status.id, status.status, status.date, status.comment, status.created', $sort_by);
			$this->set('list', $list);
		}

		public function update() {
			$client_id = $this->getP3();
			$project_id = $this->getP4();

			if(!$client_id || !$project_id) {
				location('/home');
			}

			$error = '';

			$projects = new projects($this->getDb());
			$clients = new clients($this->getDb());
			$status = new status($this->getDb());

			$method = $this->getPostValue('method');
			$this->set('method', $method);
			if($method == 'sales.status.update') {

				$client_id = $this->getPostValue('client_id');
				$project_id = $this->getPostValue('project_id');
				$statuscode = $this->getPostValue('status');
				$time = $this->getPostValue('time');
				$comment = $this->getPostValue('comment');
				$link = $this->getPostValue('link');

				$time = strtotime($time);
				if($time === false) {
					$error = 'The time string was not formatted properly';
				} else if($comment == '') {
					$error = 'Please enter a comment';
				} else {
					$new_id = $status->insert(array(
							'client_id' => $client_id,
							'project_id' => $project_id,
							'status' => $statuscode,
							'date' => $time,
							'comment' => $comment,
							'link' => $link,
							'created' => time()
						));
					$new_id = $new_id[0][1];
					$projects->update(array(
							'status' => $statuscode,
							'status_id' => $new_id,
							'status_created' => $time
						), 'WHERE id="' . $project_id . '"');

					location('/home/update/' . $client_id . '/' . $project_id);
				}

			} else if($method == 'sales.status.commupdate') {

				$client_id = $this->getPostValue('client_id');
				$project_id = $this->getPostValue('project_id');
				$time = $this->getPostValue('time');
				$comment = $this->getPostValue('comment');
				
				$time = strtotime($time);
				if($time === false) {
					$error = 'The time string was not formatted properly';
				} else if($comment == '') {
					$error = 'Please enter a comment';
				} else {
					$new_id = $status->insert(array(
							'client_id' => $client_id,
							'project_id' => $project_id,
							'date' => $time,
							'comment' => $comment,
							'created' => time()
						));

					location('/home/update/' . $client_id . '/' . $project_id);
				}
			}

			$client = $clients->select('*', 'WHERE id="' . $client_id . '"');
			if(isset($client[0]['id'])) {
				$this->set('client', $client[0]);
			} else {
				location('/home?1');
			}

			$project = $projects->select('*', 'WHERE id="' . $project_id . '"');
			if(isset($project[0]['id'])) {
				$this->set('project', $project[0]);
			} else {
				location('/home?2');
			}

			$updates = $status->select('*', 'WHERE client_id="' . $client_id . '" AND project_id="' . $project_id . '" ORDER BY created DESC');
			$this->set('updates', $updates);

			$this->set('error', $error);

		}

	}

?>
