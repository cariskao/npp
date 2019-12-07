<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Headerfooter extends BaseController
{
   /**
    * This is default constructor of the class
    */
   public function __construct()
   {
      parent::__construct();
      $this->load->model('headerfooter_model');
      $this->isLoggedIn();
   }

   function index()
   {
      $this->global['pageTitle'] = 'Header & Footer';

      $data['headerfooterInfo'] = $this->headerfooter_model->getHeaderFooterInfo();

      $this->loadViews("headerfooter", $this->global, $data, NULL);
   }

   function headerfooterEditSend()
   {
      $this->form_validation->set_rules('fb', '臉書', 'trim|required');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('mail', '信箱', 'trim|required|valid_email');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('phonesend', '電話(撥打)', 'trim|required');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('phoneshow', '電話(顯示)', 'trim|required');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('fax', '傳真', 'trim|required');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      if ($this->form_validation->run() == FALSE) {
         $this->index();
         // redirect('index');//fail, error message can't show up
         // redirect('headerfooter');//fail, error message can't show up
      } else {
         $fb = $this->security->xss_clean($this->input->post('fb'));
         $mail = $this->security->xss_clean($this->input->post('mail'));
         $phoneSend = $this->security->xss_clean($this->input->post('phonesend'));
         $phoneShow = $this->security->xss_clean($this->input->post('phoneshow'));
         $fax = $this->security->xss_clean($this->input->post('fax'));
         $servicetime = $this->security->xss_clean($this->input->post('servicetime'));

         $dateInfo = array(
            'fb' => $fb,
            'mail' => $mail,
            'phonesend' => $phoneSend,
            'phoneshow' => $phoneShow,
            'fax' => $fax,
            'servicetime' => $servicetime
         );

         $result = $this->headerfooter_model->headerfooterEditSend($dateInfo);

         if ($result == true) {
            $this->session->set_flashdata('success', '儲存成功!');
         } else {
            $this->session->set_flashdata('error', '儲存失敗!');
         }
         redirect('headerfooter');
      }
   }
}
