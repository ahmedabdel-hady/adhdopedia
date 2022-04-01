<?php 
    $system_name = $this->crud->getInfo('system_name');
    $running_year = $this->crud->getInfo('running_year');
    $system_email = $this->crud->getInfo('system_email');
    $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        </head>
        <body style="margin:0px; background: #39a2d9; font-family: 'Rubik', sans-serif;">
            <div width="100%" style="background: #39a2d9; padding: 0px; line-height:28px; height:100%;  width: 100%; color: #606060; ">
                <div style="max-width: 700px; padding:0px;  margin: 2% auto; font-size: 14px; background: #fff; border-top: 5px solid #001b3d; border-radius: 4px;">
                    <div style="vertical-align: top; padding-bottom:50px;padding-top:50px;border-bottom: 1px solid rgba(0, 0, 0, 0.1);background: #001b3d;" align="center"><a href="#"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logow');?>" alt="<?php echo $system_name;?>" style="border:none;max-width:75%"></a></div>
                    <div style="padding: 40px; background: #fff; overflow-x:auto;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td><b><?php echo getEduAppGTLang('student');?>:</b> <?php echo $student_name;?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo getEduAppGTLang('student_marksheet_are_there');?>:</b></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="width:100%;border: 1px solid black;">
                                            <tr>
                                                <th style="border: 1px solid black;text-align: left;padding:10px;"><?php echo getEduAppGTLang('subject');?></th>
                                                <th style="border: 1px solid black;text-align: left;padding:10px;"><?php echo getEduAppGTLang('teacher');?></th>
                                                <th style="border: 1px solid black;text-align: left;padding:10px;"><?php echo getEduAppGTLang('mark');?></th>
                                                <th style="border: 1px solid black;text-align: left;padding:10px;"><?php echo getEduAppGTLang('comment');?></th>
                                            </tr>
                                            <?php 
                                                $subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                                                foreach ($subjects as $row3): 
                                                $obtained_mark_query = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id,'class_id' => $class_id, 'student_id' => $student_id, 'year' => $running_year));
                                                $marks = $obtained_mark_query->result_array();
                                                foreach ($marks as $row4):
                                            ?>
                                            <?php $mark = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?>
                                            <tr>
                                                <td style="border: 1px solid black;padding:10px;"><?php echo $row3['name'];?></td>
                                                <td style="border: 1px solid black;padding:10px;"><?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
                                                <td style="border: 1px solid black;padding:10px;"><?php $mark = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?>
                                                    <?php if($mark < $min || $mark == 0):?>
                                                        <b style="color:#e13c38"><?php if($this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal == 0) echo '0'; else echo $mark;?></b>
                                                    <?php endif;?>
                                                    <?php if($mark >= $min):?>
                                                        <b style="color:#99bf2d"><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?></b>
                                                    <?php endif;?>
                                                </td>
                                                <td style="border: 1px solid black;padding:10px;"><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->comment; ?></td>
                                            </tr>
                                            <?php endforeach; endforeach;?>
                                        </table>
                                        <br><br>
                                        <span style="font-size: 16px; font-weight:bold"><?php echo $system_name;?></span> 
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px; border-top: 1px solid rgba(0, 0, 0, 0.1); padding:5px;">
                        <p> <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="vertical-align: middle; height: 20px; width: auto;"> <?php echo $system_name;?><br>
                    </div>
                </div>
            </div>
        </body>
    </html>