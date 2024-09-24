<?php

function Get_FAS_Url()
{
	$CI = get_instance();
	
	$CI->load->model('M_Vrbl');

	$query = $CI->M_Vrbl->Get_Vrbl_FAS_Url();
	
    return $query[0]['vrbl_ket_patch'];
}