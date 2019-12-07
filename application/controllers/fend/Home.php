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
      // $this->load->model('');
      // $this->isLoggedIn();
   }

   function index()
   {
      $this->global['pageTitle'] = '首頁';
      $data['test'] = 'test';

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
