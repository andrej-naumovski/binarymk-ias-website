<?php
	define("SALT_BYTE_SIZE", 24);
	define("SHA256_HASH_ALGORITHM", "sha256");
	define("HASH_SECTIONS", 2);
	define("HASH_INDEX", 0);
	define("SALT_INDEX", 1);

	function create_hash($password) {
		$salt = bin2hex(openssl_random_pseudo_bytes(SALT_BYTE_SIZE));
		return hash(SHA256_HASH_ALGORITHM, $password . $salt) . ":" . $salt;
	}

	function check_password($password, $correctHash) {
		$params = explode(":", $correctHash);
		if(count($params) < HASH_SECTIONS) {
			return false;
		}
		return slow_equals($params[HASH_INDEX], hash(SHA256_HASH_ALGORITHM, $password . $params[SALT_INDEX]));
	}

	function slow_equals($a, $b) {
		$diff = strlen($a) ^ strlen($b);
		for($i = 0;$i < strlen($a) && $i < strlen($b); $i++) {
			$diff |= ord($a[$i]) ^ ord($b[$i]);
		}
		return $diff === 0;
	}
?>