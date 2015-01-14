<?php
	class LevelLookup{
		const ACCOUNT_UMKM 			= 1;
		const ACCOUNT_SYSADMIN 		= 2;
		const ACCOUNT_VISITOR 		= 3;

		function getAccountLabel($tipe){
		switch ($tipe){
			case self::ACCOUNT_UMKM: 			return "Pengelola UMKM"; break;
			case self::ACCOUNT_SYSADMIN: 		return "System Administrator"; break;
			case self::ACCOUNT_VISITOR: 		return "Pengunjung"; break;
			}
		}


	}
	




?>