<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/FendBaseController.php';

class Home extends FendBaseController
{
   /**
    * This is default constructor of the class
    */
   public function __construct()
   {
      parent::__construct();
      $this->load->model('website_model');
      $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
      $this->global['pageTitle'] = '時代力量立法院黨團';
      // $this->isLoggedIn();
   }

   /**
    * Page not found : error 404
    */
   function pageNotFound()
   {
      $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

      $this->loadViews("404", $this->global, NULL, NULL);
   }

   function index()
   {
      $data['aaa'] = '';

      // $searchText = $this->security->xss_clean($this->input->post('searchText'));
      // $data['searchText'] = $searchText;

      // $this->load->library('pagination');
      // $count = $this->partymember_model->partymemberListingCount($searchText);
      // echo ' count: ' . $count;

      // $returns = $this->paginationCompress("partymember/index/", $count, 10, 3);
      // echo ' segment: ' . $returns['segment'];
      // echo ' page: ' . $returns['page'];

      // $data['partyMemberRecords'] = $this->partymember_model->partymemberListing($searchText, $returns["page"], $returns["segment"]);

      $this->loadViews("fend/home", $this->global, $data, NULL);
   }
}
