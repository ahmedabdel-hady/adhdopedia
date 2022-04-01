<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends School 
{
    private $runningYear = '';
    
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }
    
    public function createBulkInvoice()
    {
        foreach ($this->input->post('student_id') as $id) 
        {
            $data['student_id']         = $id;
            $data['class_id']           = $this->input->post('class_id');
            $data['title']              = html_escape($this->input->post('title'));
            $data['description']        = html_escape($this->input->post('description'));
            $data['amount']             = html_escape($this->input->post('amount'));
            $data['due']                = $data['amount'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = $this->crud->getDateFormat();
            $data['year']               = $this->runningYear;
            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();
            $data2['invoice_id']        = $invoice_id;
            $data2['student_id']        = $id;
            $data2['title']             = html_escape($this->input->post('title'));
            $data2['description']       = html_escape($this->input->post('description'));
            $data2['payment_type']      = 'income';
            $data2['method']            = $this->input->post('method');
            $data2['amount']            = html_escape($this->input->post('amount'));
            $data2['timestamp']         = strtotime($this->input->post('date'));
            $data2['month']             = date('M');
            $data2['year']              = $this->runningYear;
            $this->db->insert('payment' , $data2);
        }
    }
    
    public function singleInvoice()
    {
        $data['student_id']         = $this->input->post('student_id');
        $data['class_id']           = $this->input->post('class_id');
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        $data['amount']             = $this->input->post('amount');
        $data['due']                = $data['amount'];
        $data['status']             = $this->input->post('status');
        $data['creation_timestamp'] = $this->crud->getDateFormat();
        $data['year']               = $this->runningYear;
        $this->db->insert('invoice', $data);
        $invoice_id = $this->db->insert_id();
        $data2['invoice_id']        =   $invoice_id;
        $data2['student_id']        =   $this->input->post('student_id');
        $data2['title']             =   $this->input->post('title');
        $data2['description']       =   $this->input->post('description');
        $data2['payment_type']      =  'income';
        $data2['method']            =   $this->input->post('method');
        $data2['amount']            =   $this->input->post('amount');
        $data2['timestamp']         =   strtotime($this->input->post('date'));
        $data2['month']             =   date('M');
        $data2['year']              =  $this->runningYear;
        $this->db->insert('payment' , $data2);

        $student_name     = $this->crud->get_name('student', $this->input->post('student_id'));
        $student_email    = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->email;
        $student_phone    = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->phone;
        $parent_id        = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->parent_id;
        $parent_phone     = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone;
        $parent_email     = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
        $notify           = $this->crud->getInfo('p_new_invoice');
        $notify2          = $this->crud->getInfo('s_new_invoice');
        $message          = getEduAppGTLang('new_invoice_has_been_generated_for')." " . $student_name;
        $sms_status       = $this->crud->getInfo('sms_status');
        if($notify == 1)
        {
            if ($sms_status == 'msg91') 
            {
                $result = $this->crud->send_sms_via_msg91($message, $parent_phone);
            }
            else if ($sms_status == 'twilio') 
            {
                $this->crud->twilio_api($message,"".$parent_phone."");
            }
            else if ($sms_status == 'clickatell') 
            {
                $this->crud->clickatell($message,$parent_phone);
            }
        }
        $this->crud->parent_new_invoice($student_name, "".$parent_email."");
        if($notify2 == 1)
        {
          if ($sms_status == 'msg91') 
          {
             $result = $this->crud->send_sms_via_msg91($message, $student_phone);
          }
          else if ($sms_status == 'twilio') 
          {
              $this->crud->twilio_api($message,"".$student_phone."");
          }
          else if ($sms_status == 'clickatell') 
          {
              $this->crud->clickatell($message,$student_phone);
          }
        }
        $this->crud->student_new_invoice($student_name, "".$student_email."");
    }
    
    public function updateInvoice($invoiceId)
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        $data['amount']             = $this->input->post('amount');
        $data['status']             = $this->input->post('status');

        $this->db->where('invoice_id', $invoiceId);
        $this->db->update('invoice', $data);
    }
    
    public function deleteInvoice($invoiceId)
    {
        $this->db->where('invoice_id', $invoiceId);
        $this->db->delete('invoice');
    }
    
    public function makePayPal()
    {
        $type = '';
        if($this->session->userdata('login_type') == 'parent')
        {
            $type = 'parents';
        }else{
            $type = 'student';
        }
        $invoice_id      = $this->input->post('invoice_id');
        $system_settings = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
        $invoice_details = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
        $this->paypal->add_field('rm', 2);
        $this->paypal->add_field('no_note', 0);
        $this->paypal->add_field('item_name', $invoice_details->title);
        $this->paypal->add_field('amount', $invoice_details->due);
        $this->paypal->add_field('currency_code', $this->db->get_where('settings' , array('type' =>'currency'))->row()->description);
        $this->paypal->add_field('custom', $invoice_details->invoice_id);
        $this->paypal->add_field('business', $system_settings->description);
        $this->paypal->add_field('notify_url', base_url() . $type.'/invoice/');
        $this->paypal->add_field('cancel_return', base_url() . $type.'/invoice/paypal_cancel');
        $this->paypal->add_field('return', base_url() . $type.'/invoice/paypal_success');
        $this->paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        $this->paypal->submit_paypal_post();
    }
    
    public function paypalSuccess()
    {
        foreach ($_POST as $key => $value) 
        {
            $value = urlencode(stripslashes($value));
            $ipn_response .= "\n$key=$value";
        }
        $data['payment_details']   = $ipn_response;
        $data['payment_timestamp'] = strtotime(date("m/d/Y"));
        $data['payment_method']    = 'paypal';
        $data['status']            = 'completed';
        $invoice_id                = $_POST['custom'];
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update('invoice', $data);

        $data2['method']       =   'paypal';
        $data2['invoice_id']   =   $_POST['custom'];
        $data2['timestamp']    =   strtotime(date("m/d/Y"));
        $data2['payment_type'] =   'income';
        $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
        $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
        $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
        $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
        $this->db->insert('payment' , $data2);
    }
    
    
    
    
}