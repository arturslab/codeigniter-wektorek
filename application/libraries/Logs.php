<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Logs - Logowanie zdarzen w bazie danych
 */
class Logs extends MY_Model
{


	public function __construct()
	{
		parent::__construct();
//		require('env.php');

	}

	/**
	 * Zapis zdarzen w tabeli logow, opcjonalnie rzuca wyjatek
	 *
	 * @param string $levelName Typ zdarzenia ['debug', 'error', 'info', 'other']
	 * @param string $name Nazwa zdarzenia np. 'Blad wysylki'
	 * @param string $message Tresc zdarzenia
	 * @param bool $exception Czy rzucic wyjatek
	 * @param array $args Konfig logow [moduleName, className, logsDbSchema, logsDbTableName]
	 * @return bool Zwraca TRUE, gdy zapisano zdarzenie, w przeciwnym wypadku FALSE
	 * @throws Exception
	 */
	public function addLog(array $data, string $dbTableName='logs', bool $exception = false): bool
	{

		$_dbTableName = isset($dbTableName) ? $dbTableName : 'logs';

		// Dostępne typy zdarzen
		$levels = ['debug', 'error', 'info', 'other'];
		$level = isset($data['level']) && in_array($data['level'], $levels, true) ? $data['level'] : 'other';

		$insertData = [
			
			'module' => isset($data['module']) ? $data['module'] : null,
			'class' => isset($data['class']) ? $data['class'] : null,
			'level' => $level,
			'name' => isset($data['name']) ? $data['name'] : null,
			'description' => isset($data['description']) ? $data['description'] : null,
			'ip_address' => isset($data['ip_address']) ? $data['ip_address'] : null,
			'browser' => isset($data['browser']) ? $data['browser'] : null,
			'browser_version' => isset($data['browser_version']) ? $data['browser_version'] : null,
			'os' => isset($data['os']) ? $data['os'] : null,

		];

		$res = $this->db->insert($_dbTableName, $insertData);

		if ($exception) {
			throw new \Exception($insertData['description'], 1);
		}

		return $res;
	}

}
