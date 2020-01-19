<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/FendBaseController.php';

class Home extends FendBaseController
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('home_model');
      $this->load->model('website_model');
      $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
      $this->global['pageTitle'] = '時代力量立法院黨團';
      // $this->isLoggedIn();
   }

   function pageNotFound()
   {
      $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

      $this->loadViews("404", $this->global, NULL, NULL);
   }

   function index()
   {
      $data = array(
         'getCarouselInfo' => $this->home_model->getCarouselInfo(),
      );

      $this->loadViews("fend/home", $this->global, $data, NULL);
   }
}
