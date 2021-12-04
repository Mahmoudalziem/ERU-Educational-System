<?php

    session_start();

    include 'Assets/connect/connected.php';

    strtolower($_SESSION['username']);

    $query = 'select * from users where username = "'.$_SESSION['username'].'" and status = ("user" or "moderator") and actived = 1';

    $stmt = $conn->prepare($query);

    $stmt->execute();

    $result = $stmt->fetch();

    $GLOBALS['username'] = strtolower($result['username']);

    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == $GLOBALS['username']) {
            if (!$_GET['UN'] == $GLOBALS['username']) {
                header('Location: 404.php');

                ob_end_flush();
            }
        } else {
            header('Location: admin_Dashboard.php');

            ob_end_flush();
        }
    } else {
        header('Location: signIn.php');

        ob_end_flush();
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
    <!-- Application-Name -->
    <meta name="application-name" content="Engineering Site">
    <!-- Favicon -->
    <title>Settings</title>
    <!-- Author Name -->
    <meta name="author" content="Azima">
    <link rel="icon" href="Assets/images/logo/favicon.ico">
    <!--BootStrap -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <!--[if lt IE 9>
        <script src="Assets/Js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="Assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="Assets/css/responsive.css">
    <!-- CroppieCss-->
    <link rel="stylesheet" href="Assets/css/croppie.css">
    <style type="text/css">
        div.url-input{
            margin-bottom:10px !important;
            margin-top:10px !important;
        }
        div.url-input input[type="text"]:not([name="website_url"]){
            width: auto !important;
            border-radius: 0 !important;
            flex: 1 1 auto !important;
            line-height: 1.5 !important;
            margin-top: 0 !important;
        }
    </style>

</head>
    <body>

<!--============= Header =================-->
    <?php echo include 'Assets/connect/headerPortfolio.php' ?>
<!--============= Header End =============-->

<!--============= Header banner ==================-->
    <div class="courses-show all_settings">
    <div class="show-content">
        <div class="container">
            <h3>
                All Settings
            </h3>
            <ul class="content-nav">
                <li>
                    <a href="index.php" target="_self">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <div>
                        <i class="fa fa-long-arrow-right"></i> Settings
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--============= Header banner End ===============-->

<!--============= Change settings ================-->
    <div class="change-settings">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a href="#personal-settings" aria-controls="personal-settings" class="active show" role="tab" data-toggle="tab">
                            Personal Settings
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#external-links" aria-controls="external-links" role="tab" data-toggle="tab">
                            External Links
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#change-avater" aria-controls="change-avater" role="tab" data-toggle="tab">
                            Change Avater
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#change-background" aria-controls="change-background" role="tab" data-toggle="tab">
                            Change Background
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#change-password" aria-controls="change-password" role="tab" data-toggle="tab">
                            Change Password
                        </a>
                    </li>

                </ul>
            </div>

            <div class="col-lg-8 col-12">
                <div class="tab-content">

                    <?php

                    $query = 'select * from profile where username="'.$_SESSION['username'].'" ';

                    $stmt = $conn->prepare($query);

                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $value) {
                        $GLOBALS['name'] = $value['name'];

                        $GLOBALS['username'] = $value['username'];

                        $GLOBALS['email'] = $value['email'];

                        $GLOBALS['address'] = $value['address'];

                        $GLOBALS['face_un'] = $value['face_un'];

                        $GLOBALS['twitter_un'] = $value['twitter_un'];

                        $GLOBALS['linked_un'] = $value['linked_un'];

                        $GLOBALS['insta_un'] = $value['insta_un'];

                        $GLOBALS['website_url'] = $value['website_url'];

                        $GLOBALS['avater_image'] = $value['avater_image'];

                        $GLOBALS['background_image'] = $value['background_image'];
                    };

                    $name = $GLOBALS['name'];

                    $username = $GLOBALS['username'];

                    $email = $GLOBALS['email'];

                    $address = $GLOBALS['address'];


                    ?>

                    <div class="tab-pane fade active show" role="tabpanel" id="personal-settings">
                        <div class="col-12">
                            <div class="settings-title">
                                Edit Your Personal Settings
                            </div>
                            <div class="personal-settings">
                                <form role="form" action="" method="POST" class="update_info">
                                    <div class="error validate"></div>
                                    <div class="full-name">
                                        <label>Full Name :</label>
                                        <div class="name-input">
                                            <input type="text" placeholder="Full Name" name="name" value="<?php echo ucwords($name); ?>">
                                        </div>
                                    </div>

                                    <div class="username">
                                        <label>User Name :</label>
                                        <div class="username-input">
                                            <input type="text"  disabled="disabled" readonly placeholder="User Name" name="" value="<?php echo $username?>">
                                        </div>
                                    </div>

                                    <div class="email">
                                        <label>Email :</label>
                                        <div class="Email-input">
                                            <input type="email" placeholder="E-mail" name="" value="<?php echo $email?>">
                                        </div>
                                    </div>

                                    <div class="address">
                                        <label>Address :</label>
                                        <div class="address-input">
                                            <input type="text" placeholder="Address" name="address" value="<?php echo $address == '0' ? '':$address; ?>">
                                        </div>
                                    </div>

                                    <div class="birthday">
                                        <label>Birthday :</label>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control day_value" name="day_value">
                                                        <?php

                                                        $query_birth = 'select birth_date from profile where username = "'.$_SESSION['username'].'" ';

                                                        $stmt_birth = $conn->prepare($query_birth);

                                                        $stmt_birth->execute();

                                                        $rowCount_birth = $stmt_birth->rowCount();

                                                        $result_birth = $stmt_birth->fetchAll();

                                                        $result_birth_alter = $stmt_birth->fetch();

                                                        foreach ($result_birth as $value) {
                                                            $GLOBALS['birth'] = $value['birth_date'];

                                                            $GLOBALS['birth'] = explode(' ', $GLOBALS['birth']);

                                                            for ($x = 1; $x <=31; $x++) {
                                                                if ($value['birth_date'] != null) {
                                                                    if ($x == $GLOBALS['birth'][0]) {
                                                                        echo '<option selected value="'.$GLOBALS['birth'][0].'">'.$GLOBALS['birth'][0].'</option>';
                                                                    } elseif ($x < 10) {
                                                                        echo '<option value='."0". $x.'>'."0".$x.'</option>';
                                                                    } else {
                                                                        echo '<option value='. $x.'>'.$x.'</option>';
                                                                    }
                                                                } else {
                                                                    if ($x == 1) {
                                                                        echo '<option selected value='."0". $x.'>'."0".$x.'</option>';
                                                                    } else {
                                                                        if ($x < 10) {
                                                                            echo '<option value='."0". $x.'>'."0".$x.'</option>';
                                                                        } else {
                                                                            echo '<option value='. $x.'>'.$x.'</option>';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                    <div class="col-md-4">
                                                        <select  class="form-control month_value">
                                                            <?php
                                                                function fetch_month($x, $y)
                                                                {
                                                                    if ($x > 0) {
                                                                        if ($GLOBALS['birth'][1] == $y) {
                                                                            return 'selected';
                                                                        } else {
                                                                            return '';
                                                                        }
                                                                    } else {
                                                                        return '';
                                                                    }
                                                                }
                                                            ?>
                                                            <option <?php echo  isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'January') : '' ?> value="January">January</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'February') : ''?> value="February">February</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'march') : ''?> value="march">March</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'april') : ''?> value="april">April</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'may') : ''?> value="may">May</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'june') : ''?> value="june">June</option>
                                                            <option <?php echo $value['birth_date'] != null ? fetch_month($rowCount_birth, 'july') : 'selected'?> value="july">July</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'august') : ''?> value="august">August</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'september') : ''?> value="september">September</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'october') : ''?> value="october">October</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ? fetch_month($rowCount_birth, 'november') : ''?> value="november">November</option>
                                                            <option <?php echo isset($GLOBALS['birth'][1]) ?fetch_month($rowCount_birth, 'december') : ''?> value="december">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select  class="form-control year_value">
                                                            <?php


                                                            for ($x = 1984; $x <=date('Y'); $x++) {
                                                                if ($value['birth_date'] != null) {
                                                                    if ($x == $GLOBALS['birth'][2]) {
                                                                        echo '<option selected value="'.$GLOBALS['birth'][2].'">'.$GLOBALS['birth'][2].'</option>';
                                                                    } else {
                                                                        echo '<option value='. $x.'>'.$x.'</option>';
                                                                    }
                                                                } else {
                                                                    if ($x == 1998) {
                                                                        echo '<option selected value='. $x.'>'.$x.'</option>';
                                                                    } else {
                                                                        echo '<option value='. $x.'>'.$x.'</option>';
                                                                    }
                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                            </div>
                                        </div><!-- End Column -->
                                    </div>

                                    <div class="button_submit">
                                        <input type="submit" value="Update Information" name="update_info">
                                    </div>
                                </form>
                            </div><!-- End personal Settings -->
                        </div><!-- End Column -->
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="external-links">
                        <div class="col-12">
                            <div class="settings-title">
                                Your External Link
                            </div>
                            <div class="personal-settings">
                                <form name="external_links" action="" role="form" id="external_links" method="POST">
                                    <div class="error validate"></div>

                                    <div class="facebook">
                                        <label>Facebook :</label>
                                        <div class="url-input input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://www.facebook.com/(max:15)</div>
                                            </div>
                                            <input type="text" placeholder="UserName" name="facebook_url" value="<?php echo $GLOBALS['face_un'] == '0' ? '':$GLOBALS['face_un']; ?>">
                                        </div>
                                    </div>

                                    <div class="twitter">
                                        <label>twitter :</label>
                                        <div class="url-input input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://www.twitter.com/</div>
                                            </div>
                                            <input type="text" placeholder="UserName" name="twitter_url" value="<?php echo $GLOBALS['twitter_un'] == '0' ? '':$GLOBALS['twitter_un']; ?>">
                                        </div>
                                    </div>

                                    <div class="linkedin">
                                        <label>Linkedin :</label>
                                        <div class="url-input input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://www.linkedin.com/</div>
                                            </div>
                                            <input type="text" placeholder="UserName" name="linkedin_url" value="<?php echo $GLOBALS['twitter_un'] == '0' ? '':$GLOBALS['twitter_un']; ?>">
                                        </div>
                                    </div>

                                    <div class="instagram">
                                        <label>Instagram :</label>
                                        <div class="url-input input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://www.instagram.com/</div>
                                            </div>
                                            <input type="text" placeholder="UserName" name="instagram_url" value="<?php echo $GLOBALS['insta_un'] == '0' ? '':$GLOBALS['insta_un']; ?>">
                                        </div>
                                    </div>

                                    <div class="website">
                                        <label>Website URL :</label>
                                        <div class="url-input">
                                            <input type="text" placeholder="www.website.com" name="website_url" class="website" value="<?php echo $GLOBALS['website_url'] == '0' ? '':$GLOBALS['website_url']; ?>">
                                        </div>
                                    </div>

                                    <div class="button-submit">
                                        <input type="submit" value="Save & Update" name="save_url_value">
                                    </div>

                                </form>
                            </div><!-- End personal Settings -->
                        </div><!-- End Column -->
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="change-avater">
                        <div class="col-12">
                            <div class="change-images">
                                <form action=""method="post" name="avater_change_image" id="avater_change_image" role="form">

                                    <div class="profile-photo-form">
                                        <label class="d-block">Image preview</label>
                                        <span>Minimum 200x200 pixels, Maximum 6000x6000 pixels</span>
                                    </div>

                                    <div class="error validate mb-3"></div>

                                    <div class="image-upload">
                                        <div class="image-preview">
                                            <div class="file-upload">
                                                <img src="<?php echo  $GLOBALS['avater_image'] != '' ? 'images_users\avaters\\'. $_SESSION['username']. '\\' . $GLOBALS['avater_image'] : 'Assets/images/profiles/default_avater/default_avater.png' ?>" alt="Avater-image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="loading-image">
                                        <input class="custom-file-input d-none" id="load_image_avater" type="file" accept=".gif,.jpg,.jpeg,.png">
                                        <label class="d-flex" for="load_image_avater">
                                            <div class="upload_content">
                                                <input readonly="" type="text"  value="No file selected" class="input_readonly_avater">
                                                <div class="upload_loading"></div>
                                            </div>
                                            <span class="btn">Upload image</span>
                                        </label>
                                    </div>

                                    <div class="modal fade ml-0 pl-0" id="insert_corp_avater" aria-hidden="true">
                                        <div class="modal-dialog" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h3>Corp Image</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <div id="image_crop_avater" class="align-items-center" style="margin-top:30px;height:auto"></div>
                                                            <button class="btn crop_image crop_image_avater">Crop & insert Image</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" value="Update Avater" name="update_avater_image">

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="change-background">
                        <div class="col-12">
                            <div class="change-images">
                                <form action="" method="POST" name="background_change_image" role="form" id="background_change_image">

                                    <div class="profile-photo-form">
                                        <label class="d-block">Change Background</label>
                                        <span>Size 1200X350 pixels, Maximum 6000x350 pixels</span>
                                    </div>
                                    <div class="error validate mb-4"></div>

                                    <div class="image-upload">
                                        <div class="image-preview image-preview-background">
                                            <div class="file-upload">
                                                <img class="background" src="<?php echo  $GLOBALS['background_image'] != '' ? 'images_users\background\\'. $_SESSION['username']. '\\' . $GLOBALS['background_image'] : 'Assets/images/profiles/default_background/default_background.png' ?>" alt="Avater-image" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="loading-image">
                                        <input class="custom-file-input d-none" id="load_image_background" type="file" accept=".gif,.jpg,.jpeg,.png">

                                        <label class="d-flex" for="load_image_background">
                                            <div class="upload_content">
                                                <input readonly="" type="text"  value="No file selected" class="input_readonly_background">
                                                <div class="upload_loading"></div>
                                            </div>
                                            <span class="btn">Upload image</span>
                                        </label>
                                    </div>

                                    <div class="modal fade ml-0 pl-0" id="insert_corp_background" role="dialog" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="max-width: 1200px;height:400px">

                                            <div class="modal-content" style="max-width: 100% !important;">

                                                <div class="modal-header">
                                                    <h3>Corp Image</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <div id="image_crop_background" class="align-items-center" style="margin-top:30px;height:auto"></div>
                                                            <button class="btn crop_image crop_image_background">Crop & insert Image</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" value="Update Ground" name="update_background_image">

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" role="tabpanel" id="change-password">
                        <div class="col-12">
                            <div class="settings-title">
                                Change Password
                            </div>
                            <div class="personal-settings">
                                <form name="" action="" class="form_update_password" role="form" method="POST">
                                    <div class="validate_password error"></div>
                                    <div class="">
                                        <label>Current Password</label>
                                        <div class="position-relative" data-validate="Password Is Required">
                                            <input class="input_100" name="current_password" type="password" placeholder="Current Password">
                                        </div>
                                    </div>

                                    <div class="new_password">
                                        <label>New Password</label>
                                        <div class="position-relative" data-validate="New Password Required">
                                            <input class="input_100" name="new_password" type="password" placeholder="New Password (min 6 chars)">
                                        </div>
                                    </div>


                                    <div class="confirm+password">
                                        <label>Confirm New Password</label>
                                        <div class="position-relative" data-validate="Confirm Password Required">
                                            <input class="input_100" name="confirm_password" type="password" placeholder="Confirm New Password">
                                        </div>
                                    </div>

                                    <div class="button_submit">
                                        <input type="submit" value="Save & Update" name="update_password">
                                    </div>
                                </form>
                            </div><!-- End personal Settings -->
                        </div><!-- End Column -->
                    </div>

                </div><!-- End tab Content -->

            </div>
        </div><!-- End Row -->
    </div><!-- End Container -->
</div>
<!--============= Change settings End ============-->

<?php
    include 'Assets/connect/footer.php';
?>
<script src="Assets/Js/croppie.min.js"></script>
<script type="text/javascript">
    nicescroll();
    dropdown();
    let image_corp_avater = $('#image_crop_avater').croppie({
        enableExif: true,
        viewport:{
            width:200,
            height:200,
            type:'circle',
        },
        boundary:{
            height:300,
        }
    });

    let image_corp_background = $('#image_crop_background').croppie({
        enableExif: true,
        viewport:{
            width:1200,
            height:350,
            type:'square',
        },
        boundary:{
            height:350,
        }
    });

    $('a[data-target="#delete-account"]').on('click',function(){

      $('div#delete-account .error').html('').addClass('display_none').removeClass('display_block');
    })
</script>

    </body>
</html>