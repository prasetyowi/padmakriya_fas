<?php

class M_Depo extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getAlldepo()
    {
        $data = $this->db->select("*")->from('depo')->get();
        return $data->result_array();
    }

    public function Getdepo_count()
    {
        $this->db	->select("count(*) as total_depo", FALSE)
					->from('depo');
		$query = $this->db->get();
		
		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	
    public function Getdepo_count_search()
    {
        $query = $this->db->query("	select count(*) as total_depo
									from depo as d
									where dbo.searchstr( depo_nama, '$search' ) = 1 and 
										isnull( depo_is_deleted, 0 ) = 0");
		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	
    public function Getdepo()
    {
        $this->db	->select("	depo_id,  depo_kode, depo_nama, depo_status, isnull( depo_alamat, 'N/A') as depo_alamat, 
								isnull( depo_width, 600 ) as depo_width, isnull( depo_length, 600 ) as depo_length,
								isnull( depo_no_telp, '-' ) as depo_no_telp, isnull( depo_foto, 'N/A' ) as depo_foto,
								isnull( cast( depo_latitude as varchar(50) ), 'N/A' ) as depo_latitude, isnull( cast( depo_longitude as varchar(50) ), 'N/A' ) as depo_longitude, depo_is_deleted")
					->from('depo')
					->order_by('depo_nama');
		$query = $this->db->get();
		
		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	
    public function Getarea_by_depo_id( $depo_id )
    {
        $query = $this->db->query("	select area_id, area_nama, ah.area_header_id, area_header_nama from depo as d
										inner join depo_area_header as da on da.depo_id = d.depo_id
										inner join area_header as ah on ah.area_header_id = da.area_header_id
										inner join area as a on a.area_header_id = ah.area_header_id
									where d.depo_id = '$depo_id'
									order by depo_nama");

		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	
    public function Getdepo_search( $search )
    {
        $query = $this->db->query("	select depo_id, depo_kode, depo_nama, depo_status, isnull( depo_alamat, 'N/A') as depo_alamat, 
										isnull( depo_width, 600 ) as depo_width, isnull( depo_length, 600 ) as depo_length,
										isnull( depo_no_telp, '-' ) as depo_no_telp, isnull( depo_foto, 'N/A' ) as depo_foto,
										isnull( cast( depo_latitude as varchar(50) ), 'N/A' ) as depo_latitude, isnull( cast( depo_longitude as varchar(50) ), 'N/A' ) as depo_longitude, 
										depo_is_deleted
									from depo as d
									where dbo.searchstr( depo_nama, '$search' ) = 1and 
										isnull( depo_is_deleted, 0 ) = 0
									order by depo_nama ");
	
		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	
    public function Getdepo_active()
    {
        $this->db	->select("	depo_id,  depo_kode, depo_nama, depo_status, isnull( depo_alamat, 'N/A') as depo_alamat, 
								isnull( depo_width, 600 ) as depo_width, isnull( depo_length, 600 ) as depo_length,
								isnull( depo_no_telp, '-' ) as depo_no_telp, isnull( depo_foto, 'N/A' ) as depo_foto,
								isnull( cast( depo_latitude as varchar(50) ), 'N/A' ) as depo_latitude, isnull( cast( depo_longitude as varchar(50) ), 'N/A' ) as depo_longitude, depo_is_deleted")
					->from('depo')
					->where('depo_status', 1 )
					->order_by('depo_nama');
		$query = $this->db->get();
		
		if( $query->num_rows() == 0 )	{	return 0;						}
		else							{	return $query->result_array();	}
    }
	/*
	public function Get_Depo_2()
	{
		$this->db	->select("depo_id, depo_kode, depo_nama, updwho, updtgl, depo_Status, depo_alamat, depo_latitude, depo_Lon")
					->from("depo")
					->order_by("depo_kode", "ASC");
		$query = $this->db->get();
		
		if($query->num_rows() == 0)	{	$query = 0;							}
		else						{	$query = $query->result_array(); 	}
			
		return $query;
	}
	*/
	public function Getdepo_by_depo_kode( $depo_kode )
	{
		$this->db	->select("	depo_id,  depo_kode, depo_nama, depo_status, isnull( depo_alamat, 'N/A') as depo_alamat, 
								isnull( depo_width, 600 ) as depo_width, isnull( depo_length, 600 ) as depo_length,
								isnull( depo_no_telp, '-' ) as depo_no_telp, isnull( depo_foto, 'N/A' ) as depo_foto,
								isnull( cast( depo_latitude as varchar(50) ), 'N/A' ) as depo_latitude, isnull( cast( depo_longitude as varchar(50) ), 'N/A' ) as depo_longitude, depo_is_deleted")
					->from("depo")
					->where("depo_kode", $depo_kode );
		$query = $this->db->get();	
		
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	
		
	public function Getdepo_by_depo_id( $depo_id )
	{
		$this->db	->select("*")
					->from("depo")
					->where("depo_id", $depo_id );
		$query = $this->db->get();
		
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	

	public function Getdepo_area_header_by_depo_id( $depo_id )
	{
		$this->db	->select("depo_area_header_id, depo_id, area_header_id")
					->from("depo_area_header")
					->where("depo_id", $depo_id );
		$query = $this->db->get();
		
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	

	public function Get_Depo_By_Depo_ID( $depo_id )
	{
		$this->db	->select("*")
					->from("depo")
					->where("depo_id", $depo_id );
		$query = $this->db->get();
		
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	

	public function Getdepo_detail_by_depo_id( $depo_id )
	{
		$query = $this->db->query("	select	depo_detail_id, depo_id, depo_detail_nama, depo_detail_catatan, 
											isnull( depo_detail_flag_jual, 0 ) as depo_detail_flag_jual, 
											isnull( depo_detail_is_gudang_penerima, 0 ) as depo_detail_is_gudang_penerima,
											depo_detail_is_deleted, depo_detail_length, depo_detail_width, depo_detail_x, depo_detail_y,	
											depo_detail_warna, depo_detail_warna_font
									from depo_detail
									where depo_id = '$depo_id' ");

		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	
	
	public function Get_Depo_Detail_By_Depo_ID( $depo_id )
	{
		$this->db	->select("*")
					->from("depo_detail")
					->where("depo_id", $depo_id );
		$query = $this->db->get();	
		
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = $query->result_array(); }
		
		return $query;
	}	
	
	public function Checkdepo_duplicate_kode( $depo_kode )
	{
		$this->db	->select("depo_id")
					->from("depo")
					->where("depo_kode", $depo_kode );
		$query = $this->db->get();
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = 1; }
		
		return $query;
	}
	
	public function Checkdepo_duplicate_nama( $depo_nama )
	{
		$this->db	->select("depo_id")
					->from("depo")
					->where("depo_nama", $depo_nama );
		$query = $this->db->get();
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = 1; }
		
		return $query;
	}
	
	public function Checkdepo_duplicate_kode_others( $depo_id, $depo_kode )
	{
		$this->db	->select("depo_id")
					->from("depo")
					->where("depo_kode", $depo_kode )
					->where("depo_id <>", $depo_id );
		$query = $this->db->get();
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = 1; }
		
		return $query;
	}
	
	public function Checkdepo_duplicate_nama_others( $depo_id, $depo_nama )
	{
		$this->db	->select("depo_id")
					->from("depo")
					->where("depo_nama", $depo_nama )
					->where("depo_id <>", $depo_id );
		$query = $this->db->get();
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = 1; }
		
		return $query;
	}
	
	public function Checkdepo_in_in_mas( $depo_id )
	{
		$this->db	->select("depo_id")
					->from("in_mas")
					->where("depo_id", $depo_id );
		$query = $this->db->get();
		if($query->num_rows() == 0)	{	$query = 0;	}
		else						{	$query = 1; }
		
		return $query;
	}
	
	public function Insertdepo( $depo_id, $depo_kode, $depo_nama, $depo_status, $depo_alamat, $depo_no_telp, $depo_length, $depo_width, $depo_latitude, $depo_longitude)
	{
		$this->db->set("depo_id"		, $depo_id);
		$this->db->set("depo_kode"		, $depo_kode);
		$this->db->set("depo_nama"		, $depo_nama);
		$this->db->set("depo_status"	, $depo_status);
		$this->db->set("depo_alamat"	, $depo_alamat);
		$this->db->set("depo_no_telp"	, $depo_no_telp);
		$this->db->set("depo_length"	, $depo_length);
		$this->db->set("depo_width"		, $depo_width);
		$this->db->set("depo_latitude"	, $depo_latitude);
		$this->db->set("depo_longitude"	, $depo_longitude);
		//$this->db->set("unit_mandiri_id", $unit_mandiri_id);

		$this->db->insert("depo");
		
		$affectedrows = $this->db->affected_rows();
		
		if($affectedrows > 0)	{	$queryinsert = 1;	}
		else					{	$queryinsert = 0;	}
		
		return $queryinsert; 
	}
	
	public function Insertdepo_area_header( $depo_id, $area_header_id )
	{
		$this->db->set("depo_area_header_id", "NEWID()", FALSE );
		$this->db->set("depo_id"			, $depo_id);
		$this->db->set("area_header_id"		, $area_header_id);

		$this->db->insert("depo_area_header");
		
		$affectedrows = $this->db->affected_rows();
		
		if($affectedrows > 0)	{	$queryinsert = 1;	}
		else					{	$queryinsert = 0;	}
		
		return $queryinsert; 
	}
			
	public function Deletedepo_area_header( $depo_id )
	{
		$this->db->where("depo_id"		, $depo_id);

		$this->db->delete("depo_area_header");
		
		$affectedrows = $this->db->affected_rows();
		
		if($affectedrows > 0)	{	$queryinsert = 1;	}
		else					{	$queryinsert = 0;	}
		
		return $queryinsert; 
	}
			
	public function Updatedepo( $depo_id, $depo_kode, $depo_nama, $depo_status, $depo_alamat, $depo_no_telp, $depo_length, $depo_width, $depo_latitude, $depo_longitude)
	{
		$this->db->set("depo_kode"		, $depo_kode);
		$this->db->set("depo_nama"		, $depo_nama);
		$this->db->set("depo_status"	, $depo_status);
		$this->db->set("depo_alamat"	, $depo_alamat);
		$this->db->set("depo_no_telp"	, $depo_no_telp);
		$this->db->set("depo_length"	, $depo_length);
		$this->db->set("depo_width"	, $depo_width);
		$this->db->set("depo_latitude"	, $depo_latitude);
		$this->db->set("depo_longitude"	, $depo_longitude);
		
		$this->db->where("depo_id"		, $depo_id);

		$this->db->update("depo");
		
		$affectedrows = $this->db->affected_rows();
		
		if($affectedrows > 0)	{	$queryupdate = 1;	}
		else					{	$queryupdate = 0;	}
		
		return $queryupdate; 
	}
		
	public function Updatedepo_map( $depo_id, $depo_latitude, $depo_longitude, $depo_alamat )
	{
		$this->db->set("depo_alamat"	, $depo_alamat);
		$this->db->set("depo_latitude"	, $depo_latitude);
		$this->db->set("depo_longitude"	, $depo_longitude);
		
		$this->db->where("depo_id"		, $depo_id);

		$this->db->update("depo");
		
		$affectedrows = $this->db->affected_rows();
		
		if($affectedrows > 0)	{	$queryupdate = 1;	}
		else					{	$queryupdate = 0;	}
		
		return $queryupdate; 
	}
	
	public function Updatedepo_depo_status( $depo_id, $depo_status )
	{
		$this->db->set("depo_status", $depo_status);

		$this->db->where("depo_id", $depo_id);
		
		$this->db->update("depo");
		
		$affectedrows = $this->db->affected_rows();
		if($affectedrows > 0)	{	$queryupdate = 1;	}
		else					{	$queryupdate = 0;	}
			
		return $queryupdate;
	}		
		
	public function Updatedepo_depo_foto( $depo_id, $depo_foto )
	{
		$this->db->set("depo_foto", $depo_foto);

		$this->db->where("depo_id", $depo_id);
		
		$this->db->update("depo");
		
		$affectedrows = $this->db->affected_rows();
		if($affectedrows > 0)	{	$queryupdate = 1;	}
		else					{	$queryupdate = 0;	}
			
		return $queryupdate;
	}		
		
	public function Deletedepo( $depo_id )
	{
		$this->db->trans_begin();
		
		$this->db->where("depo_id", $depo_id);
		$this->db->delete("depo");
	
		$error = $this->db->error();

		if ($error['message'] != '' || $error['message'] != null)
		//if( $error['message'] != '' && $error['message'] != null )
		{
			$res = $error['message']; // Error
			
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			
			$affectedrows = $this->db->affected_rows();
			if( abs($affectedrows) > 0 )
			{
				$res = 1; // Success
			}
			else
			{
				$res = 0; // Success
			}
		}
	}
}
