<div class='container'>
	<div class='span-24 clients'>
		<h1>
			Add / Edit Client
			&nbsp;
			<small>
				<a href='<?php echo href('/clients') ?>'>back to all clients</a>
				&nbsp; | &nbsp;
				<a href='<?php echo href('/projects/client/' . $this->get('client_id')) ?>'>all projects of this client</a>
			</small>
		</h1>
		<br />
		<form method='post' action=''>
			<?php
				$data = $this->get('data');

				$client_id = _g($data, 'id');
				$client_name = _g($data, 'name');
				$client_company = _g($data, 'company');
				$client_email = _g($data, 'email');
			?>
			<input type='hidden' name='method' value='sales.clients.edit' />
			<input type='hidden' name='id' value='<?php echo $client_id ?>' />
			<div class='label'>Name</div>
			<input type='text' name='name' class='input' value='<?php echo $client_name ?>' />
			<div class='label'>Company</div>
			<input type='text' name='company' class='input' value='<?php echo $client_company ?>' />
			<div class='label'>Email</div>
			<input type='text' name='email' class='input' value='<?php echo $client_email ?>' />
			<br />
			<input type='submit' name='Submit' class='submit' value='Submit' />
		</form>
	</div>
</div>