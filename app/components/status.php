<?php

	function getStatusList() {
		$list = array(
				'10' => 'Initial Contact',
				'20' => 'Initial Specifications Discussion',
				'30' => 'Gathering Specifications',
				'40' => 'Got All Specifications',
				'50' => 'Prepare Estimate',
				'60' => 'Sent Final Quote',
				'70' => 'Received Contract',
				'80' => 'Got Quote Confirmation',
				'90' => 'Quote Rejected',
				'100' => 'Got Approval Waiting to start',
				'110' => 'Project In Progress',
				'120' => 'Design Completed',
				'130' => 'Development Completed',
				'140' => 'Testing Completed',
				'150' => 'Closed and Delivered',
				'160' => 'Invoice Sent',
				'170' => 'Problem with Invoice',
				'180' => 'Paid'
			);

		return $list;
	}

?>