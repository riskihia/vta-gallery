<?php

class Struktur_organisasi_model extends Model {

	public function mget($request, $table, $primaryKey, $columns, $join = null)
	{
		$result = $this->simple($request, $table, $primaryKey, $columns, $join);
		return $result;
	}

	public function get($table, $primaryKey, $id)
	{
		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id'");
		return $result;
	}

	public function msave($table, $data = array(), $title)
	{
		$result = $this->sqlinsert($table, $data, $title);
		return $result;
	}

	public function mupdate($table, $data = array(), $primaryKey, $id, $title)
	{
		$result = $this->sqlupdate($table, $data, $primaryKey, $id, $title);
		return $result;
	}

	public function mdelete($table, $primaryKey, $id, $title)
	{
		$result = $this->sqldelete($table, $primaryKey, $id, $title);
		return $result;
	}

	public function show_groups()
	{

		$result    = $this->execute("SELECT a.autono AS id, nama_jabatan AS title, a.parent_id, pangkat, nm_pangkat, nama_lengkap, korps, nrp_nip, a.keterangan  FROM torganizationstructure a LEFT JOIN tpangkat b ON a.pangkat = b.`kd_pangkat` ORDER BY a.autono");

		return $result;
	}

	public function get_groups($id)
	{

		$result    = $this->query("SELECT autono, nama_jabatan, IF(autono = '$id', 'selected', '') AS pselect FROM torganizationstructure");

		return $result;
	}

	public function mget_kode($id)

	{
		
		$result = $this->query("SELECT autono, kd_kotama FROM tsatminkal WHERE autono = '$id'");
		
		return $result;

	}


	public function get_korps($id = 0)

	{
		
		$result = $this->query("SELECT nm_korps, keterangan, IF(b.korps IS NULL, '', 'selected') AS pselect FROM tkorps a LEFT JOIN (SELECT korps FROM torganizationstructure WHERE autono = $id ) AS b ON a.`nm_korps` = b.korps");
		
		return $result;

	}

	    public function get_pangkat($id = 0)
    {
        $items = array();
        $pangkat = $this->execute("SELECT milpns, IF(milpns = 'P', 'PNS', 'TNI') as milpnsval FROM tpangkat GROUP BY milpns ORDER BY milpns ASC");
        while ($row = $this->fetch_assoc($pangkat)) {
			$data['milpns']    = $row['milpns'];
			$data['milpnsval'] = $row['milpnsval'];
			$data['pangkat']   = array();

            $pkt         = $this->execute("SELECT kd_pangkat, nm_pangkat, milpns, IF(b.pangkat IS NULL, '', 'selected') AS pselect FROM tpangkat a LEFT JOIN (SELECT pangkat FROM torganizationstructure WHERE autono = $id) AS b ON a.`kd_pangkat` = b.pangkat WHERE milpns = '".$row ['milpns']."' GROUP BY kd_pangkat ORDER BY kd_pangkat DESC");
            while ($rows = $this->fetch_assoc($pkt)) {

                array_push($data['pangkat'], $rows);

            }
            array_push($items, $data);
        }

        return $items;
    }


    public function show_series($id)
	{
		
		if($id){

			$result  = $this->execute("SELECT  parent_id as parent_id, autono as id FROM torganizationstructure WHERE autono IN ($id)");
		
			$data    = array();

			if ($result) 

				{ 
					
					while ($row = $this->fetch_array($result)) {

					$item       = array($row[0],$row[1]);

					array_push($data, $item); 
					
			  } 

			} 

			return $data;
		}
		

	}

	public function show_nodes($id, $key)
	{
		
		$result  = $this->execute("SELECT a.autono AS id, IF(a.pangkat >= 51, CONCAT('<span class=text-size-small>',nama_lengkap, '<br>', 'NRP. ', nrp_nip, ' ', b.nm_pangkat, ' ', korps,'</span>') , CONCAT('<span class=text-size-small>',nama_lengkap, '<br>', 'NIP. ', nrp_nip, ' PNS ', b.nm_pangkat, ' ', '</span>')) AS title, nama_jabatan AS `name`, IF(nama_lengkap = '' OR nama_lengkap IS NULL, 'http://localhost/disjarah/static/images/unknown_user.png', 'http://localhost/disjarah/static/images/user1.png') AS image, a.parent_id FROM torganizationstructure a LEFT JOIN tpangkat AS b ON a.pangkat = b.kd_pangkat WHERE a.autono IN ($id, $key)");
		
		$data    = array();

		if ($result) 

			{ 
				
				while ($row = $this->fetch_array($result)) {
				
				$item       = array("id"=>$row['id'], "title"=>$row['title'], "name"=>$row['name'], "image"=>$row['image']);

				array_push($data, $item); 
				    
		  } 

		} 

		return $data;

	}


function listarray($data, $parent) 
{

	$rs       = $this->query("Select autono from torganizationstructure where parent_id = ".$parent);
	
	$count    = count($rs);
	
	$data     = array();

    if($rs){

    	foreach($rs as $index => $dt)
        {
            array_push($data, $dt[0]);

            if($count > 0){

            	$dta = $this->listarray($data, $dt[0]);

		    	foreach($dta as $index => $dta)

		        {    

		            array_push($data, $dta);

		        }

		    } 
        }

    }     
        
    return $data;

}

	
	
}
