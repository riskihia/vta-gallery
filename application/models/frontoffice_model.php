<?php

class Frontoffice_model extends Model {
	
	
    public function getfoto()
    {
    	$data = $this->query("SELECT autono, nama_kegiatan, tanggal, kode_parent, nama_file, tipe_file, ukuran  FROM tbl_dokumen a RIGHT JOIN (SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'image%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1");

    	return $data;
    }

    public function getvideo()
    {
        $data = $this->query("SELECT autono, nama_kegiatan, tanggal, kode_parent, nama_file, tipe_file, ukuran  FROM tbl_dokumen a RIGHT JOIN (SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1 LIMIT 20");

        return $data;
    }

	public function getinfos($id)
    {
        $data = $this->getvalue("SELECT autono, autocode, nama_kegiatan, tanggal  FROM tbl_dokumen WHERE autono = $id");

        return $data;
    }

    public function msave($table, $data = array(), $title)

    {

        $result = $this->sqlinsert($table, $data, $title);

        return $result;

    }

	public function graf()
    {
        $rs = $this->execute("SELECT COUNT(*) as jml, b.nama_media as uraian, a.jenis_media FROM tbl_dokumen a LEFT JOIN (SELECT autocode, nama_media FROM ref_media) AS b ON a.`jenis_media` = b.autocode GROUP BY jenis_media ORDER BY nama_media");
        $result = array();
        while($row = $this->fetch_assoc($rs)){
            $nodes = array();
                $nodes['name']      = $row['uraian'];
                $nodes['y']         = (float) $row['jml'];
                $nodes['drilldown'] = $row['jenis_media'];
                array_push($result, $nodes);
        }
        return json_encode($result);
    }

    public function subgraf()
    {
        $sQuery = "SELECT COUNT(*) as jml, b.nama_media as uraian, a.jenis_media FROM tbl_dokumen a LEFT JOIN (SELECT autocode, nama_media FROM ref_media) AS b ON a.`jenis_media` = b.autocode GROUP BY jenis_media ORDER BY nama_media";
        $sResult= $this->execute($sQuery);
		$data = "";
        while($sRow     = $this->fetch_assoc($sResult)){
            $data .= "{";
            $data .= "name".":". "'".$sRow['uraian']."'".",";
            $data .= "id".":". "'".$sRow['jenis_media']."'".",";
            $data .= "data".":"."[";
                $q  = "SELECT COUNT(*) AS total, a.`jenis_media`, kondisi_media, b.nama_kondisi AS uraian FROM tbl_dokumen a LEFT JOIN (SELECT autocode, nama_kondisi FROM ref_kondisi) AS b ON a.`kondisi_media` = b.`autocode` WHERE jenis_media = '".$sRow['jenis_media']."' GROUP BY a.`kondisi_media`";
                $rs = $this->execute($q);
                $items     = array();
                while($row = $this->fetch_assoc($rs)){
                    $data .= "["."'".trim($row['uraian'])."'".",". $row['total']."]".",";
                }

            $data .= "]";
            $data .= "},";
        }
    	return $data;
    }

    public function get_pangkat()
    {
        $items = array();
        $milpns = $this->execute("SELECT if(milpns = 'M', 'TNI', 'PNS') AS milpnsval, milpns FROM tpangkat GROUP BY milpns ORDER BY milpns ASC");
        while ($row = $this->fetch_assoc($milpns)) {
            $data['milpns'] = $row['milpns'];
            $data['milpnsval'] = $row['milpnsval'];
            $data['pangkat'] = array();

            $kota = $this->execute("SELECT kd_pangkat, nm_pangkat FROM tpangkat WHERE milpns = '".$row ['milpns']."' GROUP BY kd_pangkat ORDER BY kd_pangkat DESC");
            while ($rows = $this->fetch_assoc($kota)) {
                array_push($data['pangkat'], $rows);
            }
            array_push($items, $data);
        }

        return $items;
    }

    public function get_korps()
    {
        $result = $this->query("SELECT kd_korps, nm_korps FROM tkorps ORDER BY autono ASC");

        return $result;
    }

     public function get_file_attachment($id)
    {
        $result = $this->query("SELECT * FROM vt_files WHERE parent_id = $id ");

        return $result;
    }

}
