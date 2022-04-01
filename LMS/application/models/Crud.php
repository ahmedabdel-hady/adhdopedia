<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    include_once 'public/src/Google_Client.php';
    include_once 'public/src/contrib/Google_Oauth2Service.php';

class Crud extends School 
{
    private $runningYear = '';
    
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }

    function updateSMTP(){
        $data['description'] = strip_tags($this->input->post('protocol'));
        $this->db->where('type' , 'protocol');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('smtp_host'));
        $this->db->where('type' , 'smtp_host');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('smtp_port'));
        $this->db->where('type' , 'smtp_port');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('smtp_user'));
        $this->db->where('type' , 'smtp_user');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('smtp_pass'));
        $this->db->where('type' , 'smtp_pass');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('charset'));
        $this->db->where('type' , 'charset');
        $this->db->update('settings' , $data);
    }
    
    function getFacebookURL()
    {
        require_once 'public/face/config.php';
        $redirectURL = base_url()."auth/facebook/";
        $permissions = ['email'];
        $loginURL    = $helper->getLoginUrl($redirectURL, $permissions);
        return $loginURL;
    }
    
    function studentRequestPermission()
    {
        $data['student_id']   = $this->session->userdata('login_user_id');
        $data['description']  = $this->input->post('description');
        $data['parent_id']    = $this->db->get_where('student', array('student_id' => $this->session->userdata('login_user_id')))->row()->parent_id;
        $data['title']        = $this->input->post('title');
        $data['start_date']   = $this->input->post('start_date');
        $data['end_date']     = $this->input->post('end_date');
        $data['status']     = 0;
        $this->db->insert('students_request', $data);

        $notify['notify'] = "<strong>". $this->crud->get_name('student', $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absence_request');
        $admins = $this->db->get('admin')->result_array();
        foreach($admins as $row)
        {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = "admin";
            $notify['url'] = "admin/request";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    function parentRequestPermission()
    {
        $data['student_id']   = $this->input->post('student_id');
        $data['description']  = $this->input->post('description');
        $data['parent_id']    = $this->session->userdata('login_user_id');
        $data['title']        = $this->input->post('title');
        $data['start_date']   = $this->input->post('start_date');
        $data['end_date']     = $this->input->post('end_date');
        $data['status']     = 0;
        $this->db->insert('students_request', $data);

        $notify['notify'] = "<strong>". $this->session->userdata('name')."</strong>". " ". getEduAppGTLang('absence_request')." <b>".$this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->name."</b>";
        $admins = $this->db->get('admin')->result_array();
        foreach($admins as $row)
        {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = "admin";
            $notify['url'] = "admin/request/";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    function checkChildrens($studentId)
    {
        $parents = $this->db->get_where('student' , array('student_id' => $studentId))->result_array();
        foreach ($parents as $row)
        {
            if($row['parent_id'] == $this->session->userdata('login_user_id'))
            {
                $page_data['student_id'] = $studentId;
            } else if($row['parent_id'] != $this->session->userdata('login_user_id'))
            {
                redirect(base_url(), 'refresh');
            }
        }
    }
    
    public function getGoogleURL()
    {
        $clientId     = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description; //Google client ID
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description; //Google client secret
        $redirectURL  = base_url().'auth/sync/';
        $gClient      = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $authUrl = $gClient->createAuthUrl();
        $output = filter_var($authUrl, FILTER_SANITIZE_URL);
        return $output;
    }
    
    public function googleRevokeToken()
    {
        $gClient = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        return $gClient->revokeToken();
    }
    
    public function acceptRequest($requestId)
    {
        $teacher              = $this->db->get_where('request', array('request_id' => $requestId))->row()->teacher_id;
        $notify['notify']     = "<strong>". $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absence_approved');
        $notify['user_id']    = $teacher;
        $notify['user_type']  = "teacher";
        $notify['url']        = "teacher/request/";
        $notify['date'] = $this->crud->getDateFormat();
        $notify['time'] = date('h:i A');
        $notify['status'] = 0;
        $notify['original_id'] = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
        $data['status'] = 1;
        $this->db->update('request', $data, array('request_id' => $requestId));
    }
    
    public function rejectRequest($requestId)
    {
        $teacher                 = $this->db->get_where('request', array('request_id' => $requestId))->row()->teacher_id;
        $notify['notify']        = "<strong>".  $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absence_rejected');
        $notify['user_id']       = $teacher;
        $notify['user_type']     = "teacher";
        $notify['url']           = "teacher/request";
        $notify['date']          = $this->crud->getDateFormat();
        $notify['time']          = date('h:i A');
        $notify['status']        = 0;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
        $data['status']          = 2;
        $this->db->update('request', $data, array('request_id' => $requestId));
    }
    
    public function acceptStudentRequest($requestId)
    {
        $data['status']          = 1;
        $this->db->update('students_request', $data, array('request_id' => $requestId));
        $student                 = $this->db->get_where('students_request', array('request_id' => $requestId))->row()->student_id;
        $parent                  = $this->db->get_where('students_request', array('request_id' => $requestId))->row()->parent_id;
        $notify['notify']        = "<strong>".  $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absence_approved_for') ." <b>".$this->db->get_where('student', array('student_id' => $student))->row()->name."</b>";
        $notify['user_id']       = $parent;
        $notify['user_type']     = "parent";
        $notify['url']           = "parents/request";
        $notify['date']          = $this->crud->getDateFormat();
        $notify['time']          = date('h:i A');
        $notify['status']        = 0;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
    }
    
    public function rejectStudentRequest($requestId)
    {
        $data['status']             = 2;
        $this->db->update('students_request', $data, array('request_id' => $requestId));
        $parent                     = $this->db->get_where('students_request', array('request_id' => $requestId))->row()->parent_id;
        $student                    = $this->db->get_where('students_request', array('request_id' => $requestId))->row()->student_id;
        $notify['notify']           = "<strong>". $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absence_rejected_for') ." <b>".$this->db->get_where('student', array('student_id' => $student))->row()->name."</b>";
        $notify['user_id']          = $parent;
        $notify['user_type']        = "parent";
        $notify['url']              = "parents/request";
        $notify['date']             = $this->crud->getDateFormat();
        $notify['time']             = date('h:i A');
        $notify['status']           = 0;
        $notify['original_id']      = $this->session->userdata('login_user_id');
        $notify['original_type']    = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
    }
    
    public function deletePermission($code)
    {
        $this->db->where('report_code',$code);
        $this->db->delete('report_response');
        $this->db->where('code',$code);
        $this->db->delete('reports');
    }
    
    public function createReportMessage()
    {
        $data['message']      = $this->input->post('message');
        $data['report_code']  = $this->input->post('report_code');
        $data['timestamp']    = $this->crud->getDateFormat();
        $data['sender_type']  = $this->session->userdata('login_type');
        $data['sender_id']    = $this->session->userdata('login_user_id');
        return $this->db->insert('reporte_mensaje', $data);
    }
    
    public function updateReport($code)
    {
        $data['status'] = 1;
        $this->db->where('report_code', $code);
        $this->db->update('reporte_alumnos', $data);
    }
    
    public function deleteTeacherPermission($code)
    {
        $this->db->where('report_code',$code);
        $this->db->delete('reporte_alumnos');
        $this->db->where('report_code',$code);
        $this->db->delete('reporte_mensaje');
    }
    
    //SetRead
    public function setRead($code)
    {
        $userId    = $this->session->userdata('login_user_id');
        $loginType = $this->session->userdata('login_type');
        $check = $this->db->get_where('readed', array('user_id' => $userId, 'user_type' => $loginType, 'activity_code' => $code));
        if($check->num_rows() == 0){
            $data['user_id']       = $userId;
            $data['date']          = $this->getDateFormat().' '.date('H:i:s');
            $data['user_type']     = $loginType;
            $data['activity_code'] = $code;
            $this->db->insert('readed',$data);
        }
    }
    
    //GetRead
    public function getRead($code){
        $this->db->limit(5);
        $this->db->order_by('readed_id', 'RANDOM');
        $check = $this->db->get_where('readed', array('activity_code' => $code))->result_array();
        return $check;
    }
    
    //Generate student PDF after admission.
    public function getPDF($student_id,$pw){
        $data = array(
            'student_id' => $student_id,
            'pw' => $pw
        );
        $today = date('d-m-Y_h:i:s');
        $html = $this->load->view('backend/downloadsheet.php',$data,TRUE); 
        $stylesheet = file_get_contents(base_url().'public/uploads/css1.css');
        $pdfFilePath = "student_sheet-".$today.".pdf";
        $this->load->library('M_pdf');
        $mpdf = new mPDF('utf-8', 'A4', 0, '', 10, 10, 10, 0, 0, 'L'); 
        $mpdf->packTableData = true;
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($pdfFilePath, "D");
    }
    
    function create_video() 
    {
        $img = md5(date('d/m/Y H:i:s')); 
        $data['news_code']           = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description']         = $this->input->post('description');
        $data['embed']               = $this->input->post('embed');
        $data['date']                = $this->getDateFormat();
        $data['publish_date']        = date('Y-m-d H:i:s');
        $data['admin_id']            = $this->session->userdata('login_user_id');
        $data['date2']               = $this->getDateFormat();
        $data['type']                = "video";
        $this->db->insert('news', $data);
        return $news_code;
    }
    
    function update_panel_news($param2)
    {
        $data['description']         = $this->input->post('description');
        $data['date2']               = $this->getDateFormat();
        $this->db->where('news_code', $param2);
        $this->db->update('news', $data);            
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/news_images/' . $param2 . '.jpg');
    }
    
    function teacherAttendance()
    {
        $data['year']       = $this->input->post('year');
        $str                = $this->input->post('timestamp');
        $originalDate       = $this->input->post('timestamp');
        $newDate = date("d-m-Y", strtotime($originalDate));
        $data['timestamp']  = strtotime($newDate);
        $query = $this->db->get_where('teacher_attendance' ,array('year' => $data['year'], 'timestamp'=> $data['timestamp']));
        if($query->num_rows() < 1) 
        {
            $teacher = $this->db->get('teacher')->result_array();
            foreach($teacher as $row) 
            {
                $attn_data['teacher_id']   = $row['teacher_id'];
                $attn_data['year']         = $data['year'];
                $attn_data['timestamp']    = $data['timestamp'];
                $this->db->insert('teacher_attendance' , $attn_data);  
            }
        }
        return $data['timestamp'];
    }
    
    function createBook()
    {
        $fileTypes = array('pdf', 'doc', 'docx', '.mp3', 'wav', 'mp4', 'mov', 'wmv', 'txt'); // Allowed file extensions
        $fileParts = pathinfo($_FILES['file_name']['name']);
        if($this->input->post('type')  == 'virtual')
        {
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) 
            {               
                $data['name']        = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['price']       = $this->input->post('price');
                $data['author']      = $this->input->post('author');
                $data['total_copies']      = $this->input->post('total_copies');
                $data['class_id']    = $this->input->post('class_id');
                $data['type']        = $this->input->post('type');
                $data['file_name']   = $_FILES["file_name"]["name"];
                $data['status']      = $this->input->post('status');
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/library/" . $_FILES["file_name"]["name"]);
                $this->db->insert('book', $data);

                $notify['notify'] = "<strong>". $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('book_added')." <b>".$this->db->get_where('class', array('class_id' => $this->input->post('class_id')))->row()->name."</b>";
        
                $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id')))->result_array();
                foreach($students as $row1)
                {
                    $notify2['notify'] = $notify['notify'];
                    $notify2['user_id'] = $row1['student_id'];
                    $notify2['user_type'] = "student";
                    $notify2['url'] = "student/library/";
                    $notify2['date'] = $this->crud->getDateFormat();
                    $notify2['time'] = date('h:i A');
                    $notify2['status'] = 0;
                    $notify2['original_id'] = $this->session->userdata('login_user_id');
                    $notify2['original_type'] = $this->session->userdata('login_type');
                    $this->db->insert('notification', $notify2);
                }
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_uploaded'));
            } 
            else 
            {
                $this->session->set_flashdata('error_message' , getEduAppGTLang('extension_not_allowed'));
            }
        }else
        {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['total_copies']      = $this->input->post('total_copies');
            $data['type']        = $this->input->post('type');
            $data['status']      = $this->input->post('status');
            $this->db->insert('book', $data);

             $notify['notify'] = "<strong>". $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('book_added')." <b>".$this->db->get_where('class', array('class_id' => $this->input->post('class_id')))->row()->name."</b>";
        
            $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id')))->result_array();
            foreach($students as $row1)
            {
                $notify2['notify'] = $notify['notify'];
                $notify2['user_id'] = $row1['student_id'];
                $notify2['user_type'] = "student";
                $notify2['url'] = "student/library/";
                $notify2['date'] = $this->crud->getDateFormat();
                $notify2['time'] = date('h:i A');
                $notify2['status'] = 0;
                $notify2['original_id'] = $this->session->userdata('login_user_id');
                $notify2['original_type'] = $this->session->userdata('login_type');
                $this->db->insert('notification', $notify2);
            }
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        }
    }
    
    function updateBook($bookId)
    {
        $fileTypes = array('pdf', 'doc', 'docx', '.mp3', 'wav', 'mp4', 'mov', 'wmv', 'txt'); // Allowed file extensions
        $fileParts = pathinfo($_FILES['file_name']['name']);
        if($this->input->post('type')  == 'virtual')
        {
            $data['name']          = $this->input->post('name');
            $data['description']   = $this->input->post('description');
            $data['price']         = $this->input->post('price');
            $data['author']        = $this->input->post('author');
            $data['class_id']      = $this->input->post('class_id');
            $data['type']          = $this->input->post('type');
            $data['total_copies']  = $this->input->post('total_copies');
            $data['file_name']     = $_FILES["file_name"]["name"];
            $data['status']        = $this->input->post('status');
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/library/" . $_FILES["file_name"]["name"]);
            $this->db->where('book_id', $bookId);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        }else
        {
            $data['name']         = $this->input->post('name');
            $data['description']  = $this->input->post('description');
            $data['price']        = $this->input->post('price');
            $data['author']       = $this->input->post('author');
            $data['class_id']     = $this->input->post('class_id');
            $data['total_copies'] = $this->input->post('total_copies');
            $data['type']         = $this->input->post('type');
            $data['status']       = $this->input->post('status');
            $this->db->where('book_id', $bookId);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        }
    }
    
    function deleteBook($bookId)
    {
        $this->db->where('book_id', $bookId);
        $this->db->delete('book');
    }
    
    function updateCalendarDate()
    {
        if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2]))
        {
            $id = $_POST['Event'][0];
            $start = $_POST['Event'][1];
            $end = $_POST['Event'][2];
            $query = $this->db->query("UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ");
            if ($query == false) {
                die ('Erreur prepare');
            }
            else{
		        die ('OK');
            }
        }
    }
    
    function updateCalendarEvent()
    {
        if (isset($_POST['delete']) && isset($_POST['id']))
        {
            $id    = $_POST['id'];
            $query = $this->db->query("DELETE FROM events WHERE id = $id");
            if ($query == false) 
            {
                die ('Erreur prepare');
            }
            $res = $query;
            if ($res == false) 
            {
                die ('Erreur execute');
            }
        }elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
            $id    = $_POST['id'];
            $title = $_POST['title'];
            $color = $_POST['color'];
            $query = $this->db->query("UPDATE events SET  title = '$title', color = '$color' WHERE id = $id ");
            if ($query == false) 
            {
                die ('Erreur prepare');
            }
            $sth = $query;
            if ($sth == false) 
            {
                die ('Erreur execute');
            }
        }
    }
    
    function createCalendarEvent()
    {
        if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']))
        {
            $title = $_POST['title'];
            $start = $_POST['start'];
            $end   = $_POST['end'];
        	$color = $_POST['color'];
            $this->db->query("INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')");
            $this->crud->send_calendar_notify();
        }
    }
    
    function deleteCategory($categoryId)
    {
        $this->db->where('expense_category_id' , $categoryId);
        $this->db->delete('expense_category');
    }
    
    function updateCategory($categoryId)
    {
        $data['name']   =   $this->input->post('name');
        $this->db->where('expense_category_id' , $categoryId);
        $this->db->update('expense_category' , $data);
    }
    
    function createCategory()
    {
        $data['name']   =   $this->input->post('name');
        $this->db->insert('expense_category' , $data);
    }
    
    function delete_news($param2)
    {
        unlink('public/uploads/news_images/'.$param2. ".jpg");
        $id = $this->db->get_where('news', array('news_code' => $param2))->row()->news_id;
        $this->db->where('news_code' , $param2);
        $this->db->delete('news');
    }
    
    function updateSettings()
    {
        $data['description'] = strip_tags($this->input->post('system_name'));
        $this->db->where('type' , 'system_name');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('logs'));
        $this->db->where('type' , 'logs');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('calendar'));
        $this->db->where('type' , 'calendar');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('date_format'));
        $this->db->where('type' , 'date_format');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('system_name'));
        $this->db->where('type' , 'system_name');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('language'));
        $this->db->where('type' , 'language');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('timezone'));
        $this->db->where('type' , 'timezone');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('register'));
        $this->db->where('type' , 'register');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('system_title'));
        $this->db->where('type' , 'system_title');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('address'));
        $this->db->where('type' , 'address');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('phone'));
        $this->db->where('type' , 'phone');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('facebook'));
        $this->db->where('type' , 'facebook');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('twitter'));
        $this->db->where('type' , 'twitter');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('instagram'));
        $this->db->where('type' , 'instagram');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('youtube'));
        $this->db->where('type' , 'youtube');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('currency'));
        $this->db->where('type' , 'currency');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('paypal_email'));
        $this->db->where('type' , 'paypal_email');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('system_email'));
        $this->db->where('type' , 'system_email');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('running_year'));
        $this->db->where('type' , 'running_year');
        $this->db->update('settings' , $data);
    }
    
    function updateSocial()
    {
        $data['description'] = strip_tags($this->input->post('facebook'));
        $this->db->where('type' , 'facebook');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('twitter'));
        $this->db->where('type' , 'twitter');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('instagram'));
        $this->db->where('type' , 'instagram');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('youtube'));
        $this->db->where('type' , 'youtube');
        $this->db->update('settings' , $data);
    }
    
    function updateAttendance($timestamp)
    {
        $attendance_of = $this->db->get_where('teacher_attendance' , array('year'=> $this->runningYear, 'timestamp' => $timestamp))->result_array();
        foreach($attendance_of as $row) 
        {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('teacher_attendance' , array('status' => $attendance_status));
        }    
    }
    
    function deleteClassroom($ClassroomId)
    {
        $this->db->where('dormitory_id', $ClassroomId);
        $this->db->delete('dormitory');
    }
    
    function updateClassroom($ClassroomId)
    {
        $data['name']           = $this->input->post('name');
        $this->db->where('dormitory_id', $ClassroomId);
        $this->db->update('dormitory', $data);
    }
    
    function createClassroom()
    {
        $data['name']           = $this->input->post('name');
        $data['number']         = $this->input->post('number');
        $this->db->insert('dormitory', $data);
    }
    
    function fetchStudents($class_id)
    {
        $html = '';
        $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $this->runningYear))->result_array();
        $html .= '
            <div class="col-sm-12">';
            foreach ($students as $row) 
            {
                $html .= '<div class="custom-control custom-checkbox">';
                    $html .= '<input checked type="checkbox" name="student_id[]" id="' . $row['student_id'] . '" value="' . $row['student_id'] . '" class="custom-control-input"> <label for="' . $row['student_id'] . '" class="custom-control-label">' . $this->crud->get_name('student', $row['student_id'])  .'</label>';
                $html .= '</div>';
        }
        $html .= '</div>';
        echo $html;
    }
    
    function createBus()
    {
        $data['route_name']        = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['driver_name'] = $this->input->post('driver_name');
        $data['driver_phone'] = $this->input->post('driver_phone');
        $data['route']        = $this->input->post('route');
        $data['route_fare']        = $this->input->post('route_fare');
        $this->db->insert('transport', $data);
    }
    
    function deleteExpense($expenseId)
    {
        $this->db->where('payment_id' , $expenseId);
        $this->db->delete('payment');
    }
    
    function updateExpense($expenseId)
    {
        $data['title']               =   $this->input->post('title');
        $data['expense_category_id'] =   $this->input->post('expense_category_id');
        $data['description']         =   $this->input->post('description');
        $data['payment_type']        =   'expense';
        $data['method']              =   $this->input->post('method');
        $data['amount']              =   $this->input->post('amount');
        $data['year']                =   $this->runningYear;
        $this->db->where('payment_id' , $expenseId);
        $this->db->update('payment' , $data);
    }
    
    function createExpense()
    {
        $data['title']               =   $this->input->post('title');
        $data['expense_category_id'] =   $this->input->post('expense_category_id');
        $data['description']         =   $this->input->post('description');
        $data['payment_type']        =   'expense';
        $data['method']              =   $this->input->post('method');
        $data['amount']              =   $this->input->post('amount');
        $data['month']               =   date('m');
        $data['timestamp']           =   $this->input->post('timestamp');
        $data['month']               =   date('M');
        $data['year']                =   $this->runningYear;
        $this->db->insert('payment' , $data);
    }
    
    function deleteBus($transportId)
    {
        $this->db->where('transport_id', $transportId);
        $this->db->delete('transport');
    }
    
    function updateBus($transportId)
    {
        $data['route_name']        = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['driver_name']       = $this->input->post('driver_name');
        $data['driver_phone']      = $this->input->post('driver_phone');
        $data['route']             = $this->input->post('route');
        $data['route_fare']        = $this->input->post('route_fare');
        $this->db->where('transport_id', $transportId);
        $this->db->update('transport', $data);
    }
    
    function updateSocialLogin()
    {
        $data['description']   = strip_tags($this->input->post('social_login'));
        $this->db->where('type' , 'social_login');
        $this->db->update('settings' , $data);

        $data['description']   = strip_tags($this->input->post('google_login'));
        $this->db->where('type' , 'google_login');
        $this->db->update('settings' , $data);

        $data['description']   = strip_tags($this->input->post('google_sync'));
        $this->db->where('type' , 'google_sync');
        $this->db->update('settings' , $data);
    }
    
    function updateSkins()
    {
        $md5 = md5(date('d-m-y H:i:s'));
        if($_FILES['favicon']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['favicon']['name']);
            $this->db->where('type' , 'favicon');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['favicon']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['favicon']['name']));
        }
        if($_FILES['logow']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['logow']['name']);
            $this->db->where('type' , 'logow');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['logow']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['logow']['name']));
        }
        if($_FILES['icon_white']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['icon_white']['name']);
            $this->db->where('type' , 'icon_white');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['icon_white']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['icon_white']['name']));
        }
        if($_FILES['userfile']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['userfile']['name']);
            $this->db->where('type' , 'logo');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['userfile']['name']));
        }
        if($_FILES['bglogin']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['bglogin']['name']);
            $this->db->where('type' , 'bglogin');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['bglogin']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['bglogin']['name']));
        }
        if($_FILES['logocolor']['size'] > 0)
        {
            $data['description'] = $md5.str_replace(' ', '', $_FILES['logocolor']['name']);
            $this->db->where('type' , 'logocolor');
            $this->db->update('settings' , $data);
            move_uploaded_file($_FILES['logocolor']['tmp_name'], 'public/uploads/' . $md5.str_replace(' ', '', $_FILES['logocolor']['name']));
        }
    }
    
    function send_news_notify()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $notify['notify'] = getEduAppGTLang('new_notice_info');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get_where('enroll', array('year' => $year))->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach($students as $row1)
        {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($parents as $row2)
        {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/panel";
            $notify['date'] = $this->getDateFormat();;
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($teachers as $row3)
        {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($accountant as $row4)
        {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($librarian as $row5)
        {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }    
    }
    
    function send_polls_notify()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $notify['notify'] = getEduAppGTLang('new_poll_notify');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get_where('enroll', array('year' => $year))->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach($students as $row1)
        {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($parents as $row2)
        {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($teachers as $row3)
        {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($accountant as $row4)
        {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($librarian as $row5)
        {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/panel";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }    
    }
    
    function send_calendar_notify()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $notify['notify'] = getEduAppGTLang('new_event_notify');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get_where('enroll', array('year' => $year))->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach($students as $row1)
        {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/calendar";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($parents as $row2)
        {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/calendar";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($teachers as $row3)
        {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/calendar";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($accountant as $row4)
        {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/calendar";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
        foreach($librarian as $row5)
        {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/calendar";
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }    
    }
    
    function get_correct_answer($question_bank_id = "")
    {
        $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }
    
     function calculate_exam_mark($online_exam_id) {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {
            $data['obtained_mark'] = 0;
        }
        else{
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {
                if ($row['submitted_answer'] == $row['correct_answers']) {
                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark($online_exam_id);
        $query = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];
        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('online_exam_result', $data);
    }
    
     function get_question_details_by_id($question_bank_id, $column_name = "") 
     {
        return $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row()->$column_name;
    }

    function submit_online_exam($online_exam_id = "", $answer_script = ""){
        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );
        $this->db->where($checker);
        $this->db->update('online_exam_result', $updated_array);
        $this->calculate_exam_mark($online_exam_id);
    }
    
    function change_online_exam_status_to_attended_for_student($online_exam_id = "")
    {
        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        if($this->db->get_where('online_exam_result', $checker)->num_rows() == 0)
        {
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('online_exam_result', $inserted_array);
        }
    }

    function check_text($text)
    {
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
        if(preg_match($reg_exUrl, $text, $url)) {
            if(strpos( $url[0], ":" ) === false){
                $link = 'http://'.$url[0];
            }else{
                $link = $url[0];
            }
            echo preg_replace($reg_exUrl, '<a target="_blank" href="'.$link.'" title="'.$url[0].'">'.$url[0].'</a>', $text);
        }else {
            echo $text;
        }
    }
    
    function check_availability_for_student($online_exam_id)
    {
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }
    
    function parent_check_availability_for_student($online_exam_id, $student_id)
    {
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $student_id))->row_array();
        return $result['status'];
    }
    
    function available_exams($student_id,$subject_id) 
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $class_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id,'subject_id' => $subject_id, 'status' => 'published');
        $this->db->order_by("online_exam_id", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }
    
    function parent_available_exams($class_id,$section_id,$subject_id) 
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id,'subject_id' => $subject_id, 'status' => 'published');
        $this->db->order_by("online_exam_id", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }
    
    function get_birthdays()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $array_users = 0;
        $query_admins = $this->db->query("SELECT admin_id, first_name, last_name FROM admin WHERE substring_index(birthday, '/', 1) = ".date('m')."")->num_rows();
        $query_teachers = $this->db->query("SELECT teacher_id, first_name, last_name FROM teacher WHERE substring_index(birthday, '/', 1) = ".date('m')."")->num_rows();
        $query_accountant = $this->db->query("SELECT accountant_id, first_name, last_name FROM accountant WHERE substring_index(birthday, '/', 1) = ".date('m')."")->num_rows();
        $query_librarian = $this->db->query("SELECT librarian_id, first_name, last_name FROM librarian WHERE substring_index(birthday, '/', 1) = ".date('m')."")->num_rows();
        $query_student = $this->db->query("SELECT student_id FROM student WHERE substring_index(birthday, '/', 1) = ".date('m')."")->num_rows();
        $array_users = $query_admins+$query_teachers+$query_accountant+$query_librarian+$query_student;
        return $array_users;
    }
    
    function get_birthdays_by_month($month)
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $array_users = array();
        $query_admins = $this->db->query("SELECT admin_id, first_name, last_name, birthday FROM admin WHERE substring_index(birthday, '/', 1) = ".$month."")->result_array();
        foreach($query_admins as $row)
        {
            $birthDate = $row['birthday'];
            $array_admins= array('name' => $row['first_name'],'user_id' => $row['admin_id'],'birthday' => $row['birthday'], 'type' => 'admin');
            array_push($array_users,$array_admins);
        }
        $query_teachers = $this->db->query("SELECT teacher_id, first_name, last_name, birthday FROM teacher WHERE substring_index(birthday, '/', 1) = ".$month."")->result_array();
        foreach($query_teachers as $row2)
        {
            $birthDate = $row2['birthday'];
            $time = strtotime($birthDate);
            $array_teachers = array('name' => $row2['first_name'],'user_id' => $row2['teacher_id'],'birthday' => $row2['birthday'], 'type' => 'teacher');
            array_push($array_users,$array_teachers);
        }
        $query_accountant = $this->db->query("SELECT accountant_id, first_name, last_name, birthday FROM accountant WHERE substring_index(birthday, '/', 1) = ".$month."")->result_array();
        foreach($query_accountant as $row3)
        {
            $birthDate = $row3['birthday'];
            $time = strtotime($birthDate);
            $array_accountant = array('name' => $row3['first_name'],'user_id' => $row3['accountant_id'],'birthday' => $row3['birthday'], 'type' => 'accountant');
            array_push($array_users,$array_accountant);
        }
        $query_librarian = $this->db->query("SELECT librarian_id, first_name, last_name, birthday FROM librarian WHERE substring_index(birthday, '/', 1) = ".$month."")->result_array();
        foreach($query_librarian as $row4)
        {
            $birthDate = $row4['birthday'];
            $time = strtotime($birthDate);
            $array_librarian = array('name' => $row4['first_name'], 'user_id' => $row4['librarian_id'],'birthday' => $row4['birthday'], 'type' => 'librarian');
            array_push($array_users,$array_librarian);
        }
        $query_student = $this->db->query("SELECT student_id, birthday FROM student WHERE substring_index(birthday, '/', 1) = ".$month."")->result_array();
        foreach($query_student as $row5)
        {
            $birthDate = $row5['birthday'];
            $time = strtotime($birthDate);
            $array_stduent = array('name' => $this->get_name('student', $row5['student_id']), 'birthday' => $row5['birthday'], 'user_id' => $row5['student_id'], 'type' => 'student');
            array_push($array_users,$array_stduent);
        }
        return $array_users;
    }

    function add_multiple_choice_question_to_online_exam($online_exam_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
    }

    function add_image_question_to_online_exam($online_exam_id)
    {
        $time = time();
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
        $data['type']               = 'image';
        $images = array();
        for($i = 0; $i < count($_FILES['options']['name']); $i++)
        {
            array_push($images, $time.$_FILES['options']['name'][$i]);
            move_uploaded_file($_FILES["options"]["tmp_name"][$i], "public/uploads/online_exam/" . $time.$_FILES['options']['name'][$i]);
        }
        $data['options']            = json_encode($images);
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
    }

    function add_true_false_question_to_online_exam($online_exam_id){
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['type']               = 'true_false';
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = html_escape($this->input->post('true_false_answer'));
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
    }

    function add_fill_in_the_blanks_question_to_online_exam($online_exam_id){
        $suitable_words_array = explode(',', html_escape($this->input->post('suitable_words')));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
          array_push($suitable_words, strtolower($row));
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['type']               = 'fill_in_the_blanks';
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = json_encode(array_map('trim',$suitable_words));
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' ,getEduAppGTLang('successfully_added'));
    }

    function update_true_false_question($question_id){
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = html_escape($this->input->post('true_false_answer'));
        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
    }

    function update_image_question($question_id){
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
    }
    
    function get_total_mark($online_exam_id){
        $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0){
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }
    
     function update_fill_in_the_blanks_question($question_id){
        $suitable_words_array = explode(',', html_escape($this->input->post('suitable_words')));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
          array_push($suitable_words, strtolower($row));
        }
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = json_encode(array_map('trim',$suitable_words));

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
    }

    function delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('question_bank');
    }
    
    function update_multiple_choice_question($question_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
    }

    function manage_online_exam_status($online_exam_id = "", $status = ""){
        $checker = array(
            'online_exam_id' => $online_exam_id
        );
        $updater = array(
            'status' => $status
        );

        $this->db->where($checker);
        $this->db->update('online_exam', $updater);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
    }

    public function checkUser($userData = array())
    {
      $credential = array('g_oauth' => $userData['oauth_uid']);
      $query = $this->db->get_where('admin', $credential);
   
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('teacher', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('student', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('parent', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      }
      $query = $this->db->get_where('accountant', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      }
      $query = $this->db->get_where('librarian', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      }
    }

    public function checkusername($username)
    {
      $credential = array('username' => $username);
      $query = $this->db->get_where('admin', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('teacher', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('student', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('parent', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
      $query = $this->db->get_where('accountant', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
      $query = $this->db->get_where('librarian', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
    }

    public function checkUser2($userID)
    {
      $credential = array('fb_id' => $userID);
      $query = $this->db->get_where('admin', $credential);
   
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('teacher', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('student', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';
      }
      $query = $this->db->get_where('parent', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
      $query = $this->db->get_where('accountant', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
      $query = $this->db->get_where('librarian', $credential);
      if ($query->num_rows() > 0) 
      {
        return 'success';                  
      } 
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function count_attendance_students($status)
    {
        $timestamp   = strtotime(date('d-m-Y'));
        $this->db->where('timestamp', $timestamp);
        $this->db->where('status', $status);
        $this->db->from('attendance');
        $result = $this->db->count_all_results();
        return $result;
    }

    function clickatell($message = '' , $reciever = '') 
    {
        $clickatell_user       = $this->db->get_where('settings', array('type' => 'clickatell_username'))->row()->description;
        $clickatell_password   = $this->db->get_where('settings', array('type' => 'clickatell_password'))->row()->description;
        $clickatell_api_id     = $this->db->get_where('settings', array('type' => 'clickatell_api'))->row()->description;
        $clickatell_baseurl    = "http://api.clickatell.com";
        $text   = urlencode($message);
        $to     = $reciever_phone;
        $url = "$clickatell_baseurl/http/auth?user=$clickatell_user&password=$clickatell_password&api_id=$clickatell_api_id";
        $ret = file($url);
        $sess = explode(":",$ret[0]);
        print_r($sess);echo '<br>';
        if ($sess[0] == "OK") 
        {
            $sess_id = trim($sess[1]);
            $url = "$clickatell_baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
            $ret = file($url);
            $send = explode(":",$ret[0]);
            print_r($send);echo '<br>';
            if ($send[0] == "ID") {
                echo "successnmessage ID: ". $send[1];
            } else {
                echo "Failed";
            }
        } else {
            echo "Authentication fail: ". $ret[0];
        }
    }

    function twilio_api($message = "", $reciever = "") 
    {
        $this->load->library('twilio');
	    $response = $this->twilio->sms($this->db->get_where('settings', array('type' => 'registered_phone'))->row()->description, $reciever, $message);
		if($response->IsError)
			echo 'Error: ' . $response->ErrorMessage;
    }

    function tz_list() 
    {
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as $key => $zone) 
        {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zones_array;
    }

    function students_reports($student_name,$parent_email)
    {
        $this->mail->students_reports($student_name,$parent_email);
    }
    
    function send_homework_notify()
    {
        $this->mail->send_homework_notify();
    }
    
    function send_sms_via_msg91($message = '' , $reciever_phone = '') {

        $authKey       = $this->db->get_where('settings', array('type' => 'msg91_key'))->row()->description;
        $senderId      = $this->db->get_where('settings', array('type' => 'msg91_sender'))->row()->description;
        $country_code  = $this->db->get_where('settings', array('type' => 'msg91_code'))->row()->description;
        $route         = $this->db->get_where('settings', array('type' => 'msg91_route'))->row()->description;
        $mobileNumber = $reciever_phone;
        $message = urlencode($message);
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route,
            'country' => $country_code
        );
        $url="http://api.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    function parent_new_invoice($student_name,$parent_email)
    {
        $this->mail->parent_new_invoice($student_name,$parent_email);
    }

    function student_new_invoice($student_name,$student_email)
    {
        $this->mail->student_new_invoice($student_name,$student_email);
    }

    function attendance($student_id,$parent_id)
    {
        $this->mail->attendance($student_id,$parent_id);
    }

     function count_attendance_teacher($status)
    {
        $timestamp   = strtotime(date('d-m-Y'));
        $this->db->where('timestamp' , $timestamp);
        $this->db->where('status' , $status);
        $this->db->from('teacher_attendance');
        $result = $this->db->count_all_results();
        return $result;
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

     function create_post() 
     {
        $data['title'] = $this->input->post('title');
        $data['type'] = $this->session->userdata('login_type');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['timestamp'] = strtotime(date("d M,Y"));
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id']  =   $this->session->userdata('login_user_id');
        $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('forum', $data);
        $post_code = $this->db->get_where('forum', array('post_id' => $this->db->insert_id()))->row()->post_code;
        $docs_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/forum/" . $_FILES["file_name"]["name"]);
        return $post_code;
    }

    function update_post($post_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $this->db->where('post_code', $post_code);
        $this->db->update('forum', $data);
    }

    function create_group()
    {
        $data = array();
        $data['group_message_thread_code'] = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['created_timestamp'] = $this->getDateFormat().' ' .date("H:i");
        $data['group_name'] = $this->input->post('group_name');
        if(!empty($_POST['user'])) 
        {
            array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'));
            $data['members'] = json_encode($_POST['user']);
        }
        else
        {
            $_POST['user'] = array();
            array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'));
            $data['members'] = json_encode($_POST['user']);
        }
        $this->db->insert('group_message_thread', $data);
    }

    function update_group($thread_code = "")
    {
      $data = array();
      $data['group_name'] = $this->input->post('group_name');
      if(!empty($_POST['user'])) 
      {
          array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'));
          $data['members'] = json_encode($_POST['user']);
      }
      else{
        $_POST['user'] = array();
        array_push($_POST['user'], $this->session->userdata('login_type').'_'.$this->session->userdata('login_user_id'));
        $data['members'] = json_encode($_POST['user']);
      }
      $this->db->where('group_message_thread_code', $thread_code);
      $this->db->update('group_message_thread', $data);
    }
    
    function getDateFormat(){
        return date($this->db->get_where('settings', array('type' => 'date_format'))->row()->description);
    }
    
    function createTeacherReport()
    {
        $data['title']          = $this->input->post('title');
        $data['report_code']    = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['priority']       = $this->input->post('priority');
        $data['teacher_id']     = $this->input->post('teacher_id');
        $data['status']     = 0;
        $login_type             = $this->session->userdata('login_type');
        if($login_type == 'student') $data['student_id']  = $this->session->userdata('login_user_id');
        else $data['student_id']  = $this->input->post('student_id');
        $data['timestamp']      = $this->crud->getDateFormat();
        $data['description']       = $this->input->post('description');
        if($_FILES['file']['name'] != '') $data['file']          = $_FILES['file']['name'];
        $this->db->insert('reporte_alumnos', $data);
        move_uploaded_file($_FILES['file']['tmp_name'], 'public/uploads/reportes_alumnos/' . $_FILES['file']['name']);


        $notify['notify'] = "<strong>". $this->session->userdata('name')."</strong>". " ". getEduAppGTLang('teacher_report_notify').":"." ". "<b>".$this->db->get_where('teacher', array('teacher_id' => $this->input->post('teacher_id')))->row()->name."</b>";
        $admins = $this->db->get('admin')->result_array();
        foreach($admins as $row)
        {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = "admin";
            $notify['url'] = "admin/view_report/".$data['report_code']."/";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    function deleteExam($examId)
    {
        $this->db->where('online_exam_id', $examId);
        $this->db->delete('online_exam');
    }
    
    function deleteNotification($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('notification');
    }
    
    function checkPublicUsername()
    {
        if($_POST['c'] != "")
        {
            $credential = array('username' => $_POST['c']);
            $query = $this->db->get_where('admin', $credential);
            if ($query->num_rows() > 0) 
            {
                return 'success';
            }
            $query = $this->db->get_where('teacher', $credential);
            if ($query->num_rows() > 0) 
            {
              return 'success';
            }             
            $query = $this->db->get_where('student', $credential);
            if ($query->num_rows() > 0) 
            {
                return 'success';
            }
            $query = $this->db->get_where('parent', $credential);
            if ($query->num_rows() > 0) 
            {
                return 'success';                  
            } 
            $query = $this->db->get_where('accountant', $credential);
            if ($query->num_rows() > 0) 
            {
                return 'success';                  
            } 
            $query = $this->db->get_where('librarian', $credential);
            if ($query->num_rows() > 0) 
            {
                return 'success';                  
            } 
        }
    }
    
    function saveLiveStatus($_id)
    {
        $query  = $this->db->get_where('live_status', array('live_id' => $_id, 'student_id' => $this->session->userdata('login_user_id')))->num_rows();
        if($query == 0){
            $insert['live_id'] = $_id;
            $insert['student_id'] = $this->session->userdata('login_user_id');
            $insert['date'] = date('d/m/Y H:i A');
            $this->db->insert('live_status',$insert);
        }
    }
    
    function saveLiveAttendance($liveId)
    {
        $url = $this->db->get_where('live', array('live_id' => $liveId))->row()->siteUrl;
        $query = $this->db->get_where('attendance_live', array('live_id' => $liveId, 'student_id' => $this->session->userdata('login_user_id')));
        if($query->num_rows() == 0)
        {
            $data['student_id']  = $this->session->userdata('login_user_id');
            $data['date']        = $this->crud->getDateFormat().' '.date('H:i A');
            $data['live_id']     = $liveId;
            $data['year']        = $this->runninYear;
            $this->db->insert('attendance_live', $data);
        }
    }
    
    function updateFbToken($accessToken)
    {
        $data['fb_token']   = $accessToken;
        $data['fb_id']      = $_SESSION['userData']['id'];
        $data['fb_photo']   = $_SESSION['userData']['picture']['url'];
        $data['fb_name']    = $_SESSION['userData']['first_name']. " ". $_SESSION['userData']['last_name'];
        $data['femail']     = $_SESSION['userData']['email'];
        $this->db->where($this->session->userdata('login_type')."_id", $this->session->userdata('login_user_id'));
        $this->db->update($this->session->userdata('login_type'), $data);
    }
    
    function send_reply_group_message($message_thread_code) 
    {
       $max_size = 2097152;
       if(!file_exists('public/uploads/group_messaging_attached_file/')) 
        {
            $oldmask = umask(0);
            mkdir ('public/uploads/group_messaging_attached_file/', 0777);
        }
        if ($_FILES['attached_file_on_messaging']['name'] != "") 
        {
            if($_FILES['attached_file_on_messaging']['size'] > $max_size)
            {
                $this->session->set_flashdata('error_message' , getEduAppGTLang('2MB_allowed'));
                redirect(base_url() . 'admin/group/group_message_read/'.$message_thread_code, 'refresh');
            }
            else{
                $file_path = 'public/uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
            }
        }
        $message    = $this->input->post('message');
        $timestamp  = $this->getDateFormat().' '.date("H:iA");
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        if ($_FILES['attached_file_on_messaging']['name'] != "") 
        {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
          $data_message['file_type'] = strtolower(pathinfo($_FILES["attached_file_on_messaging"]["name"], PATHINFO_EXTENSION));
        }
        $data_message['group_message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('group_message', $data_message);
    }

    function count_unread_messages() 
    {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->group_by('message_thread_code');
        $this->db->where('read_status', 0);
        $this->db->where('reciever', $current_user);
        $unread_message_counter = $this->db->get('message')->num_rows();
        return $unread_message_counter;
    }
    
    function create_post_message($post_code = '') 
    {
        $data['message'] = $this->input->post('message');
        $data['post_id'] = $this->db->get_where('forum', array('post_code' => $post_code))->row()->post_id;
        $data['date'] = $this->getDateFormat().' '.date("H:iA");
        $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
        $this->db->insert('forum_message', $data);
        
        $notify['notify'] = "<strong>".  $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('comment_forum') ." <b>".$this->db->get_where('forum', array('post_code' => $this->input->post('post_code')))->row()->title."</b>";
        $for_type = $this->db->get_where('forum', array('post_code' => $this->input->post('post_code')))->row()->type;
        $for_id   = $this->db->get_where('forum', array('post_code' => $this->input->post('post_code')))->row()->teacher_id;
        $notify['user_id'] = $for_id;
        $notify['user_type'] = $for_type;
        $notify['url'] = $for_type."/forumroom/".$this->input->post('post_code')."/";
        $notify['date'] = $this->crud->getDateFormat();
        $notify['time'] = date('h:i A');
        $notify['status'] = 0;
        $notify['original_id'] = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
    }

    function delete_homework($homework_code) {
        $file_n = $this->db->get_where('homework', array('homework_code' => $homework_code))->row()->file_name;
        unlink("public/uploads/homework/" . $file_n);
        $this->db->where('homework_code', $homework_code);
        $this->db->delete('homework');
    }

     function delete_post($post_code) {
        $this->db->where('post_code', $post_code);
        $this->db->delete('forum');
    }

    function admin_delete($admin_id) {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin');
    }
    
    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }
    
    function update_online_exam(){
        $this->academic->update_online_exam();
    }
    
    function get_student_info_by_id($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        return $query;
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }
    
    function income($month)
    {
      $income = $this->db->get_where('payment', array('month' => $month, 'payment_type' => 'income'))->result_array();
      $total = 0;
      foreach($income as $row)
      {
        $total += $this->db->get_where('invoice', array('invoice_id' => $row['invoice_id']))->row()->amount;
      }
      return $total;
    }

    function expense($month)
    {
      $expese = $this->db->get_where('payment', array('month' => $month,'payment_type' => 'expense'))->result_array();
      $total = 0;
      foreach($expese as $row)
      {
        $total += $row['amount'];
      }
      return $total;
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }
    
    function getWall()
    {
        $query= $this->db->query('SELECT description, publish_date, type,news_id FROM news UNION SELECT question,publish_date,type,id FROM polls ORDER BY publish_date DESC LIMIT 5')->result_array();
        return $query;
    }

    function saveUser()
    {
        $session    = session_id();
        $time       = time();
        $time_check = $time-300;
        $this->db->where('session', $session);
        $count = $this->db->get('online_users')->num_rows();
        if($count == 0)
        { 
            $data['time'] = $time;
            $data['type'] = $this->session->userdata('login_type');
            $data['id_usuario'] = $this->session->userdata('login_user_id');
            $data['gp'] = $this->session->userdata('login_user_id')."-".$this->session->userdata('login_type');
            $data['session'] = $session;
            $this->db->insert('online_users',$data);
        }
        else 
        {
            $data['session'] = $session;
            $data['time'] = $time;
            $data['gp'] = $this->session->userdata('login_user_id')."-".$this->session->userdata('login_type');
            $data['id_usuario'] = $this->session->userdata('login_user_id');
            $data['type'] = $this->session->userdata('login_type');
            $this->db->where('session', $session);
            $this->db->update('online_users', $data);
        }  
        $this->db->where('time <', $time_check);
        $this->db->delete('online_users');        
    }
    
    function fetchNotifications()
    {
        $this->db->limit(5);
        $this->db->order_by('id', 'desc');
        $n = $this->db->get_where('notification', array('user_id' => $this->session->userdata('login_user_id'), 'user_type' => $this->session->userdata('login_type')))->result_array();
        return $n;
    }
    
    function getFancyChat()
    {
        $fancy_current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->limit(5);
        $this->db->order_by('message_thread_id', 'desc');
        $this->db->where('sender', $fancy_current_user);
        $this->db->or_where('reciever', $fancy_current_user);
        $fancy_message_threads = $this->db->get('message_thread')->result_array();
        return $fancy_message_threads;
    }
    
    function getChat()
    {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
  	    $this->db->where('sender', $current_user);
  	    $this->db->or_where('reciever', $current_user);
  	    $fancy_message_threads = $this->db->get('message_thread')->result_array();
        return $fancy_message_threads;
    } 
    
    function get_grade($mark_obtained) 
    {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $ro) {
            if ($mark_obtained >= $ro['mark_from'] && $mark_obtained <= $ro['mark_upto'])
                echo $ro['grade_point'];
        }
    }

    function getInfo($type) {
        $query = $this->db->get_where('settings', array('type' => $type));
        return $query->row()->description;
    }
    
    function getUserSocial($table,$column) {
        $query = $this->db->get_where($table, array($table.'_id' => $this->session->userdata('login_user_id')));
        return $query->row()->$column;
    }
    
    function get_name($type = '', $id = '')
    {
        $first = $this->db->get_where(''.$type.'',array($type."_id" => $id))->row()->first_name;
        $last = $this->db->get_where(''.$type.'',array($type."_id" => $id))->row()->last_name;
        $name = $first." ".$last;
        return $name;
    }

    function get_image_url($type = '', $id = '') 
    {
        $img = $this->db->get_where(''.$type.'',array($type."_id" => $id))->row()->image;
        $name = strtoupper($this->db->get_where(''.$type.'',array($type."_id" => $id))->row()->first_name);
        if (file_exists('public/uploads/' . $type . '_image/' . $img) && $img != "")
            $image_url = base_url() . 'public/uploads/' . $type . '_image/' . $img;
        else
            $image_url = base_url() . 'public/uploads/avatars/'.$name[0].'.svg';
        return $image_url;
    }

    function get_image_video($type = '', $id = '') 
    {
         if (file_exists('public/uploads/screen/' . $id . '.jpg'))
            $image_url = base_url() . 'public/uploads/screen/' . $id . '.jpg';
        else $image_url = base_url() . 'public/uploads/user.jpg';

        return $image_url;
    }
    
    function teacherSendSMS()
    {
        $sms_status = $this->db->get_where('settings' , array('type' => 'sms_status'))->row()->description; 
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $class_id   =   $this->input->post('class_id');
        $section_id   =   $this->input->post('section_id');
        $receiver   =   $this->input->post('receiver');
        $users = $this->db->get_where('enroll' , array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $year))->result_array();
        $message = $this->input->post('message');
        foreach ($users as $row) 
        {
            if($receiver == 'student'){
                $phones = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
            }else{
                $this->db->group_by('parent_id');
                $parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                $phones = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
            }
            if ($sms_status == 'twilio') 
            {
                 $this->crud->twilio_api($message,$phones);
            }else if ($sms_status == 'clickatell') 
            {
                 $this->crud->clickatell($message,$phones);
            }  
            else if ($sms_status == 'msg91') 
            {
                 $this->crud->send_sms_via_msg91($message,$phones);
            }  
        }
    }
    
    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
        return round(pow(1024, $base - floor($base)), $precision) .''. $suffixes[floor($base)];
    }

    function get_expense($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $expense = $this->db->get_where('payment', array('year' => $year, 'payment_type' => 'expense', 'month' => $month))->result_array();
        $total = 0;
        foreach($expense as $row){
            $total += $row['amount'];
        }
        return $total;
    }
    
    function get_payments($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $expense = $this->db->get_where('payment', array('year' => $year, 'payment_type' => 'income', 'month' => $month))->result_array();
        $total = 0;
        foreach($expense as $row){
            $total += $row['amount'];
        }
        return $total;
    }

    function create_news() 
    {
        $data['news_code']           = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description']         = $this->input->post('description');
        $data['date']                = $this->getDateFormat();
        $data['publish_date']        = date('Y-m-d H:i:s');
        $data['admin_id']        = $this->session->userdata('login_user_id');
        $data['date2']                = date('H:i A');
        $data['type']                = "news";
        $this->db->insert('news', $data);
        $news_code = $this->db->get_where('news' , array('news_id' => $this->db->insert_id()))->row()->news_code;
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/news_images/' . $news_code . '.jpg');
        return $news_code;
    }

    function import_db()
    {
        $this->load->database();
        $this->db->truncate('academic_settings');
        $this->db->truncate('accountant');
        $this->db->truncate('account_role');
        $this->db->truncate('admin');
        $this->db->truncate('attendance');
        $this->db->truncate('book');
        $this->db->truncate('book_request');
        $this->db->truncate('ci_sessions');
        $this->db->truncate('class');
        $this->db->truncate('class_routine');
        $this->db->truncate('deliveries');
        $this->db->truncate('document');
        $this->db->truncate('dormitory');
        $this->db->truncate('email_template');
        $this->db->truncate('enroll');
        $this->db->truncate('events');
        $this->db->truncate('exam');
        $this->db->truncate('expense_category');
        $this->db->truncate('file');
        $this->db->truncate('folder');
        $this->db->truncate('forum');
        $this->db->truncate('forum_message');
        $this->db->truncate('grade');
        $this->db->truncate('group_message');
        $this->db->truncate('group_message_thread');
        $this->db->truncate('homework');
        $this->db->truncate('horarios_examenes');
        $this->db->truncate('invoice');
        $this->db->truncate('language');
        $this->db->truncate('librarian');
        $this->db->truncate('mark');
        $this->db->truncate('mensaje_reporte');
        $this->db->truncate('message');
        $this->db->truncate('message_thread');
        $this->db->truncate('news');
        $this->db->truncate('notice_message');
        $this->db->truncate('notification');
        $this->db->truncate('online_exam');
        $this->db->truncate('online_exam_result');
        $this->db->truncate('online_users');
        $this->db->truncate('parent');
        $this->db->truncate('payment');
        $this->db->truncate('pending_users');
        $this->db->truncate('polls');
        $this->db->truncate('poll_response');
        $this->db->truncate('question_bank');
        $this->db->truncate('question_paper');
        $this->db->truncate('reporte_alumnos');
        $this->db->truncate('reporte_mensaje');
        $this->db->truncate('reports');
        $this->db->truncate('report_response');
        $this->db->truncate('request');
        $this->db->truncate('section');
        $this->db->truncate('settings');
        $this->db->truncate('student');
        $this->db->truncate('students_request');
        $this->db->truncate('subject');
        $this->db->truncate('teacher');
        $this->db->truncate('teacher_attendance');
        $this->db->truncate('teacher_files');
        $this->db->truncate('ticket');
        $this->db->truncate('ticket_message');
        $this->db->truncate('homework_files');
        $this->db->truncate('attendance_live');
        $this->db->truncate('live_status');
        $this->db->truncate('transport');

        $file_n = $_FILES["file_name"]["name"];
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/" . $_FILES["file_name"]["name"]);
        $filename = "public/uploads/".$file_n;
        $mysql_host = $this->db->hostname;
        $mysql_username = $this->db->username;
        $mysql_password = $this->db->password;
        $mysql_database = $this->db->database;
        mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connect to MySQL: ' . mysql_error());
        mysql_select_db($mysql_database) or die('Error to connect MySQL: ' . mysql_error());
        $templine = '';
        $lines = file($filename);
        foreach ($lines as $line)
        {
                if (substr($line, 0, 2) == '--' || $line == '')
                {
                    continue;
                }
                $templine .= $line;
                if (substr(trim($line), -1, 1) == ';')
                {
                    mysql_query($templine) or print('Error \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                    $templine = '';
                if (mysql_errno() == 1062) 
                {
                print 'no way!';
                }
            }
        }
        unlink("public/uploads/" . $file_n);
        $this->session->set_flashdata('flash_message' , "Import success");
    }

    function check_student_homework($homework_code,$student_id)
    {
        $query = $this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $student_id))->num_rows();
        return $query;
    }
    
    function delete_book($libro_id) {
        $this->db->where('libro_id', $libro_id);
        $this->db->delete('libreria');
    }
    
        
    function get_timeline($date,$student_id)
    {
        $class_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
        $explode_date = explode('-', $date);
        $query_date = $explode_date[1].'/'.$explode_date[2].'/'.$explode_date[0];
        $query_date_exams = strtotime($query_date);
        $query_date_forum = date($explode_date[0].'-'.$explode_date[1].'-'.$explode_date[2]);
        $db = $this->db->query("SELECT title, time_end, date_end,homework_id,wall_type,class_id, section_id FROM homework WHERE class_id = '$class_id' AND section_id = '$section_id' AND date_end = '$query_date' UNION SELECT title,time_end,exam_date,online_exam_id,wall_type,class_id,section_id FROM online_exam WHERE class_id = '$class_id' AND section_id = '$section_id' AND exam_date = '$query_date_exams' UNION SELECT title,timestamp,publish_date,post_id,wall_type,class_id, section_id FROM forum WHERE class_id = '$class_id' AND section_id = '$section_id' AND publish_date BETWEEN '$query_date_forum 00:00:00' AND '$query_date_forum 23:59:59' UNION SELECT title, date, time, live_id, wall_type, class_id, section_id FROM live WHERE class_id = '$class_id' AND section_id = '$section_id' AND date  =  '$query_date'")->result_array();    
        return $db;
    }
    
    function check_li_status($_type, $_id,$student_id)
    {
        if($_type == 'homework')
        {
            $query = $this->db->get_where('homework', array('homework_id' => $_id))->row()->homework_code;
            $time1 = $this->db->get_where('homework', array('homework_id' => $_id))->row()->date_end; 
            $time2 = $this->db->get_where('homework', array('homework_id' => $_id))->row()->time_end;
            $date  = date('m/d/Y H:i');
            $time  = $time1. " ".$time2;
            if($this->check_student_homework($query,$student_id) > 0)
            {
                return 'complete';
            }else if($this->check_student_homework($query,$student_id) == 0 && $date > $time){
                return 'danger';
            }else{
                return 'warning';
            }
        }
        else if($_type == 'exam')
        {
            $exam_date  = $this->db->get_where('online_exam', array('online_exam_id' => $_id))->row()->exam_date;
            $time_start = $this->db->get_where('online_exam', array('online_exam_id' => $_id))->row()->time_start;
            $time_end   = $this->db->get_where('online_exam', array('online_exam_id' => $_id))->row()->time_end;
            $current_time = time();
            $exam_start_time = strtotime(date('Y-m-d', $exam_date).' '.$time_start);
            $exam_end_time = strtotime(date('Y-m-d', $exam_date).' '.$time_end);
            if($this->check_availability_for_student($_id) != "submitted")
            {
                if($current_time >= $exam_start_time && $current_time <= $exam_end_time)
                {
					return 'warning';
				}else if($current_time <= $exam_end_time)
				{
					return 'warning';
                }
                else{
                    return 'danger';
                }
            }else{
                return 'complete';   
            }
        }
        else if($_type == 'forum')
        {
            if($this->check_student_forum($_id,$student_id) > 0)
            {
                return 'complete';
            }else{
                return 'danger';
            }
        }
        else if($_type == 'live')
        {
            if($this->check_student_live($_id,$student_id) > 0)
            {
                return 'complete';
            }else{
                return 'danger';
            }
        }else
        {
            return 'warning';
        }
    }
    
    function check_student_forum($post_id,$student_id)
    {
        $query = $this->db->get_where('forum_message' , array('post_id' => $post_id, 'user_id' => $student_id,'user_type' => 'student'))->num_rows();
        return $query;
    }
    
    function check_student_live($live_id,$student_id)
    {
        $query = $this->db->get_where('live_status' , array('live_id' => $live_id, 'student_id' => $student_id))->num_rows();
        return $query;
    }
    
    function date_week($u_date) 
    {
        $date_obj = new DateTime($u_date); 
        $num_day = intval($date_obj->format('w'))-1; 
        $date_obj->modify("-$num_day day");
        $wdays = array();
        for($i=0; $i<7; $i++) {
            $wdays[] = $date_obj->format('Y-m-d');
            $date_obj->modify('+1 day'); 
        }
        return $wdays;
    }

    function panelDate()
    {
        $days = array(getEduAppGTLang("Monday"),getEduAppGTLang("Tuesday"),getEduAppGTLang("Wednesday"),getEduAppGTLang("Thursday"),getEduAppGTLang("Friday"),getEduAppGTLang("Saturday"),getEduAppGTLang("Sunday"));
        return $days;
    }
    
    function create_news_message($news_code = '') 
    {
      $admins = $this->db->get('admin')->result_array();
      $notify['notify'] = "<strong>".$this->session->userdata('name')."</strong>". " ". getEduAppGTLang('new_comment') ." <b>".$this->db->get_where('news' , array('news_code' => $news_code))->row()->title."</b>";
      foreach($admins as $row)
      {
          $notify['user_id'] = $row['admin_id'];
          $notify['user_type'] = "admin";
          $notify['url'] = "admin/read/".$news_code;
          $notify['date'] = $this->getDateFormat();
          $notify['time'] = date('h:i A');
          $notify['status'] = 0;
          $notify['original_id'] = $this->session->userdata('login_user_id');
          $notify['original_type'] = $this->session->userdata('login_type');
          $this->db->insert('notification', $notify);
        }

        $data['message']      = $this->input->post('message');
        $data['news_id']      = $this->db->get_where('news' , array('news_code' => $news_code))->row()->news_id;
        $data['date']         = $this->getDateFormat();
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        return $this->db->insert('mensaje_reporte', $data);
    }    

     function create_notice_message($notice_code = '') 
    {
        $data['message']      = $this->input->post('message');
        $data['notice_id']   = $this->db->get_where('news_teacher' , array('notice_code' => $notice_code))->row()->notice_id;
        $data['date']         = $this->getDateFormat();
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        if ( $_FILES['userfile']['name'] != '')
            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('notice_message', $data);
        if ( $_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'public/uploads/notice_message_file/' . $_FILES['userfile']['name']);
        
    }   

    function delete_study_material_info($document_id)
    {
        $file_n = $this->db->get_where('document', array('document_id' => $document_id))->row()->file_name;
        unlink("public/uploads/document/" . $file_n);
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }

    function send_new_private_message() 
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $message    = $this->input->post('message');
        $timestamp  = $this->getDateFormat().' '.date("H:iA");
        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
        if ($num1 == 0 && $num2 == 0) 
        {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $data_message_thread['last_message_timestamp']            = date('Y-m-d H:i:s');
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
        {
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        }
        if ($num2 > 0)
        {
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
        }
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['reciever']               = $reciever;
        $data_message['timestamp']              = $timestamp;
        $data_message['file_type']              = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));
        $data_message['file_name']              = $_FILES["file_name"]["name"];
        $this->db->insert('message', $data_message);

        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>". $name."</strong>". " ". getEduAppGTLang('new_message_notify');
        $rec = explode("-", $this->input->post('reciever'));
        $notify['user_id'] = $rec[1];
        $notify['user_type'] = $rec[0];
        $notify['url'] = $rec[0]."/message/message_read/".$message_thread_code."/";
        $notify['date'] = $this->getDateFormat();
        $notify['time'] = date('h:i A');
        $notify['status'] = 0;
        $notify['year'] = $year;
        $notify['type'] = 'message';
        $notify['original_id'] = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/messages/" . $_FILES["file_name"]["name"]);
        return $message_thread_code;
    }
    
    function send_exam_notify()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>".$name."</strong>". " ". getEduAppGTLang('online_exam_notify') ." <b>".$this->input->post('exam_title')."</b>";
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        foreach($students as $row)
        {
            $notify['user_id'] = $row['student_id'];
            $notify['user_type'] = 'student';
            $notify['url'] = "student/online_exams/".base64_encode($this->input->post('class_id').'-'.$this->input->post('section_id').'-'.$this->input->post('subject_id'));
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'exam';
            $notify['year'] = $year;
            $notify['class_id'] = $this->input->post('class_id');
            $notify['section_id'] = $this->input->post('section_id');
            $notify['subject_id'] = $this->input->post('subject_id');
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    function send_forum_notify()
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>".$name."</strong>". getEduAppGTLang('added_new_forum_discussion');
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        foreach($students as $row)
        {
            $notify['user_id'] = $row['student_id'];
            $notify['user_type'] = 'student';
            $notify['url'] = "student/forum/".base64_encode($this->input->post('class_id').'-'.$this->input->post('section_id').'-'.$this->input->post('subject_id'));
            $notify['date'] = $this->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'forum';
            $notify['year'] = $year;
            $notify['class_id'] = $this->input->post('class_id');
            $notify['section_id'] = $this->input->post('section_id');
            $notify['subject_id'] = $this->input->post('subject_id');
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }
    
    function deleteGroup($group_message_thread_code)
    {
        $this->db->where('group_message_thread_code', $group_message_thread_code);
        $this->db->delete('group_message');
        $this->db->where('group_message_thread_code', $group_message_thread_code);
        $this->db->delete('group_message_thread');    
    }

    function send_reply_message($message_thread_code) 
    {
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $message    = $this->input->post('message');
        $timestamp  = $this->getDateFormat().' '.date("H:iA");
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $data_message['file_name']              = $_FILES["file_name"]["name"];
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $data_message['reciever'] = $this->input->post('reciever');
        $data_message['file_type']              = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));
        $this->db->insert('message', $data_message);
        $reci;
        $notify['notify'] = "<strong>".$name."</strong>". " ". getEduAppGTLang('new_message_notify');
        $rec = explode("-", $this->input->post('reciever'));
        if($rec[0] == "parent"){
          $reci = "parents";
        }else{
          $reci = $rec[0];
        }
        $notify['user_id'] = $rec[1];
        $notify['user_type'] = $rec[0];
        $notify['date'] = $this->getDateFormat();
        $notify['time'] = date('h:i A');
        $notify['url'] = $reci."/message/message_read/".$message_thread_code;
        $notify['status'] = 0;
        $notify['type'] = 'message';
        $notify['year'] = $year;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        $this->db->insert('notification', $notify);
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/messages/" . $_FILES["file_name"]["name"]);
    }

    function mark_thread_messages_read($message_thread_code) {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }
    
    function create_report() 
    {
        $data['title']          = $this->input->post('title');
        $data['report_code']    = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['priority']       = $this->input->post('priority');
        $data['teacher_id']     = $this->input->post('teacher_id');
        $data['status']     = 0;
        $login_type             = $this->session->userdata('login_type');
        if($login_type == 'student') $data['student_id']  = $this->session->userdata('login_user_id');
        else $data['student_id']  = $this->input->post('student_id');
        $data['timestamp']      = $this->getDateFormat();
        $data['description']       = $this->input->post('description');
        if($_FILES['file']['name'] != '') $data['file']          = $_FILES['file']['name'];
        $this->db->insert('reporte_alumnos', $data);
        move_uploaded_file($_FILES['file']['tmp_name'], 'public/uploads/reportes_alumnos/' . $_FILES['file']['name']);
    }

     function delete_report($report_code) {
        $this->db->where('report_code', $report_code);
        $this->db->delete('reporte_alumnos');
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function permission_request()
    {
        $data['teacher_id']   = $this->session->userdata('login_user_id');
        $data['description']  = $this->input->post('description');
        $data['title']        = $this->input->post('title');
        $data['start_date']   = $this->input->post('start_date');
        $data['end_date']     = $this->input->post('end_date');
        $data['file']         = $_FILES["file_name"]["name"];
        $this->db->insert('request', $data);
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "public/uploads/request/" . $_FILES["file_name"]["name"]);            

        $notify['notify'] = "<strong>".  $this->crud->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'))."</strong>". " ". getEduAppGTLang('absense_teacher');
        $admins = $this->db->get('admin')->result_array();
        foreach($admins as $row)
        {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = "admin";
            $notify['url'] = "admin/request";
            $notify['date'] = $this->crud->getDateFormat();
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            $this->db->insert('notification', $notify);
        }
    }

    function create_backup() 
    {
        $this->load->dbutil();
        $options = array(
            'format' => 'txt', 
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n"
        );
        $tables = array('');
        $file_name = 'system_backup';
        $backup = & $this->dbutil->backup(array_merge($options, $tables));
        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }
    
    function updateAcademicSettings()
    {
        $data['description']  = $this->input->post('report_teacher');
        $this->db->where('type' , 'students_reports');
        $this->db->update('settings' , $data);

        $data['description']  = $this->input->post('minium_mark');
        $this->db->where('type' , 'minium_mark');
        $this->db->update('academic_settings' , $data);
        
        if($this->input->post('routine') == "1"){
            $routine =  $this->input->post('routine');
        }else{
            $routine = 2;
        }
        $data['description']  = $routine;
        $this->db->where('type' , 'routine');
        $this->db->update('academic_settings' , $data);
        
        $data['description']  = $this->input->post('terms');
        $this->db->where('type' , 'terms');
        $this->db->update('academic_settings' , $data);
    }
    
    function setPermissions()
    {
        $data['permissions'] = $this->input->post('messages');
        $this->db->where('type' , 'messages');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('admins');
        $this->db->where('type' , 'admins');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('parents');
        $this->db->where('type' , 'parents');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('teachers');
        $this->db->where('type' , 'teachers');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('students');
        $this->db->where('type' , 'students');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('accountants');
        $this->db->where('type' , 'accountants');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('librarians');
        $this->db->where('type' , 'librarians');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('library');
        $this->db->where('type' , 'library');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('academic');
        $this->db->where('type' , 'academic');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('attendance');
        $this->db->where('type' , 'attendance');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('calendar');
        $this->db->where('type' , 'calendar');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('files');
        $this->db->where('type' , 'files');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('polls');
        $this->db->where('type' , 'polls');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('notifications');
        $this->db->where('type' , 'notifications');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('admissions');
        $this->db->where('type' , 'admissions');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('behavior');
        $this->db->where('type' , 'behavior');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('news');
        $this->db->where('type' , 'news');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('school_bus');
        $this->db->where('type' , 'school_bus');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('classrooms');
        $this->db->where('type' , 'classrooms');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('accounting');
        $this->db->where('type' , 'accounting');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('schedules');
        $this->db->where('type' , 'schedules');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('system_reports');
        $this->db->where('type' , 'system_reports');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('academic_settings');
        $this->db->where('type' , 'academic_settings');
        $this->db->update('account_role' , $data);
        
        $data['permissions'] = $this->input->post('settings');
        $this->db->where('type' , 'settings');
        $this->db->update('account_role' , $data);
    }
    
    function deleteStudent($student_id)
    {
        $tables = array('student', 'attendance', 'enroll', 'invoice', 'mark', 'payment', 'students_request', 'reporte_alumnos');
        $this->db->delete($tables, array('student_id' => $student_id));
        $threads = $this->db->get('message_thread')->result_array();
        if (count($threads) > 0) 
        {
            foreach ($threads as $row) 
            {
                $sender = explode('-', $row['sender']);
                $receiver = explode('-', $row['reciever']);
                if (($sender[0] == 'student' && $sender[1] == $student_id) || ($receiver[0] == 'student' && $receiver[1] == $student_id)) 
                {
                    $thread_code = $row['message_thread_code'];
                    $this->db->delete('message', array('message_thread_code' => $thread_code));
                    $this->db->delete('message_thread', array('message_thread_code' => $thread_code));
                }
            }
        }
    }
    
    function attendanceSelector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->input->post('year');
        $originalDate       = $this->input->post('timestamp');
        $newDate            = date("d-m-Y", strtotime($originalDate));
        $data['timestamp']  = strtotime($newDate);
        $data['section_id'] = $this->input->post('section_id');
            $query = $this->db->get_where('attendance' ,array(
                'class_id'=>$data['class_id'],
                    'subject_id'=>$data['subject_id'],
                        'section_id'=>$data['section_id'],
                            'year'=>$data['year'],
                                'timestamp'=>$data['timestamp']));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array('class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']))->result_array();
            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['subject_id'] = $data['subject_id'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
        return $data['timestamp'];
    }
    
    function sendSMS()
    {
        $sms_status = $this->db->get_where('settings' , array('type' => 'sms_status'))->row()->description; 
        $class_id   = $this->input->post('class_id');
        $receiver   = $this->input->post('receiver');
        if($receiver == 'student'){
            $users  = $this->db->get_where('enroll' , array('class_id' => $class_id, 'year' => $this->runningYear))->result_array();
        }else{
            $users  = $this->db->get(''.$this->input->post('receiver').'')->result_array();
        }
        $message    = $this->input->post('message');
        foreach ($users as $row) 
        {
            if($receiver == 'student'){
                $phones = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
            }else{
                $phones = $row['phone'];
            }
            if ($sms_status == 'twilio') 
            {
                $this->twilio_api($message,$phones);
            }elseif($sms_status == 'clickatell') 
            {
                $this->clickatell($message,$phones);
            }  
            elseif($sms_status == 'msg91') 
            {
                $this->send_sms_via_msg91($message,$phones);
            }  
        }
    }
    
    function attendanceUpdate($class_id, $section_id,$subject_id, $timestamp)
    {
        $sms_status   = $this->db->get_where('settings' , array('type' => 'sms_status'))->row()->description;
        $notify       = $this->db->get_where('settings' , array('type' => 'absences'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array('class_id'=>$class_id,'section_id'=>$section_id,'subject_id' => $subject_id,'year'=> $this->runningYear,'timestamp'=>$timestamp))->result_array();
        foreach($attendance_of_students as $row) 
        {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));
            if ($attendance_status == 2) 
            {
                $student_name   = $this->crud->get_name('student',$row['student_id']);
                $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                $parent_em      = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email;
                $receiver       = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                $message        = getEduAppGTLang('your_child') . ' ' . $student_name . getEduAppGTLang('is_absent_today');
                if($notify == 1)
                {
                    if ($sms_status == 'msg91') 
                    {
                        $this->crud->send_sms_via_msg91($message, $receiver);
                    }
                    else if ($sms_status == 'twilio') 
                    {
                        $this->crud->twilio_api($message,"".$receiver."");
                    }
                    else if ($sms_status == 'clickatell') 
                    {
                        $this->crud->clickatell($message,$receiver);
                    }
              }
              $this->crud->attendance($row['student_id'], $parent_id);
            }
        }
    }
    
    function smsStatus()
    {
        $data['description'] = $this->input->post('sms_status');
        $this->db->where('type' , 'sms_status');
        $this->db->update('settings' , $data);
    }
    
    function msg91()
    {
        $data['description'] = strip_tags($this->input->post('msg91_key'));
        $this->db->where('type' , 'msg91_key');
        $this->db->update('settings' , $data);
        
        $data['description'] = strip_tags($this->input->post('msg91_sender'));
        $this->db->where('type' , 'msg91_sender');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('msg91_route'));
        $this->db->where('type' , 'msg91_route');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('msg91_code'));
        $this->db->where('type' , 'msg91_code');
        $this->db->update('settings' , $data);
    }
    
    function clickatellSettings()
    {
        $data['description'] = strip_tags($this->input->post('clickatell_username'));
        $this->db->where('type' , 'clickatell_username');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('clickatell_password'));
        $this->db->where('type' , 'clickatell_password');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('clickatell_api'));
        $this->db->where('type' , 'clickatell_api');
        $this->db->update('settings' , $data);
    }
    
    function twilioSettings()
    {
        $data['description'] = strip_tags($this->input->post('twilio_account'));
        $this->db->where('type' , 'twilio_account');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('authentication_token'));
        $this->db->where('type' , 'authentication_token');
        $this->db->update('settings' , $data);

        $data['description'] = strip_tags($this->input->post('registered_phone'));
        $this->db->where('type' , 'registered_phone');
        $this->db->update('settings' , $data);
    }
    
    function services()
    {
        $data['description'] = $this->input->post('absences');
        $this->db->where('type' , 'absences');
        $this->db->update('settings' , $data);

        $data['description'] = $this->input->post('students_reports');
        $this->db->where('type' , 'students_reports');
        $this->db->update('settings' , $data);

        $data['description'] = $this->input->post('p_new_invoice');
        $this->db->where('type' , 'p_new_invoice');
        $this->db->update('settings' , $data);

        $data['description'] = $this->input->post('new_homework');
        $this->db->where('type' , 'new_homework');
        $this->db->update('settings' , $data);

        $data['description'] = $this->input->post('s_new_invoice');
        $this->db->where('type' , 's_new_invoice');
        $this->db->update('settings' , $data);
    }
    
    function emailTemplate($templateId)
    {
        $data['subject'] = $this->input->post('subject');
        $data['body']    = $this->input->post('body');
        $this->db->where('email_template_id', $templateId);
        $this->db->update('email_template', $data);
    }
    
    function createLang()
    {
        $language = $this->input->post('language');
        $this->load->dbforge();
        $fields = array(
            $language => array(
                'type' => 'LONGTEXT'
            )
        );
        $this->dbforge->add_column('language', $fields);
        move_uploaded_file($_FILES['file_name']['tmp_name'], 'style/flags/' . $this->input->post('language') . '.png');
    }
    
    function updateLang($lang)
    {
        $data[$lang] = $this->input->post('phrase');
        $this->db->where('phrase' , $this->input->post('phrase_key'));
        $this->db->update('language' , $data);
    }
    
    function createPoll()
    {
        $data['question'] = strip_tags($this->input->post('question'));
        foreach ($this->input->post('options') as $row)
        {
            $data['options'] .= $row . ',';
        }
        $data['user']          = $this->input->post('user');
        $data['status']        = 1;
        $data['date']          = $this->crud->getDateFormat();
        $data['date2']         = date('h:i A');
        $data['admin_id']      = $this->session->userdata('login_user_id');
        $data['type']          = "polls";
        $data['publish_date']  = date('Y-m-d H:i:s');
        $data['poll_code']     = substr(md5(rand(0, 1000000)), 0, 7);
        $this->crud->send_polls_notify();
        $this->db->insert('polls', $data);
    }
    
    function pollReponse()
    {
        $data['poll_code'] = $this->input->post('poll_code');
        $data['answer']    = $this->input->post('answer');
        $data['date2']     = date('h:i A');
        $user              = $this->session->userdata('login_user_id');
        $user_type         = $this->session->userdata('login_type');
        $data['user']      = $user_type ."-".$user;
        $data['date']      = $this->crud->getDateFormat();
        $this->db->insert('poll_response', $data);
    }
    
    function deletePoll($pollCode)
    {
        $this->db->where('poll_code', $pollCode);
        $this->db->delete('polls');
    }
}