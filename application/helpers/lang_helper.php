<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function GetBahasa()
{ 
	$CI = get_instance();
	
	$bahasa = $CI->session->userdata('Bahasa');

	$CI->load->model('Global/M_Bahasa','M_Bahasa');

	$bahasa = $CI->M_Bahasa->Getbahasa( $bahasa );

	return $bahasa;
}

function GetBahasaByKode( $Bahasa )
{ 
	$CI = get_instance();
	
	$CI->load->model('Global/M_Bahasa','M_Bahasa');

	$bahasa = $CI->M_Bahasa->Getbahasa( $Bahasa );

	return $bahasa;
}

function GetBahasaDefault()
{ 
	$CI = get_instance();
	
	$res = $CI->M_Bahasa->Getdefault_language();
	$default_language = $res[0]['vrbl_kode'];
	
	$bahasa = $CI->M_Bahasa->Getbahasa( $default_language );

	return $bahasa;
}

function GetBahasaAll()
{ 
	$CI = get_instance();
	
	$bahasa = $CI->M_Bahasa->Getbahasa_all();

	return $bahasa;
}

