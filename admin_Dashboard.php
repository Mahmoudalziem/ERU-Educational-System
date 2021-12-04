
<?php

    session_start();

    include'Assets/connect/connected.php';

    if (isset($_GET['id'])) {
        $id = convert_id('decrypt', $_GET['id']);

        $query_edit = 'select * from courses where course_id = "'.$id.'" ';

        $stmt_edit = $conn->prepare($query_edit);

        $stmt_edit->execute();

        $result_edit = $stmt_edit->fetchAll();

        foreach ($result_edit as $course_edit) {
        };
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Description -->
    <meta name="description" content="Engineering Site">
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!-- Editor Css -->
    <link rel="stylesheet" href="Assets/css/editor.css">
    <!-- Corp Image -->
    <link rel="stylesheet" href="Assets/css/croppie.css">
    <!-- Bootstrap TookenField -->
    <link rel="stylesheet" href="Assets/css/bootstrap-tokenfield.min.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="Assets/css/responsive.css">
</head>
    <body onload="<?php echo isset($_GET['id']) ? "loading_tages() , load_edit()": '';?>">

        <?php echo include 'Assets/connect/headerPortfolio.php'?>

        <div class="handaling_error"></div>

        <div class="Adding_course_sections">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-12">
                        <div class="add_course_links">
                            <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">
                                <a href="#course_info" aria-controls="course_info" class="active show" role="tab" data-toggle="tab">
                                    Course Landing Page
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#target_student" aria-controls="target_student" role="tab" data-toggle="tab">
                                    Target Your Student
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#upload_course_image" aria-controls="upload_course_image" role="tab" data-toggle="tab">
                                    Upload Course Image
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#curriculum" aria-controls="curriculum" role="tab" data-toggle="tab">
                                    Curriculum
                                </a>
                            </li>

                        </ul>
                            <?php
                                if (isset($_GET['id'])) {
                                    echo '<button type="button" role="button" class="button_edit_course" data-id="'.$id.'">Edit Course</button>';
                                } else {
                                    echo '<button type="button" role="button" class="button_submit_course">Submit Course</button>';
                                }
                            ?>

                        </div>
                    </div>

                    <div class="col-lg-9 col-12">
                        <div class="tab-content">

                            <div class="tab-pane fade active show" role="tabpanel" id="course_info">

                                <div class="col-12">

                                    <div class="title_adding_course">
                                        Course Landing Page
                                    </div>

                                    <div class="course_content">
                                        <form role="form" action="" method="POST" class="course_landing_page_form">

                                            <div class="error validate"></div>

                                            <div class="course_title">
                                                <label for="title" class="control-label">Course title *</label>
                                                <div class="form-control-counter-container">
                                                    <input <?php echo isset($_GET['id']) ? 'disabled readonly': '' ;?> placeholder="Insert your course title." onkeyup="limit(this)"  name="title" maxlength="60" id="title" class="form-control" value="<?php echo isset($_GET['id'])?  @$course_edit['course_title']: ''?>">
                                                    <div class="form_control_counter counter" data-purpose="form-control-counter">
                                                        60
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="course_headline">
                                                <label for="tages" class="control-label">Course Tages *</label>
                                                <div class="form-control-counter-container">
                                                    <?php
                                                        if (isset($_GET['id'])) {
                                                            echo '<input placeholder="Insert Tages Course" name="tages_course" id="tages" class="form-control" value="">';

                                                            $query_tages = 'select course_tages from courses where course_id = "'.$id.'" order by course_id';

                                                            $stmt_tages = $conn->prepare($query_tages);

                                                            $stmt_tages->execute();

                                                            $fetech_array_tages = explode(',', $course_edit['course_tages']);

                                                            $count_tages = count($fetech_array_tages);

                                                            echo '<script>function loading_tages(){$("input#tages").tokenfield("setTokens", [ "'.$fetech_array_tages[0].'" , "'.@$fetech_array_tages[1].'","'.@$fetech_array_tages[2].'","'.@$fetech_array_tages[3].'","'.@$fetech_array_tages[4].'","'.@$fetech_array_tages[5].'","'.@$fetech_array_tages[6].'","'.@$fetech_array_tages[7].'","'.@$fetech_array_tages[8].'" ,"'.@$fetech_array_tages[9].'","'.@$fetech_array_tages[10].'","'.@$fetech_array_tages[11].'","'.@$fetech_array_tages[11].'","'.@$fetech_array_tages[12].'","'.@$fetech_array_tages[13].'","'.@$fetech_array_tages[14].'","'.@$fetech_array_tages[15].'"])};</script>';
                                                        } else {
                                                            echo '<input placeholder="Insert Tages Course" name="tages_course" id="tages" class="form-control" value="">';
                                                        }
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="sub_info">
                                                <label for="sub_info" class="control-label"> Basic Info *</label>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select class="form-control language" name="language_course">
                                                                <option value="select_language" selected>-- Language --</option>
                                                                <option value="english"<?php if (isset($_GET['id'])) {
                                                        echo  $course_edit['language']== 'english' ? 'selected': '';
                                                    } ?> >English</option>
                                                                <option value="arabic" <?php if (isset($_GET['id'])) {
                                                        echo  $course_edit['language']== 'arabic' ? 'selected': '';
                                                    } ?> >Arabic</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <select class="form-control" name="depart_name">
                                                                <option value="-- Select Depart --">-- Select Depart --</option>
                                                                <?php
                                                                    $query = 'select * from department order by depart_id';

                                                                    $stmt = $conn->prepare($query);

                                                                    $stmt->execute();
                                                                    $result = $stmt->fetchAll();


                                                                    foreach ($result as $value) {
                                                                        if (isset($_GET['id'])) {
                                                                            if ($value['depart_id'] == $course_edit['depart_id']) {
                                                                                echo '<option value="'.$value['depart_id'].'" selected>'.$value['department_name'].'</option>';
                                                                            } else {
                                                                                echo '<option value="'.$value['depart_id'].'" >'.$value['department_name'].'</option>';
                                                                            }
                                                                        } else {
                                                                            echo '<option value="'.$value['depart_id'].'" >'.$value['department_name'].'</option>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <select class="form-control" name="semester_option">
                                                                <option value="-- Select Semester --">-- Select Semester --</option>
                                                                <?php
                                                                    if (isset($_GET['id'])) {
                                                                        $query_semester = 'select * from semester where depart_id = '.$course_edit['depart_id'].' ';

                                                                        $stmt_semester = $conn->prepare($query_semester);

                                                                        $stmt_semester->execute();

                                                                        $result_semester = $stmt_semester->fetchAll();

                                                                        foreach ($result_semester as $value) {
                                                                            if ($value['sem_id'] == $course_edit['sem_id']) {
                                                                                echo '<option value="'.$value['sem_id'].'" selected>'.$value['semester_name'].'</option>';
                                                                            } else {
                                                                                echo '<option value="'.$value['sem_id'].'" >'.$value['semester_name'].'</option>';
                                                                            }
                                                                        }
                                                                    }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><!-- End Column -->
                                            </div>

                                            <div class="form-group ">
                                                <label for="txtEditor" class="control-label">Description *</label>
                                                <textarea id="txtEditor" placeholder="Your Message"></textarea>

                                                <?php


                                                    if (isset($_GET['id'])) {
                                                        echo '<script>function load_edit(){$("#txtEditor").Editor("setText","'.$course_edit['description'].'")}</script>';
                                                    }
                                                ?>
                                            </div>

                                        </form>
                                    </div><!-- End personal Settings -->
                                </div><!-- End Column -->
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="target_student">
                                <div class="col-12">

                                    <div class="title_adding_course">
                                        Target Your Student
                                    </div>

                                    <div class="course_content">
                                        <form  action="" role="form" id="" method="POST" name="target_student">

                                            <div class="goal_form_course_content_learn goal_form_course_content display_none">

                                                <div class="input-group">
                                                    <input type="text" placeholder="Example: Software Course" class="form-control" name="input_learn">

                                                    <div class="option_edit">
                                                        <span class="input-group-btn">
                                                            <button for="button_delete_input" type="button">
                                                                <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="goal_form_course_content_require goal_form_course_content display_none">
                                                <div class="input-group">
                                                    <input type="text" placeholder="Example: Be Able To Do" class="form-control" name="input_require">

                                                    <div class="option_edit">
                                                        <span class="input-group-btn">
                                                            <button for="button_delete_input" type="button">
                                                                <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="course_goal learn_section">
                                                <label for="course_goal_content" class="control-label">
                                                    What will students learn in your course ?
                                                </label>

                                                <?php
                                                    if (isset($_GET['id'])) {
                                                        $query_tabs = 'select * from courses where course_id = "'.$id.'" order by course_id';

                                                        $stmt_tabs = $conn->prepare($query_tabs);

                                                        $stmt_tabs->execute();

                                                        $result_tabs = $stmt_tabs->fetchAll();

                                                        foreach ($result_tabs as $value) {
                                                            $array1 = explode(',', $value['learn_tabs']);

                                                            for ($x = 0; $x < count($array1); $x++) {
                                                                echo '
                                                                <div class="goal_form_course_content_learn goal_form_course_content learn_tabs">
                                                                    <div class="input-group">
                                                                        <input type="text" placeholder="Example: Software Course" class="form-control" name="input_learn" value="'.$array1[$x].'">
                                                                        <div class="option_edit">
                
                                                                            <span class="input-group-btn">
                                                                                <button for="button_delete_input" type="button">
                                                                                    <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                                                </button>
                                                                            </span>
                
                                                                        </div>
                
                                                                    </div>
                                                                </div>
                                                                ';
                                                            }
                                                        }
                                                    } else {
                                                        echo '<div class="goal_form_course_content_learn goal_form_course_content learn_tabs">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Example: Software Course" class="form-control" name="input_learn">
                                                        <div class="option_edit">

                                                            <span class="input-group-btn">
                                                                <button for="button_delete_input" type="button">
                                                                    <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                                </button>
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>';
                                                    }
                                                ?>

                                                <button  type="button" class="btn btn-tertiary learn_section_button">
                                                    <span class="fa fa-plus"></span>
                                                    Add Point
                                                </button>

                                            </div><!-- learn_Section -->

                                            <div class="course_goal require_section">

                                                <label for="requirements" class="control-label">Are there any course requirements ?</label>

                                                <?php
                                                if (isset($_GET['id'])) {
                                                    $query_tabs = 'select * from courses where course_id = "'.$id.'" order by course_id';

                                                    $stmt_tabs = $conn->prepare($query_tabs);

                                                    $stmt_tabs->execute();

                                                    $result_tabs = $stmt_tabs->fetchAll();

                                                    foreach ($result_tabs as $value) {
                                                        $array1 = explode(',', $value['require_tabs']);

                                                        for ($x = 0; $x < count($array1); $x++) {
                                                            echo '
                                                                <div class="goal_form_course_content_require goal_form_course_content require_tabs">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Example: Be Able To Do" class="form-control" name="input_require" value="'.$array1[$x].'">

                                                        <div class="option_edit">

                                                            <span class="input-group-btn">
                                                                <button for="button_delete_input" type="button">
                                                                    <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                                </button>
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>
                                                                ';
                                                        }
                                                    }
                                                } else {
                                                    echo '<div class="goal_form_course_content_require goal_form_course_content require_tabs">
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Example: Be Able To Do" class="form-control" name="input_require">

                                                        <div class="option_edit">

                                                            <span class="input-group-btn">
                                                                <button for="button_delete_input" type="button">
                                                                    <span id="button_delete_input"><i class="fa fa-trash-o"></i></span>
                                                                </button>
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>';
                                                }
                                                ?>


                                                <button type="button" class="btn btn-tertiary require_section_button">
                                                    <span class="fa fa-plus"></span>
                                                    Add Point
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div><!-- End Column -->
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="upload_course_image">


                                <div class="col-12">
                                    <div class="change-images">
                                        <form action="" method="post" name="course_crop_image" id="course_image" role="form">

                                            <div class="error validate"></div>
                                            <div class="profile-photo-form">
                                                <div class="title_adding_course">
                                                    Image preview
                                                </div>
                                                <span>Minimum 250X200 pixels, Maximum 800X800 pixels</span>
                                            </div>

                                            <div class="image-upload">
                                                <div class="image-preview">
                                                    <div class="file-upload">
                                                        <?php
                                                            if (isset($_GET['id'])) {
                                                                echo '<img src="courses_content/course_images/'.$course_edit['course_title'].'/'.$course_edit['course_image'].' ">';
                                                            } else {
                                                                echo '<img src="Assets/images/profiles/default_course/default_course.png" alt="Course-image">';
                                                            }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="loading-image">
                                                <input class="custom-file-input d-none" id="load_image_course" type="file" accept=".gif,.jpg,.jpeg,.png">
                                                <label class="d-flex" for="load_image_course">
                                                    <div class="upload_content">
                                                        <input readonly="" type="text" value="No file selected" class="input_readonly_course">
                                                        <div class="upload_loading"></div>
                                                    </div>
                                                    <span class="btn">Upload image</span>
                                                </label>
                                            </div>

                                            <div class="modal fade ml-0 pl-0" id="course_corp_image" aria-hidden="true">
                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h3>Corp Image</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="error validate"></div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 text-center">
                                                                    <div id="course_crop_image" class="align-items-center" style="margin-top:30px;height:auto"></div>
                                                                    <button class="btn crop_image crop_image_course">Crop &amp; insert Image</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="curriculum">

                                <div class="col-12 text-center">

                                    <div class="title_adding_course text-left">
                                        Video && Files
                                    </div>

                                    <div class="error validate"></div>

                                    <?php


                                        if (isset($_GET['id'])) {
                                            $query_section = 'select * from sections where course_id = ?';

                                            $stmt_section = $conn->prepare($query_section);

                                            $execute_section = array($id);

                                            $stmt_section->execute($execute_section);

                                            $result_section = $stmt_section->fetchAll();

                                            $result_count = $stmt_section->rowCount();

                                            function fetch_file_video($conn, $id, $section_name, $m)
                                            {
                                                $query_fetch = 'select * from videos_files where course_id = "'.$id.'" and section_name =  "'.$section_name.'" order by video_file_id';

                                                $stmt_fetch = $conn->prepare($query_fetch);

                                                $stmt_fetch->execute();

                                                $rowCount_fetch = $stmt_fetch->rowCount();

                                                $result_fetch = $stmt_fetch->fetchAll();

                                                $output = '';

                                                if ($rowCount_fetch > 0) {
                                                    foreach ($result_fetch as $value) {
                                                        if ($value['video_file_type'] == 'file') {
                                                            $output .=  '<tr id="row_'.$value['video_file_id'].'" class="file_tr" data-id="'.$value['video_file_id'].'">
                                                                            <td data-reponsive-text="filename" id="file_title_'.$value['video_file_id'].'" class="file_title">'.$value['video_file_name'].'</td>
                                                                            <input type="hidden" value="'.$value['video_file_content'].'" id="file_content_'.$value['video_file_id'].'" name="content_file_input" class="video_file video_file_section_'.$m.'" data-section="'.$value['section_name'].'">
                                                                            <td data-reponsive-text="type">'.$value['video_file_type'].'</td>
                                                                            <td data-reponsive-text="date" id="data_file_'.$value['video_file_id'].'" class="date_file">'.$value['video_file_date'].'</td>
                                                                            <td data-reponsive-text="edit">
                                                                                <div class="d-flex edit_content_table">
                                                                                   <div class="edit_file" id="'.$value['video_file_id'].'">
                                                                                      <span>
                                                                                          <i class="fa fa-pencil"></i>
                                                                                      </span>
                                                                                   </div>
                                                                                   <div class="delete_field">
                                                                                     <span>
                                                                                         <i class="fa fa-trash-o"></i>
                                                                                     </span>
                                                                                   </div>
                                                                                </div>
                                                                                </td>
                                                                             </tr>';
                                                        }
                                                        if ($value['video_file_type'] == 'video') {
                                                            $video_url_id = explode('embed/', $value['video_file_content']);

                                                            $video_url_id = 'https://www.youtube.com/watch?v=' . $video_url_id[1];

                                                            $output .= '<tr id="row_'.$value['video_file_id'].'" class="video_tr" data-id="'.$value['video_file_id'].'">
                                                                        <td data-reponsive-text="filename" id="video_title_'.$value['video_file_id'].'" class="video_title">'.$value['video_file_name'].'</td>
                                                                        <input type="hidden" value="'.$video_url_id.'" name="content_video_input" class="video_file video_file_section_'.$m.'" id="video_url_'.$value['video_file_id'].'" data-section="'.$value['section_name'].'"> 
                                                                        <td data-reponsive-text="type">'.$value['video_file_type'].'</td>
                                                                        <td data-reponsive-text="date" id="date_video_'.$value['video_file_id'].'" class="date_video">'.$value['video_file_date'].'</td>
                                                                        <td data-reponsive-text="edit">
                                                                        <div class="d-flex edit_content_table">
                                                                           <div class="edit_video" id="'.$value['video_file_id'].'">
                                                                              <span>
                                                                                  <i class="fa fa-pencil"></i>
                                                                              </span>
                                                                           </div>
                                                                           <div class="delete_field">
                                                                             <span>
                                                                                 <i class="fa fa-trash-o"></i>
                                                                             </span>
                                                                           </div>
                                                                        </div>
                                                                        </td>
                                                                    </tr>';
                                                        }
                                                    }
                                                }

                                                return $output;
                                            }

                                            if ($result_count > 0) {
                                                foreach ($result_section as $value_section) {
                                                    echo '<div class="section_content" data-number="'.$value_section['section_id'].'" data-section_name="'.$value_section['section_name'].'">
                    
                                                            <div class="section_content_header">
                    
                                                                <div class="section_name">
                                                                <span class="section_name_default">Section : </span>
                                                                <span class="section_name_content">
                                                                    <span><i class="fa fa-file-text-o"></i></span>
                                                                    <span id="'.$value_section['section_id'].'" class="section_span section_edit_'.$value_section['section_id'].'">'.$value_section['section_name'].'</span>
                                                                </span>
                                                            </div>
                    
                                                                <div class="section_edit d-inline-flex">
                                                                <div class="edit_section" id="'.$value_section['section_id'].'">
                                                                    <span>
                                                                        <i class="fa fa-pencil"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="delete_section">
                                                                    <span>
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                    
                                                            <div class="content_video_article">
                                                                <div class="row">
                                                                    <table  class="table w-100 table_content table table-bordered table-sm table_content_video_file" style="border-collapse: separate; margin-top:30px; border:0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                               <th role="columnheader" scope="col">Filename</th>
                                                                               <th role="columnheader" scope="col">Type</th>
                                                                               <th role="columnheader" scope="col">Date</th>
                                                                               <th role="columnheader" scope="col"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            '.fetch_file_video($conn, $id, $value_section['section_name'], $value_section['section_id']).'
                                                                        </tbody>
                                                                    </table>
                    
                                                                    <div class="add_video_article mx-auto">
                                                                        <button class="btn add_video_course" type="button" data-toggle="modal" data-target="#add_video_modal" role="button">Add Video</button>
                                                                        <button class="btn add_file_course" type="button" data-toggle="modal" data-target="#add_article_modal" role="button">Add File</button>
                                                                    </div>
                                                                </div><!-- End Row -->
                                                            </div>
                    
                                                        </div>';
                                                }
                                            } else {
                                                echo '<div class="section_content" data-number="1" data-section_name="Intro">
                    
                                                            <div class="section_content_header">
                    
                                                                <div class="section_name">
                                                                <span class="section_name_default">Section : </span>
                                                                <span class="section_name_content">
                                                                    <span><i class="fa fa-file-text-o"></i></span>
                                                                    <span id="1" class="section_span section_edit_1">Intro</span>
                                                                </span>
                                                            </div>
                    
                                                                <div class="section_edit d-inline-flex">
                                                                <div class="edit_section" id="1">
                                                                    <span>
                                                                        <i class="fa fa-pencil"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="delete_section">
                                                                    <span>
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                    
                                                            <div class="content_video_article">
                                                                <div class="row">
                                                                    <table  class="table w-100 table_content table table-bordered table-sm table_content_video_file" style="border-collapse: separate; margin-top:30px; border:0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                               <th role="columnheader" scope="col">Filename</th>
                                                                               <th role="columnheader" scope="col">Type</th>
                                                                               <th role="columnheader" scope="col">Date</th>
                                                                               <th role="columnheader" scope="col"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                    
                                                                    <div class="add_video_article mx-auto">
                                                                        <button class="btn add_video_course" type="button" data-toggle="modal" data-target="#add_video_modal" role="button">Add Video</button>
                                                                        <button class="btn add_file_course" type="button" data-toggle="modal" data-target="#add_article_modal" role="button">Add File</button>
                                                                    </div>
                                                                </div><!-- End Row -->
                                                            </div>
                    
                                                        </div>';
                                            }
                                        } else {
                                            echo '<div class="section_content" data-number="1">
                    
                                                            <div class="section_content_header">
                    
                                                                <div class="section_name">
                                                                <span class="section_name_default">Section : </span>
                                                                <span class="section_name_content">
                                                                    <span><i class="fa fa-file-text-o"></i></span>
                                                                    <span id="1" class="section_span section_edit_1">Intro</span>
                                                                </span>
                                                            </div>
                    
                                                                <div class="section_edit d-inline-flex">
                                                                <div class="edit_section" id="1">
                                                                    <span>
                                                                        <i class="fa fa-pencil"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="delete_section">
                                                                    <span>
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                    
                                                            <div class="content_video_article">
                                                                <div class="row">
                                                                    <table  class="table w-100 table_content table table-bordered table-sm table_content_video_file" style="border-collapse: separate; margin-top:30px; border:0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                               <th role="columnheader" scope="col">Filename</th>
                                                                               <th role="columnheader" scope="col">Type</th>
                                                                               <th role="columnheader" scope="col">Date</th>
                                                                               <th role="columnheader" scope="col"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                    
                                                                    <div class="add_video_article mx-auto">
                                                                        <button class="btn add_video_course" type="button" data-toggle="modal" data-target="#add_video_modal" role="button">Add Video</button>
                                                                        <button class="btn add_file_course" type="button" data-toggle="modal" data-target="#add_article_modal" role="button">Add File</button>
                                                                    </div>
                                                                </div><!-- End Row -->
                                                            </div>
                    
                                                        </div>';
                                        }

                                    ?>

                                    <button class="btn mx-auto add_section" id="add_section" data-toggle="modal" data-target="#add_section_form" role="button" type="button">Add Section</button>

                                    <div class="modal fade" id="add_section_form" role="dialog" tabindex="-1" aria-labelledby="add_section_form">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3>ADD Section</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="add_section_form">

                                                    <form  method="post" action="" class="add_section_form">

                                                        <div class="error validate"></div>
                                                        <div class="form-group row">
                                                            <label class="col-12 col-form-label">Section Name </label>
                                                            <div class="col-12">

                                                                <div class="form-control-counter-container">
                                                                    <input placeholder="Insert your Section Title." onkeyup="limit(this)" name="section_name" maxlength="60" id="title" class="form-control" value="">
                                                                    <div class="form_control_counter counter" data-purpose="form-control-counter">
                                                                        60
                                                                    </div>
                                                                </div>

                                                            </div><!-- End Column -->
                                                        </div><!-- End Row -->

                                                        <div class="add_or_cancel">
                                                            <button class="cancel btn" role="button" type="button" data-dismiss="modal">Cancel</button>
                                                            <input class="submit" type="submit" name="add_section" value="Add && Save">
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="add_video_modal" role="dialog" tabindex="-1" aria-labelledby="add_video_modal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3>Add Video</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="add" method="POST" action="" class="add_video">

                                                        <div class="error"></div>
                                                        <div class="form-group">
                                                            <label class="label_video">Video title *</label>
                                                            <div class="video_title_input">
                                                                <input type="text" placeholder="Video Title" name="video_title">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="label_video">Video Url *</label>
                                                            <div class="video_url_input">
                                                                <input type="text" placeholder="https://www.example.com" name="video_url">
                                                            </div>
                                                        </div>

                                                        <div style="text-align: center">
                                                            <input type="submit" name="add_video_course" value="Add Video">
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="add_article_modal" role="dialog" tabindex="-1" aria-labelledby="add_article_modal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3>Add File</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="add" method="POST" action="" class="add_file_form" enctype="multipart/form-data">

                                                        <div class="error"></div>
                                                        <div class="form-group">
                                                            <label>File Name *</label>
                                                            <div class="file_name_input">
                                                                <input type="text" placeholder="File Name" name="fileName" class="file_name" autofocus="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label> file Content *</label>
                                                            <div class="upload_file">
                                                                <input class="custom-file-input d-none" id="upload_file_input" name="files" type="file" accept=".pdf,.doc,.docx,.m">
                                                                <label class="d-flex" for="upload_file_input">
                                                                    <div class="upload_content">
                                                                        <input readonly="" value="No file selected" class="input_readonly_file">
                                                                        <div class="upload_loading"></div>
                                                                    </div>
                                                                    <span class="btn">Upload File</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div style="text-align: center">
                                                            <input type="submit" name="add_file_form" value="Add File" class="add_file_submit">
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div><!-- End Column -->

                            </div>

                        </div><!-- End tab Content -->
                    </div><!-- End Column -->

                </div><!-- End Row -->
            </div><!-- End Container -->
        </div>
        
<!-- ========== Footer Section ============-->
<div class="footer-section">
        <span>All right Reserved <?php echo date('Y')?> @ Ask The Proff </span>
        <span>Desgined With Love By @ <a href="https://www.facebook.com/Alziem2" target="_blank" title="Developper Page 
        Facebook">Eng/AZIMA</a></span>
    </div>
<!--========== End Footer Section ==========-->

<!--============== Loader Start ==============-->
    <div class="preloader">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>
    </div>
<!--============== Loader End ==============-->
        <!-- Jquery ==== -->
        <script src="Assets/Js/jquery-3.3.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- propper -->
        <script src="Assets/Js/popper.js"></script>
        <script src="Assets/Js/tooltip.js"></script>
        <!-- Bootstrap -->
        <script src="Assets/Js/bootstrap.min.js"></script>
        <!-- Editor -->
        <script src="Assets/Js/editor.js"></script>
        <!-- NiceScroll -->
        <script src="Assets/Js/jquery.nicescroll.js"></script>
        <!-- tooken faield -->
        <script src="Assets/Js/bootstrap-tokenfield.min.js"></script>
        <!-- Contact Send -->
        <script src="Assets/Js/contact_send.js"></script>
        <!-- Plugins -->
        <script src="Assets/Js/plugin.js"></script>
        <!-- corp image -->
        <script src="Assets/Js/croppie.min.js"></script>
        <script type="text/javascript">

            nicescroll();
            textEditor();
            function limit(limit) {

                let max_title = 60;

                len = $(limit).val().length;

                if (len >= max_title) {

                    if($(limit).attr('maxlength') == 60){

                        $('.form_control_counter').text(0);
                    }

                } else {

                    let char_title = max_title - len;

                    if($(limit).attr('maxlength') == 60){

                        $('.form_control_counter').text(char_title);
                    }
                }
            }

            limit($('input[name="title"]'));

            $('#menuBarDiv_txtEditor .btn-group:nth-child(1)').remove();
            $('#menuBarDiv_txtEditor .btn-group:nth-child(5)').remove();
            $('#menuBarDiv_txtEditor .btn-group:nth-child(3)').remove();

            let course_corp_image = $('#course_crop_image').croppie({

                enableExif: true,
                viewport:{
                    width:250,
                    height:200,
                    type:'square',
                },
                boundary:{
                    height:250,
                }
            });

            $('select[name="depart_name"]').change(function () {

                var id = $(this).val(),

                    action = 'fetch_semester';

                if(id === '-- Select Depart --'){

                    $('select[name="semester_option"]').html('<option value="-- Select Semester --">-- Select Semester --</option>');
                }
                else{
                    $.ajax({
                        url:'Assets/connect/fetch_semester.php',
                        method:'POST',
                        data:{action:action,id:id},
                        success:function (data) {
                            $('select[name="semester_option"]').html(data);
                        }
                    });
                }

            });
            $('input#tages').tokenfield();


        </script>
    </body>

</html>