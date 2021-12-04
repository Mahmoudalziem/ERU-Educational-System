<?php
    
  function header_no_login()
  {
      return '
<!--suppress HtmlUnknownTarget -->
            <header class="navbar-header">
        <div class="container d-flex">

            <div class="menu-left">

                    <i class="fa fa-bars menu-left-dropdown"></i>

                    <div class="col-lg-4 col-12 column">
                        <div class="menu-left-content">
                            <ul>
                                <li>
                                    <a href="index.php" target="_self">
                                        <i class="fa fa-asterisk"></i>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="Courses.php" target="_self">
                                        <i class="fa fa-asterisk"></i>
                                        All Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="aboutUs.php" target="_self">
                                        <i class="fa fa-asterisk"></i>
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="contactUs.php" target="_self">
                                        <i class="fa fa-asterisk"></i>
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Column -->
            </div><!-- End Menu Left -->

            <div class="site-logo mx-auto mr-auto">
                <a href="index.php">
                    <img src="Assets/images/logo/favicon.ico" alt="Site Logo">
                    <span>Ask The Proff</span>
                </a>
            </div>


            <div class="menu-right d-flex">

                <div class="search-content d-lg-block d-none">
                    <i class="fa fa-search search-button"></i>
                    <div class="col-12">
                        <form name="form_search" method="POST">
                            <input type="search" placeholder="Search ..." name="search_input" class="search_input" id="search_input">
                            <input type="button" value="Search" name="submit_search">
                        </form>
                    </div>

                    <div class="content_search col-12">
                        <ul class="courses_search_content"></ul>
                    </div>
                </div>

                <div class="site-enter">
                    <div class="site-enter-button d-lg-none d-block">
                        <i class="fa fa-bars"></i>
                        <div class="position-absolute column">
                            <div class="col-12">
                            <div class="content-show d-flex">

                                <a href="signIn.php" class="float-left">
                                    <i class="fa fa-user"></i>
                                    <span>Login</span>
                                </a>

                                <div class="search_content_phone mr-auto mx-auto">
                                    <i class="fa fa-search search"></i>
                                    <div class="col-12 form-search" style="margin-top:8px;">
                                        <form name="form_search" method="POST">
                                            <input type="search" placeholder="Search ..." name="search_input" class="search_input" id="search_input_phone">
                                            <input type="button" value="Search" name="submit_search">
                                        </form>
                                    </div>

                                    <div class="content_search col-12">
                                        <ul class="courses_search_content"></ul>
                                    </div>
                                </div>

                                <a href="signUp.php" class="float-right">
                                    <i class="fa fa-lock"></i>
                                    <span>Sign Up</span>
                                </a>

                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="logo-site d-lg-block d-none">
                        <a href="signIn.php" target="_self">
                            <i class="fa fa-user"></i>
                            <span>Login</span>
                        </a>
                        <span>/</span>
                        <a href="signUp.php" target="_self">
                            <i class="fa fa-lock"></i>
                            <span>Sign Up</span>
                        </a>
                    </div>

                </div>
            </div>
            
        </div><!-- End Container -->
    </header>
      ';
  };

if (isset($_SESSION['username'])) {
    $query_portfolio = 'select * from profile p join users u using(username) where username = "' . $_SESSION['username'] . '" and (actived = 1 and status = ("user" or "moderator") ) or (actived = 2 and status = "admin") ';

    $stmt_portfolio = $conn->prepare($query_portfolio);

    $stmt_portfolio->execute();

    $result_portfolio = $stmt_portfolio->fetchAll();

    foreach ($result_portfolio as $value_portfolio) {
        $GLOBALS['name'] = ucwords($value_portfolio['name']);

        $GLOBALS['email'] = $value_portfolio['email'];

        $GLOBALS['avater_image'] = $value_portfolio['avater_image'];

        $GLOBALS['depart_id'] = $value_portfolio['depart_id'];
    };

    $GLOBALS['function'] = function () {
        return $GLOBALS['avater_image'] != '' ? 'images_users\avaters\\'. $_SESSION['username']. '\\' . $GLOBALS['avater_image'] : 'Assets/images/profiles/default_avater/default_avater.png';
    };

    function showMod($conn)
    {
        $query = 'select status from users where username = ?';

        $stmt = $conn->prepare($query);

        $source = array($_SESSION['username']);

        $stmt->execute($source);

        $fetch = $stmt->fetch();

        $status = $fetch['status'];

        if ($status == 'user') {
            return '<li>
                        <a href="Question.php" target="_self">
                            <i class="fa fa-asterisk"></i>
                            Ask Question
                        </a>
                    </li>';
        } elseif ($status == 'moderator') {
            return '<li>
                        <a href="Question.php" target="_self">
                            <i class="fa fa-asterisk"></i>
                            View Questions
                        </a>
                    </li>

                    <li>
                        <a href="review_questions.php" target="_self">
                            <i class="fa fa-asterisk"></i>
                            Accept Questions
                        </a>
                    </li>
                    ';
        }
    }
}

          function fetch_depart_sem($x)
          {
              $output = '';

              if ($x == 0) {
                  $output .=  '<div class="fetch_notification">
                        <div class="error"></div>
                        <div class="col-12">
                                <select class="form-control" name="depart_name_notify">
                                    <option value="-- Select Depart --" selected="">-- Select Depart --</option>
                                    <option value="1">Preporatory</option>
                                    <option value="2">Telecomunication</option>
                                    <option value="3">Mechatronics</option>
                                    <option value="4">Construction</option>                                                            
                                </select>
                            </div>

                            <div class="col-12">
                                <select class="form-control" name="semester_name_alter">
                                    <option value="-- Select Semester --">-- Select Semester --</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="button" role="button" class="submit_notify" data-id="1">Submit Notify</button>
                            </div>
                    </div>';
              } else {
                  $output .= '<div class="fetch_notification active">
                            <div class="error"></div>
                            <div class="col-12">
                                    <select class="form-control" name="depart_name_notify">
                                        <option value="-- Select Depart --" selected="">-- Select Depart --</option>
                                        <option value="1">Preporatory</option>
                                        <option value="2">Telecomunication</option>
                                        <option value="3">Mechatronics</option>
                                        <option value="4">Construction</option>                                                            
                                    </select>
                                </div>

                                <div class="col-12">
                                    <select class="form-control" name="semester_name_alter">
                                        <option value="-- Select Semester --">-- Select Semester --</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button type="button" role="button" class="submit_notify" data-id="1">Submit Notify</button>
                                </div>
                            </div>';
              }

              return $output;
          }

  function header_login($conn)
  {
      echo '  
   
      <!--suppress HtmlUnknownTarget -->
    <header class="navbar-header">
    <div class="container d-flex">

        <div class="menu-left">

            <i class="fa fa-bars menu-left-dropdown"></i>

            <div class="col-lg-4 col-12 column">
                <div class="menu-left-content">
                    <ul>
                        <li>
                            <a href="index.php" target="_self">
                                <i class="fa fa-asterisk"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="Courses.php" target="_self">
                                <i class="fa fa-asterisk"></i>
                                All Courses
                            </a>
                        </li>
                        '.showMod($conn).'
                        <li>
                            <a href="aboutUs.php" target="_self">
                                <i class="fa fa-asterisk"></i>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="contactUs.php" target="_self">
                                <i class="fa fa-asterisk"></i>
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- End Column -->
        </div><!-- End Menu Left -->

        <div class="site-logo mx-auto mr-auto">
            <a href="index.php">
                <img src="Assets/images/logo/favicon.ico" alt="Site Logo">
                <span>Ask The Proff</span>
            </a>
        </div>


        <div class="menu-right d-flex menu-right1">

            <div class="notification-site d-lg-block d-none">
                <a href="javascript:void(0)" class="notification-display">
                    <i class="fa fa-bell"></i>
                    <span class="notify">
                        <span class="blink"></span>
                        <span class="dot"></span>
                    </span>
                </a>
                <div class="col-lg-3 col-lg-4 position-absolute column notification-display1">
                    <div class="notification-site-content">

                        <ul>
                            <li class="dropdown-header">
                                Notification
                              <a href="javascript:void(0)" target="_self" class="clear_notify" title="Clear All">
                                    <span> Clear all</span>
                                </a>
                                <a href="javascript:void(0)" class="edit_notfication" title="Edit Notification">
                                    <span> Edit Notify</span>
                                </a>
                            </li>

                            <li class="dropdown-body">
                                <ul class="scrollbar notify_view">
                                    <!-- computer -->
                                </ul>
                            </li><!-- End Dropdown-Body -->

                            '.fetch_depart_sem($GLOBALS['depart_id']).'

                        </ul>

                    </div><!-- End Content -->
                </div><!-- End Column -->
            </div>

            <div class="search-content d-lg-block d-none">
                <i class="fa fa-search search-button"></i>
                <div class="col-12">
                    <form name="form_search" method="POST">
                        <input type="search" placeholder="Search ..." name="search_input" class="search_input" id="search_input">
                        <input type="button" value="Search" name="submit_search">
                    </form>
                </div>

                <div class="content_search col-12">
                    <ul class="courses_search_content"></ul>
                </div>
            </div>



            <div class="notification-site d-lg-block d-none">
            
                <a href="javascript:void(0)" class="avater-display">
                    <img src="'.$GLOBALS['function']().'" alt="Avater Image">
                </a>
                <div class="col-4 position-absolute column avater-site">
                
                    <div class="notification-site-content">

                        <ul>
                        
                            <li class="dropdown-header portfolio_content d-flex">
                                <div class="avater-info">
                                
                                    <span class="avater-name d-block">'.$GLOBALS['name'].'</span>

                                    <span class="avater-email">'.$GLOBALS['email'].'</span>
                                    
                                </di'.'v>
                                
                                <a href="javascript:void(0)" target="_self" data-toggle="tooltip" data-placement="top" title="LogOut" class="logoOut" id="logoOut">
                                    <i class="fa fa-power-off"></i>
                                </a>
                                
                            </li>

                            <li class="dropdown-body portfolio_content">

                                <ul class="scrollbar">

                                    <li>
                                        <a href="portfolio.php?UN='.$_SESSION['username'].'">
                                            <div class="notification d-flex">
                                                <i class="notify-icon fa fa-user"></i>
                                                <div class="notify-message">
                                                    <p>Portfolio</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="settings.php?UN='.$_SESSION['username'].'">
                                            <div class="notification d-flex">
                                                <i class="notify-icon fa fa-cog"></i>
                                                <div class="notify-message">
                                                    <p>Settings</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </li><!-- End Dropdown-Body -->

                        </ul>

                    </div><!-- End Content -->
                </div><!-- End Column -->
            </div>




            <div class="site-enter site-enter1">

                <div class="site-enter-button d-lg-none d-block site-notification">
                    <i class="fa fa-bars"></i>
                    <div class="position-absolute column">
                        <div class="col-12">
                            <div class="content-show d-flex">

                                <a href="javascript:void(0)" class="float-left notification-display">
                                    <i class="fa fa-bell site-notification1"></i>
                                    <span class="notify">
                                        <span class="blink"></span>
                                        <span class="dot"></span>
                                    </span>
                                    </a>
                                    <div class="col-12 position-absolute column1 p-0">
                                        <div class="notification-site-content">
                                            <ul>
                                                <li class="dropdown-header">
                                                    Notification
                                                    <a href="javascript:void(0)" target="_self" class="clear_notify" title="Clear All">
                                                        <span> Clear all</span>
                                                    </a>

                                                    <a href="javascript:void(0)" class="edit_notfication" title="Edit Notification">
                                                        <span> Edit Notify</span>
                                                    </a>
                                                </li>

                                                <li class="dropdown-body">
                                                    <ul class="scrollbar notify_view">
                                                        <!-- Mobile -->
                                                    </ul>
                                                </li><!-- End Dropdown-Body -->
                                            </ul>

                                            '.fetch_depart_sem($GLOBALS['depart_id']).'
                                            
                                        </div><!-- End Content -->
                                    </div>
                                </a>

                                <div class="search_content_phone mr-auto mx-auto">
                                    <i class="fa fa-search search"></i>
                                    <div class="col-12 form-search">
                                        <form name="form_search" method="POST">
                                            <input type="search" placeholder="Search ..." name="search_input" class="search_input" id="search_input_phone">
                                            <input type="button" value="Search" name="submit_search">
                                        </form>
                                    </div>

                                    <div class="content_search col-12">
                                        <ul class="courses_search_content"></ul>                                        
                                    </div>
                                </div>

                                <a href="javascript:void(0)" class="avater-display avater-display1 float-right">
                                
                                        <img src= "'.$GLOBALS['function']().'" alt="Avater Image">
                                    </a>

                                    <div class="col-12 position-absolute column2 p-0">
                                        <div class="notification-site-content">

                                            <ul>
                                                <li class="dropdown-header portfolio_content d-flex">

                                                    <div class="avater-info">
                                                        <span class="avater-name d-block">'.$GLOBALS['name'].'</span>
                                                        <span class="avater-email">'.$GLOBALS['email'].'</span>
                                                    </div>

                                                    <a href="javascript:void(0)" target="_self" data-toggle="tooltip" data-placement="top" title="LogOut" class="logoOut" id="logoOut">
                                                        <i class="fa fa-power-off"></i>
                                                    </a>
                                                </li>

                                                <li class="dropdown-body portfolio_content">
                                                    <ul class="scrollbar">

                                                        <li>
                                                            <a href="portfolio.php?UN='.$_SESSION['username'].'">
                                                                <div class="notification d-flex">
                                                                    <i class="notify-icon fa fa-user"></i>
                                                                    <div class="notify-message">
                                                                        <p>Portfolio</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="settings.php?UN='.$_SESSION['username'].'">
                                                                <div class="notification d-flex">
                                                                    <i class="notify-icon fa fa-cog"></i>
                                                                    <div class="notify-message">
                                                                        <p>Settings</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </li><!-- End Dropdown-Body -->

                                            </ul>

                                        </div><!-- End Content -->
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div><!-- End Container -->
</header>

<!--============= Header End =============-->

      ';
  };

  function header_admin()
  {
      return '<header class="navbar-header">
        <div class="container d-flex">

            <div class="menu-left">
                <i class="fa fa-bars menu-left-dropdown"></i>
                <div class="col-lg-4 col-12 column">
                    <div class="menu-left-content">
                        <ul>

                            <li>
                                <a href="admin_Dashboard.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    Add Course
                                </a>
                            </li>

                            <li>
                                <a href="Edit_courses.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    Edit Courses
                                </a>
                            </li>

                            <li>
                                <a href="all_user.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    View Users
                                </a>
                            </li>

                            <li class="change_password_admin">
                                <a href="passAdmin.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    Change Password
                                </a>
                            </li>

                            <li class="change_password_admin">
                                <a href="review_questions.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    Accept Questions
                                </a>
                            </li>

                            <li class="change_password_admin">
                                <a href="Question.php" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    View Questions
                                </a>
                            </li>

                            <li class="logo_out_admin">
                                <a href="javascript:void(0)" target="_self">
                                    <i class="fa fa-asterisk"></i>
                                    LogOut
                                </a>
                            </li>

                        </ul>
                    </div>
                </div><!-- End Column -->
            </div><!-- End Menu Left -->

            <div class="site-logo mx-auto mr-auto"></div>

            <div class="menu-right d-flex">
                <div class="logo image" dir="rtl">
                    <img src="Assets/images/logo/favicon.ico" alt="Site Logo">
                    <span>AskTheProff</span>
                </div>
            </div>
        </div>
            <!-- End Container -->
    </header>';
  }

  if (isset($_SESSION['username'])) {
      if ($_SESSION['username'] == 'admin') {
          return header_admin();
      } else {
          return header_login($conn);
      }
  } else {
      return header_no_login();
  }
