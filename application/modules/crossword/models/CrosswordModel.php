<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CrosswordModel extends MY_Model
{
    public function __construct ()
    {
        parent::__construct();
    }

	/**
	 * Get list of categories and data for pagination
	 *
	 * @param int $page - Page number to get data
	 * @param int $limit - Amount of words to return
	 * @param bool $only_active - If true, get only active categories (inactive)
	 *
	 * @return array
	 */
	public function getCategories(int $page=1, int $limit=2, bool $only_active=true)
	{
		//https://gist.github.com/RakibSiddiquee/9ea3578412d0ebf2cd9b2544d989fb91
		$limit = isset($limit)? (int) $limit : 2;
		$page = isset($page)? (int) $page : 1;

		$sql = 'SELECT id FROM categories WHERE 1=1 ';

		if($only_active) {
			$sql .= " AND status = 1 ";
		}

		$sql .= ' ORDER BY categories.name ASC';
		$s = $this->pdo->query($sql);
		$allResp = $s->fetchAll(PDO::FETCH_ASSOC);
		$total_results = $s->rowCount();
		$total_pages = ceil($total_results/$limit);

		$start = ($page-1)*$limit;

		$sql = "SELECT id,name,status FROM categories WHERE 1=1 ";
		if($only_active) {
			$sql .= " AND status = 1 ";
		}
		$sql .= "ORDER BY categories.name ASC LIMIT :start, :limit";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':start', $start, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$data = [];
		$data['pagination']['total_pages'] = $total_pages;
		$data['pagination']['page'] = $page;
		$data['data'] = $results;

		return $data;

	}

}
