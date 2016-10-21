<?php
class Sitemapcreate extends MY_Controller {

   function __construct()
    {
        parent::__construct();
		$this->load->library('sitemap'); 
		$this->load->helper('download');
		$this->load->helper('xml');		
		 $this->load->helper('file');
		 $this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('admin_model');
    }
    
    function index()
    {
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
			
				$this->data['heading'] = 'Sitemap creation';
				
				$this->load->view('admin/sitemapgeneration/sitemap_generation',$this->data);
				
			}else {
				redirect('admin');
			}
		}
		
    }
	
	function insert_sitemap_values()
	{
		$siteMapValues = $this->input->post();
		 
		if(!empty($siteMapValues))
		{
		$priorityFormat = '%01.1f';
		
		$unique_row_id_array = $siteMapValues['unique_row_id'];
		
		 // Initiate class
		
	  $file = "sitemap.xml";
	   $pf = fopen ($file, "w");
		if (!$pf)
		{
		echo "cannot create $file\n";
		return;
		}
			fwrite ($pf,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
		<urlset
			  xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
			  xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
			  xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
					http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
		");
			
		foreach($siteMapValues as $siteMapValues1=>$val)
		{
			
		
			foreach($val as $siteMapValues2=>$va)
			{
			
				if((in_array($siteMapValues2,$unique_row_id_array)))
				{
					//echo $siteMapValues2;
					$site_map_link_det = $siteMapValues['site_map_link_det'][$siteMapValues2];					
					$change_frequency = $siteMapValues['change_frequency'][$siteMapValues2];
					$change_priority = $siteMapValues['change_priority'][$siteMapValues2];
					$site_map_modification_det = $siteMapValues['site_map_modification_det'][$siteMapValues2];
					
	
		
					fwrite ($pf,"<url>\n<loc>$site_map_link_det/</loc>\n<lastmod>$site_map_modification_det</lastmod>\n<changefreq>$change_frequency</changefreq>\n<priority>$change_priority </priority>\n</url>\n");
				}
			
			
			}
		
			fwrite ($pf, "</urlset>\n");
			fclose ($pf);
		
		
		redirect('admin/sitemapcreate/sitemapdetailsview');
		
		
		}

   		}
		else
		{
			redirect('admin/sitemapcreate');
		}
		
	}
	
	function sitemapdetailsview()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$this->data['heading'] = 'Sitemap creation successful';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
		
		$this->load->view('admin/sitemapgeneration/sitemapdetailsview',$this->data);
		}else {
				redirect('admin');
			}
		}
	}
	
		
}

?>