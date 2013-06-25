<?php



class EmailLookup {
	private $emails = array( array('chuck', 'wolfe', 'chuckwolfe@email.com'),
					array('Susan', 'Orville', 'sorville@pops.com'),
					array('Stacy', 'Lacey', 'slacey@doamin.com'),
					array('Brad', 'Humchucker', 'captainStan@rideglide.com'),
					array('Herbert', 'Stankiver', 'mayorbob@ymail.com'),
					array('Cat', 'Manchester', 'Cmanchester@email.com'));

	private function contains($array_unit, $term) {
		if (stripos($array_unit[0], $term) !== false)
			return true;
		if (stripos($array_unit[1], $term) !== false)
			return true;
		if (stripos($array_unit[2], $term) !== false)
			return true;
		return false;
	}   

	private function queryEmails($search_term) {
		$email_addresses = array();

		foreach ($this->emails AS $email) {
			$email_address = array();
			if ($this->contains($email, $search_term)) {
				$email_address['first_name'] = $email[0];
				$email_address['last_name'] = $email[1];
				$email_address['displayname'] = $email[0] . " " . $email[1];
			
				$email_address['name'] = $email[2];
//had to use name, since i couldn't format my results with 'email'
//seems it only has support for name and id
				$email_addresses[] = $email_address;
			}
		}   
		print json_encode($email_addresses);
	}


	function __construct($search_term) {
		//do i need to inti this list?
		//$email_list = new emailList();
		$this->queryEmails($search_term);
	}

}

$email_lookup = new EmailLookup($_REQUEST['q']);
?>
