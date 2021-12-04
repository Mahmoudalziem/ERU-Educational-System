$(document).ready(function () {

    /************** Validate Input *****************/

    $(`.username-input input[type="text"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9]$/');

        let regExp = /^[a-zA-Z0-9@_.]{5,18}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.username-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.username-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    $(`.forget-input input[type="text"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9@_.]$/');

        let regExp = /^[a-zA-Z0-9@_.]{5,40}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.forget-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.forget-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    $(`.name-input input[type="text"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9@_.]$/');

        let regExp = /^[a-zA-Z0-9 ]{5,40}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.name-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.name-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    $(`.address-input input[type="text"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9@_.]$/');

        let regExp = /^[a-zA-Z0-9 ]{5,40}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.name-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.name-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    $(`.Email-input input[type="email"]`).keyup(function () {

        //let regExp = new RegExp(/^[a-zA-Z0-9_]+@[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}$/);

        let regExp = /^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.Email-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.Email-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    $(`.password-input input[type="password"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9]$/');

        let regExp = /^[a-zA-Z0-9@_.#@]{6,50}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.password-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.password-input span').addClass('has-error-span').removeClass('has-success-span');
        }
    });

    $(`.confirm-input input[type="password"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9]$/');

        let regExp = /^[a-zA-Z0-9@_.#@]{6,50}$/;

        if (regExp.test($(this).val())) {

            if ($(this).val() === $('.password-input input[type="password"]').val()) {

                $(this).addClass('has-success').removeClass('has-error');

                $('.confirm-input span').addClass('has-success-span').removeClass('has-error-span');

            } else {

                $(this).addClass('has-error').removeClass('has-success');

                $('.confirm-input span').addClass('has-error-span').removeClass('has-success-span');

            }
        } else {

            $(this).css('border', '1px solid rgb(222, 33, 33)');

            $('.confirm-input  span').css('background-color', 'rgb(222, 33, 33)');
        }

    });

    $(`.url-input input[type="text"]:not(.website)`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9@_.]$/');

        let regExp = /^[a-zA-Z0-9]{5,15}$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

        }

    });

    $(`.url-input input[name="website_url"]`).keyup(function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9@_.]$/');

        let regExp = /^(?:http?:|https?:\/\/)(?:www\.)(?:[a-zA-Z0-9_]{3,15})(?:\.com|\.online|\.eg)$/;

        if (regExp.test($(this).val())) {

            $(this).addClass('has-success').removeClass('has-error');

            $('.url-input span').addClass('has-success-span').removeClass('has-error-span');

        } else {

            $(this).addClass('has-error').removeClass('has-success');

            $('.url-input span').addClass('has-error-span').removeClass('has-success-span');

        }

    });

    /************** Validate Input *****************/

    $(document).on('click', '.signUp input[type="submit"]', function (event) {

        event.preventDefault();

        let username = $('.username-input input[type="text"]').val(),

            name = $('.name-input input[type="text"]').val(),

            email = $('.Email-input input[type="email"]').val(),

            password = $('.password-input input[type="password"]').val(),

            confirm_password = $('.confirm-input input[type="password"]').val(),

            token = $('input[name="token"].token').val(),

            action = 'addUser';


        if (username === '' || email === '' || password === '' || confirm_password === '' && name === '') {

            $('.error').html('Please Enter Your Info').addClass('display_block').removeClass('display_none');
        } else {

            if (confirm_password !== password) {

                $('.error').html('confirm Password And Password Not Matched').addClass('display_block').removeClass('display_none');

                $(`.confirm-input input[type="password"]`).css('border', '1px solid rgb(222, 33, 33)');

                $('.confirm-input  span').css('background-color', 'rgb(222, 33, 33)');
            } else {
                $(`.confirm-input input[type="password"]`).css('border', '1px solid #3b3e79');

                $('.confirm-input span').css('background-color', '#3b3e79');

                $.ajax({
                    url: 'Assets/connect/add_user.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        action: action,
                        username: username,
                        name: name,
                        email: email,
                        password: password
                    },
                    beforeSend: function () {

                        $('.error').html('Waiting ...').addClass('display_block').removeClass('display_none');

                    },
                    success: function (data) {

                        if (data !== '') {

                            $('.error').html(data).addClass('display_block').removeClass('display_none');
                        } else {

                            $('.validate').html('Go To E-Mail To Active Your Account').addClass('display_block').removeClass('display_none').css({
                                'width': '100%'
                            });

                            $('.username-input input[type="text"]').val('');

                            $('.Email-input input[type="email"]').val('');

                            $('.name-input input[type="text"]').val('');

                            $('.password-input input[type="password"]').val('');

                            $('.confirm-input input[type="password"]').val('');

                        }
                    }
                }); // End request
            } // End Else

        }

    });

    $(document).on('click', '.signIn input[type="submit"]', function (event) {

        event.preventDefault();

        let username = $('.username-input input[type="text"]').val(),

            password = $('.password-input input[type="password"]').val(),

            rememberMe = $('input[type="checkbox"].remember').prop('checked'),

            token = $('input[name="token"].token').val(),

            action = 'login_site';

        username = username.toString().toLowerCase();

        if (username === '' || password === '') {

            $('.error').html('Both Fields Are Required').addClass('display_block').removeClass('display_none');

        } else {
            $.ajax({
                url: 'Assets/connect/login.php',
                method: 'POST',
                dataType: 'JSON',
                cache: false,
                data: {
                    action: action,
                    username: username,
                    password: password,
                    rememberMe: rememberMe,
                    token: token
                },
                beforeSend: function () {
                    $('.error').html('Waiting ...').addClass('display_block').removeClass('display_none');
                },
                success: function (data) {

                    if (data.output == 'user') {

                        $('.error').html('').addClass('display_none').removeClass('display_block');

                        location.replace('portfolio.php' + '?UN=' + username);

                    } else if (data.output == 'admin') {

                        $('.error').html('').addClass('display_none').removeClass('display_block');

                        location.replace('admin_Dashboard.php');

                    } else {

                        $('.error').html(data.output).addClass('display_block').removeClass('display_none');
                    }
                }
            }); // End request

        } // End Else
    });

    $(document).on('click', '.forget_password input[type="submit"]', function (event) {

        event.preventDefault();

        let forget_password = $('.forget-input input[type="text"]').val(),

            action = 'forget_password';

        if (forget_password === '') {

            $('.error').html('Please Enter Your UserName Or Email').addClass('display_block').removeClass('display_none');
        } else {
            $.ajax({
                url: 'Assets/connect/forget_password.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    action: action,
                    forget_password: forget_password
                },
                beforeSend: function () {
                    $('.validate').html('Waiting . . . ').addClass('display_block').removeClass('display_none');
                },
                success: function (data) {
                    $('.validate').html(data).addClass('display_block').removeClass('display_none');
                }
            });
        }

    });

    $(document).on('click', 'a#logoOut,li.logo_out_admin', function () {

        let action = 'logoOut';

        $.ajax({
            url: 'Assets/connect/logoOut.php',
            method: 'POST',
            data: {
                action: action
            },
            success: function () {
                location.replace('signIn.php');
            }
        });
    });

    $(document).on('click', 'input.submit_message_send', function (event) {

        let f_name = $('input[name="f_name"]').val(),

            l_name = $('input[name="l_name"]').val(),

            email_name = $('input[name="email_name"]').val(),

            message_area = $('textarea.message_area').val();

        event.preventDefault();

        let check = true;

        for (let i = 0; i < input.length; i++) {

            if ($(input[i]).val().trim() === '') {

                showValidate(input[i]);

                check = false;
            } else {

                hideValidate(input[i]);

                check = true;
            }
        }

        if (check === false) {

            $('.validate').html('').css('display', 'none');
        } else {

            let action = 'send_message';

            $.ajax({
                url: 'Assets/connect/send_message.php',
                method: 'POST',
                data: {
                    action: action,
                    f_name: f_name,
                    l_name: l_name,
                    email_name: email_name,
                    message_area: message_area
                },
                dataType: 'JSON',
                beforeSend: function () {
                    $('.validate').html('Waiting ... ').css('display', 'block');
                },
                success: function (data) {

                    if (data === 'ok') {

                        $('.validate').html('Thanks for Contact Us').css('display', 'block');

                        $('input[name="f_name"]').val('');

                        $('input[name="l_name"]').val('');

                        $('input[name="email_name"]').val('');

                        $('textarea.message_area').val('');
                    } else {
                        $('.validate').html(data).css('display', 'block');
                    }
                }
            });

        }
    });

    $(document).on('click', '.button_submit input[name="update_info"]', function (event) {

        event.preventDefault();

        let name = $('.name-input input[type="text"]').val(),

            email = $('.Email-input input[type="email"]').val(),

            address = $('.address-input input[type="text"]').val(),

            day_value = $('select.day_value').val(),

            month_value = $('select.month_value').val(),

            year_value = $('select.year_value').val();

        if (name == '') {

            $('.error').html('Name Is Required').addClass('display_block').removeClass('display_none');
        } else if (email == '') {

            $('.error').html('Email Is Required').addClass('display_block').removeClass('display_none');
        } else {

            let action = 'update_info';

            $.ajax({
                url: 'Assets/connect/update_info.php',
                method: 'POST',
                dataType: 'JSON',
                cache: false,
                data: {
                    action: action,
                    name: name,
                    email: email,
                    address: address,
                    day_value: day_value,
                    month_value: month_value,
                    year_value: year_value
                },
                beforeSend: function () {
                    $('.update_info .error').html('Waiting .... ').addClass('display_block').removeClass('display_none');
                },
                success: function (data) {

                    if (data == '') {

                        $('.update_info .error').html('Refresh Your Page To Submit Update').addClass('display_block').removeClass('display_none');
                    } else if (data == 'user_update') {

                        location.replace('settings.php?UN=' + username);
                    } else {
                        $('.update_info .error').html(data).addClass('display_block').removeClass('display_none');
                    }
                }
            });
        }
    });

    $(document).on('click', '.button-submit input[name="save_url_value"]', function (event) {

        event.preventDefault();

        let form_submit = $('form#external_links').serialize(),

            action = 'Update_Links';

        $.ajax({
            url: 'Assets/connect/update_external_links.php',
            method: 'POST',
            dataType: 'JSON',
            cache: false,
            data: {
                action: action,
                form_submit: form_submit
            },
            beforeSend: function () {
                $('#external_links .error').html('Waiting .... ').addClass('display_block').removeClass('display_none');
            },
            success: function (data) {
                if (data == '') {
                    $('#external_links .validate').html('Refresh Your Page To Submit Update').addClass('display_block').removeClass('display_none');
                } else {
                    $('#external_links .validate').html(data).addClass('display_block').removeClass('display_none');
                }
            },
        });
    });

    $('#load_image_avater').change(function () {

        let reader = new FileReader();

        reader.onload = function (event) {

            image_corp_avater.croppie('bind', {

                url: event.target.result

            });

        };

        reader.readAsDataURL(this.files[0]);

        $('#insert_corp_avater').modal('show');

    });

    $('#load_image_background').change(function () {

        let reader = new FileReader();

        reader.onload = function (event) {

            image_corp_background.croppie('bind', {

                url: event.target.result

            });
        }
        reader.readAsDataURL(this.files[0]);

        $('#insert_corp_background').modal('show');
    });

    $(document).on('click', '.crop_image_avater', function (event) {

        event.preventDefault();

        let avater = 'crop_images';

        image_corp_avater.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (response) {
            $.ajax({
                url: 'Assets/connect/crop_images.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    action: '',
                    avater: avater,
                    image: response
                },
                success: function (data) {

                    $('#insert_corp_avater').modal('hide');

                    $('.file-upload img')[0].src = data;

                    $('a.avater-display img').each(function () {

                        $(this).attr('src', data);
                    });

                    $('input[class="input_readonly_avater"]').val($('#load_image_avater').val());
                },
            })
        });



    });

    $(document).on('click', '.crop_image_background', function (event) {

        event.preventDefault();

        let background = 'Background_Corp';

        image_corp_background.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (response) {
            $.ajax({
                url: 'Assets/connect/crop_images.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    action: '',
                    background: background,
                    image: response
                },
                success: function (data) {

                    $('#insert_corp_background').modal('hide');

                    $('.file-upload img')[1].src = data;

                    $('input[class="input_readonly_background"]').val($('#load_image_background').val());
                },
            })
        });

    });

    $(document).on('click', 'input[name="update_avater_image"]', function (event) {

        event.preventDefault();

        let avater = 'update_avater_image',

            image = $('.file-upload img')[0].src;

        if ($('#load_image_avater').val() == '') {

            $('#avater_change_image .validate').html('Please Select Your Image').addClass('display_block').removeClass('display_none');
        } else {
            $.ajax({
                url: 'Assets/connect/image_update.php',
                method: 'POST',
                data: {
                    action: '',
                    avater: avater,
                    image_name: image
                },
                beforeSend: function () {

                    $('#avater_change_image .upload_content .upload_loading').removeClass('upload_complete');

                    $('#avater_change_image .error').html('Waiting ... ').addClass('display_block').removeClass('display_none');

                },
                success: function (data) {

                    $('#load_image_avater').val('');

                    function complete() {

                        $('#avater_change_image .upload_content .upload_loading').addClass('upload_complete');

                        return true;
                    };

                    if (setTimeout(complete, 500)) {

                        setTimeout(function () {

                            $('#avater_change_image .validate').html(data).addClass('display_block').removeClass('display_none');

                        }, 1000);
                    }
                }
            });
        }


    })

    $(document).on('click', 'input[name="update_background_image"]', function (event) {

        event.preventDefault();

        let background = 'update_background_image',

            image = $('.file-upload img')[1].src;

        if ($('#load_image_background').val() == '') {

            $('#background_change_image .validate').html('Please Select Your Image').addClass('display_block').removeClass('display_none');
        } else {
            $.ajax({
                url: 'Assets/connect/image_update.php',
                method: 'POST',
                data: {
                    action: '',
                    background: background,
                    image_name: image
                },
                beforeSend: function () {

                    $('#background_change_image .upload_content .upload_loading').removeClass('upload_complete');

                    $('#background_change_image .error').html('Waiting ... ').addClass('display_block').removeClass('display_none');

                },
                success: function (data) {

                    $('#load_image_background').val('');

                    function complete() {

                        $('#background_change_image .upload_content .upload_loading').addClass('upload_complete');

                        return true;
                    };

                    if (setTimeout(complete, 500)) {

                        setTimeout(function () {

                            $('#background_change_image .validate').html(data).addClass('display_block').removeClass('display_none');

                        }, 1000);
                    }
                }
            });
        }


    })

    $(document).on('click', '.button_submit input[name="update_password"]', function (event) {

        event.preventDefault();

        let action = 'Update_Password',

            form = $('form.form_update_password').serialize(),

            check = true;

        for (let i = 0; i < input.length; i++) {

            if ($(input[i]).val().trim() === '') {

                showValidate(input[i]);

                check = false;
            } else {

                hideValidate(input[i]);

                check = true;
            }
        }

        if (check == false) {

            $('.validate_password').addClass('display_none').removeClass('display_block');

            $('.validate_password').addClass('display_none').removeClass('display_block');
        } else {
            let new_password = $('input[name="new_password"]').val(),

                con_password = $('input[name="confirm_password"]').val(),

                regExp = /^[a-zA-Z0-9._@#]{6,20}$/;

            if (regExp.test(new_password)) {

                if (new_password != con_password) {

                    $('.validate_password').html('New And Confirm Must Be Matched').addClass('display_block').removeClass('display_none');
                } else {
                    $.ajax({
                        url: 'Assets/connect/update_info.php',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            action: action,
                            form: form
                        },
                        beforeSend: function () {

                            $('.validate_password').html('Waiting ... ').addClass('display_block').removeClass('display_none');
                        },
                        success: function (data) {
                            if (data == '') {

                                $('.validate_password').html('Password Updated').addClass('display_block').removeClass('display_none');

                                $('input[name="new_password"]').val('');

                                $('input[name="confirm_password"]').val('');

                                $('input[name="current_password"]').val('');
                            } else {
                                $('.validate_password').html(data).addClass('display_block').removeClass('display_none');
                            }

                        }
                    });
                }
            } else {
                $('.validate_password').html('New Password At Least 6 Chars').addClass('display_block').removeClass('display_none');
            }


        }

    })

    $('#load_image_course').change(function () {

        $('div#course_corp_image .error').html('').addClass('display_none').removeClass('display_block');

        let reader = new FileReader();

        reader.onload = function (event) {

            course_corp_image.croppie('bind', {

                url: event.target.result

            });

        };

        reader.readAsDataURL(this.files[0]);

        $('#course_corp_image').modal('show');

    });

    $(document).on('click', 'button.crop_image_course', function (event) {

        event.preventDefault();

        let course_image = 'corp_image_course';

        course_title = $('form.course_landing_page_form input[name="title"]').val();

        if (course_title == '') {

            $('div#course_corp_image .error').html('Course Title Is Required').addClass('display_block').removeClass('display_none');

            $('#load_image_course').val('');
        } else {

            course_corp_image.croppie('result', {
                type: 'canvas',
                size: 'viewport',
            }).then(function (response) {
                $.ajax({
                    url: 'Assets/connect/crop_images.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        action: '',
                        course_image: course_image,
                        image: response,
                        course_title: course_title
                    },
                    beforeSend: function () {
                        $('#course_corp_image .error').html('Waiting ... ').addClass('display_block').removeClass('display_none');
                        $('form.course_landing_page_form input[name="title"]').attr('disabled', 'disabled');
                    },
                    success: function (data) {

                        $('#course_corp_image').modal('hide');

                        $('#course_corp_image .error').html('').addClass('display_none').removeClass('display_block');
                        $('form[name="course_crop_image"] .file-upload img')[0].src = data;

                        $('input[class="input_readonly_course"]').val($('#load_image_course').val());

                        $('#load_image_course').val('');

                        setTimeout(function () {
                            $('form#course_image .upload_content .upload_loading').addClass('upload_complete');
                        }, 1000);



                    },
                });
            });
        };

    });

    $(document).on('click', 'button.button_submit_course,button.button_edit_course', function (event) {

        event.preventDefault();

        let course_title = $('form.course_landing_page_form input[name="title"]').val(),

            course_language = $('form.course_landing_page_form select[name="language_course"]').val(),

            course_depart = $('form.course_landing_page_form select[name="depart_name"]').val(),

            course_semester = $('form.course_landing_page_form select[name="semester_option"]').val(),

            description_content = $('#txtEditor').Editor('getText'),

            image_course = $('form#course_image div.file-upload img').attr('src'),

            target_student_learn = [],

            target_student_require = [],

            section_title = [],

            course_tages_array = [],

            /****** Video Content ***/

            video_title = [],

            video_url = [],

            video_date = [],

            /****** File Content ***/

            file_title = [],

            file_content = [],

            file_date = [],

            data_section_video = [],

            data_section_file = [],

            data_tr_file_id = [],

            data_tr_video_id = [],

            section_content_id = [];

        $('table.table_content_video_file tbody tr.file_tr').each(function () {

            data_tr_file_id.push($(this).attr('data-id'));

        });

        $('div.section_content').each(function () {

            section_content_id.push($(this).attr('data-number'));

        });

        $('table.table_content_video_file tbody tr.video_tr').each(function () {

            data_tr_video_id.push($(this).attr('data-id'));

        });

        $('span.token-label').each(function () {

            course_tages_array.push($(this).text());
        });

        $($('div.learn_tabs div input[name="input_learn"]')).each(function () {

            target_student_learn.push($(this).val());

        });

        $($('div.require_tabs div input[name="input_require"]')).each(function () {

            target_student_require.push($(this).val());

        });

        /******** Video Details ***********/

        $($('td.video_title')).each(function () {

            video_title.push($(this).text());
        });

        $($('input[name="content_video_input"]')).each(function () {

            video_url.push($(this).val());
        });

        $($('td.date_video')).each(function () {

            video_date.push($(this).text());
        });


        /******** File Details ***********/

        $($('td.file_title')).each(function () {

            file_title.push($(this).text());
        });

        $($('input[name="content_file_input"]')).each(function () {

            file_content.push($(this).val());

        });

        $($('td.date_file')).each(function () {

            file_date.push($(this).text());
        });

        /**************** Section Title **********/

        $('span.section_name_content').children('.section_span').each(function () {

            section_title.push($(this).text());

        });


        $('input[name="content_video_input"]').each(function () {

            data_section_video.push($(this).attr('data-section'));

        });

        $('input[name="content_file_input"]').each(function () {

            data_section_file.push($(this).attr('data-section'));

        });

        if (course_title == '') {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('Title Must Be Enter').addClass('display_block').removeClass('display_none');

        } else if (course_tages_array.length == 0 || course_tages_array.length > 15) {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('Please Enter At Least One Tage (max 15 Tages) ').addClass('display_block').removeClass('display_none');
        } else if (course_language == 'select_language') {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('Language Must Be Enter').addClass('display_block').removeClass('display_none');

        } else if (course_depart == '-- Select Depart --') {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('Depart  Must Be Enter').addClass('display_block').removeClass('display_none');
        } else if (description_content == '') {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('Description Must Be Enter').addClass('display_block').removeClass('display_none');

        } else if (section_title.length == 0) {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('').addClass('display_none').removeClass('display_block');

            $('div#curriculum div.col-12 .error').html('Please Enter At Least One Section').addClass('display_block').removeClass('display_none');

        } else if ($('table.table_content tbody').html() == '') {

            $('div.handaling_error').html('').removeClass('active');

            $('form.course_landing_page_form .error').html('').addClass('display_none').removeClass('display_block');

            $('div#curriculum div.col-12 .error').html('Please Enter At Least One Video Or File').addClass('display_block').removeClass('display_none');

        } else {

            $('.error').html('').addClass('display_none').removeClass('display_block');

            if ($(this).hasClass('button_submit_course')) {

                let action = 'Add_Course';

                $.ajax({
                    url: 'Assets/connect/add_course.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        action: action,
                        course_title: course_title,
                        course_tages: course_tages_array,
                        course_language: course_language,
                        course_depart: course_depart,
                        course_semester: course_semester,
                        description_content: description_content,
                        learn_tabs: target_student_learn,
                        require_tabs: target_student_require,
                        image_course: image_course,
                        section_title: section_title,
                        video_title: video_title,
                        video_date: video_date,
                        video_url: video_url,
                        file_title: file_title,
                        file_date: file_date,
                        file_content: file_content,
                        data_section_video: data_section_video,
                        data_section_file: data_section_file
                    },
                    beforeSend: function () {

                        $('div.handaling_error').html('Waiting .... ').addClass('active');
                    },
                    success: function (data) {

                        setTimeout(function () {
                            if (data == '') {

                                $('div.handaling_error').html('Complete').addClass('active').fadeIn();

                                setTimeout(function () {

                                    $('div.handaling_error').fadeOut(50);

                                    $('form.course_landing_page_form input').val('');

                                    $('form.course_landing_page_form select[name="language_course"]').val('select_language').prop('selected');

                                    $('form.course_landing_page_form select[name="depart_name"]').val('-- Select Depart --').prop('selected');

                                    $('div.token').remove();

                                    $('div.Editor-editor').text('');

                                    $('div.Editor-editor').children().remove();

                                    $('form#course_image div.file-upload img').attr('src', 'Assets\\images\\profiles\\default_course\\default_course.png');

                                    $('div.upload_loading').removeClass('upload_complete');

                                    $('input.input_readonly_course').val('No file selected');

                                    $('input#load_image_course').val('');

                                    $('input[name="input_learn"]').val('');

                                    for (let x = 0; x < $('div.learn_tabs').length; x++) {

                                        if ($($(this)[x]) > 1) {

                                            $($(this)[x]).remove();
                                        }
                                    }

                                    $('input[name="input_require"]').val('');


                                    for (let x = 0; x < $('div.require_tabs').length; x++) {

                                        if ($(this)[x] > 1) {

                                            $(this)[x].remove();
                                        }
                                    }

                                    $('table.table_content_video_file tbody').children().remove();

                                    for (let x = 0; x < $('div.section_content').length; x++) {

                                        if ($($(this).attr('data-number')[x]) > 1) {

                                            $(this)[x].remove();
                                        };
                                    }

                                }, 3000);

                            } else {

                                $('div.handaling_error').html(data).addClass('active').fadeIn();
                            }
                        }, 50);

                    }
                })
            } else if ($(this).hasClass('button_edit_course')) {

                let action = 'Edit_course',

                    id = $(this).attr('data-id'),

                    array_id = [];

                $($('table.table_content_video_file tbody tr')).each(function () {

                    array_id.push($(this).attr('id'));

                });

                function check() {

                    $.ajax({
                        url: 'Assets/connect/add_course.php',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            action: action,
                            id: id,
                            section_content_id: section_content_id,
                            data_tr_video_id: data_tr_video_id,
                            data_tr_file_id: data_tr_file_id,
                            course_tages: course_tages_array,
                            course_language: course_language,
                            course_depart: course_depart,
                            course_semester: course_semester,
                            description_content: description_content,
                            learn_tabs: target_student_learn,
                            require_tabs: target_student_require,
                            image_course: image_course,
                            section_title: section_title,
                            video_title: video_title,
                            video_date: video_date,
                            video_url: video_url,
                            file_title: file_title,
                            file_date: file_date,
                            file_content: file_content,
                            data_section_video: data_section_video,
                            data_section_file: data_section_file
                        },
                        beforeSend: function () {
                            $('div.handaling_error').html('Waiting .... ').addClass('active');
                        },
                        success: function (data) {

                            setTimeout(function () {

                                if (data == '') {

                                    $('div.handaling_error').html('Course Updated').addClass('active').fadeIn();

                                    $('button.button_edit_course').attr('disabled', 'disabled');

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {

                                    $('div.handaling_error').html(data).addClass('active').fadeIn();

                                }
                            }, 500);

                        }
                    })
                }

                if (check() == false) {

                }
            }

        }
    });

    $(document).on('click', 'div.collapse_semester>a,a[data-collapse="collapse"].all', function () {

        var id_semester = $(this).attr('data-semester'),

            id_department = $(this).parents('li').attr('data-depart'),

            action = 'Fetch_Course_Semester';

        if ($(this).hasClass('all')) {

            getresult('Assets/connect/fetchCourses.php');
        } else {

            $(this).toggleClass('active').siblings('a').removeClass('active');

            $.ajax({
                url: 'Assets/connect/fetch_course_semester.php',
                method: 'POST',
                data: {
                    action: action,
                    id_semester: id_semester,
                    id_department: id_department
                },
                beforeSend: function () {
                    $('div#courses-wrapper').html('Waiting ...');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('div#courses-wrapper').html(data);
                    }, 500);

                }
            })
        }

    });

    $(document).on('click', 'div.rate-btn', function () {

        var rating_id = $(this).attr('id'),

            course_id = $(this).parent('.rate').attr('data-course'),

            action = 'rating_star';

        $('.rate-btn').removeClass('rate-btn-active');

        $.ajax({
            url: 'Assets/connect/star_rating.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action: action,
                rating_id: rating_id,
                course_id: course_id
            },
            success: function (data) {

                if (data.length === 0) {

                    $('.review_alert').fadeIn(100);

                    setTimeout(function () {

                        $('.review_alert').fadeOut();

                    }, 3000);
                } else {
                    fetch_rating();

                    for (var x = 1; x <= 6; x++) {

                        $('span#review_' + x).html(data[x - 1]);
                    }
                }

            }
        });

    });


    $(document).on('click', 'div.enroll a', function () {

        let id = $(this).parents('.enroll').attr('data-id'),

            action = 'enroll_course';

        $.ajax({
            url: 'Assets/connect/watchlist_course.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                action: action,
                id: id
            },
            beforeSend: function () {
                $('div.enroll .tooltip_course').text('Waiting ...');
            },
            success: function (data) {
                $('div.enroll .tooltip_course').text(data);
            }
        });
    });

    $('button.submit_notify').on('click', function () {

        let depart_id = $('select[name="depart_name_notify"]').val(),

            sem_id = $('select[name="semester_name_alter"]').val(),

            action = 'submit_notify';

        if (depart_id == '-- Select Depart --') {

            $('.fetch_notification .error').html('Please Enter Depart Name').addClass('display_block').removeClass('display_none');
        } else {
            $.ajax({
                url: 'Assets/connect/submit_notify.php',
                method: 'POST',
                data: {
                    depart_id: depart_id,
                    sem_id: sem_id,
                    action: action
                },
                beforeSend: function () {
                    $('.fetch_notification .error').html('').addClass('display_none').removeClass('display_block');
                },
                success: function () {
                    setTimeout(function () {
                        $('.fetch_notification').addClass('active');
                    }, 500);
                }
            });
        }
    });

    $(document).on('click', '.notification-display', function () {

        $('span.dot').html('');

        $('.notify .blink').css('display', 'none');

        notification_insert('yes');
    });


    $('a.clear_notify').on('click', function () {

        var action = 'clear_all_notification';
        $.ajax({
            url: 'Assets/connect/clearAll_notification.php',
            method: 'POST',
            data: {
                action: action
            },
            success: function () {
                notification_insert();
            }
        });
    });


    $(document).on('click', 'a.delete_course', function () {


        let course_id = $(this).attr('data-course_id');

        $('div#delete_course').attr('data-course_id', course_id);

    });

    $(document).on('click', 'button.button_delete_course', function () {

        let course_id = $(this).parent().attr('data-course_id'),

            action = 'deleteCourse';

        $.ajax({
            url: 'Assets/connect/delete_course_user.php',
            method: 'POST',
            data: {
                action: action,
                course_id: course_id
            },
            success: function () {
                $('#Delete_course').modal('hide');
                setTimeout(function () {
                    location.reload();
                }, 100);
            }
        });
    });

    $(document).on('click', 'input[name="submit_search"]', function () {

        //let regExp = new RegExp('/^[a-zA-Z0-9]$/');

        let array_tags = [],

            regExp = /^[a-zA-Z]+$/,

            action = 'searchInput',

            checkToken = false;

        $('form[name="form_search"] .token').each(function () {

            array_tags.push($(this).children('.token-label').text());

            if (regExp.test($(this).children('.token-label').text())) {

                checkToken = true;

                return true;

            } else {

                checkToken = false;

                return false;
            }
        });

        if ($('form[name="form_search"] .token').length == 0) {

            $('div.content_search').addClass('show');

            $('div.content_search ul').html('<li>Enter Course Tags</li>');

        } else {

            if (checkToken == true) {
                $.ajax({
                    url: 'Assets/connect/search.php',
                    method: 'POST',
                    data: {
                        action: action,
                        tags_input: array_tags
                    },
                    beforeSend: function () {
                        $('input[name="submit_search"]').val('Waiting');
                    },
                    success: function (data) {

                        $('input[name="submit_search"]').val('Search');

                        $('div.content_search').addClass('show');

                        $('div.content_search ul').html(data);

                    }
                });
            } else {

                $('div.content_search').addClass('show');

                $('div.content_search ul').html('<li>Enter Valid Tags</li>');
            }
        }

    });


    $(document).on('click', 'button.show_more_button', function () {

        let action = 'ShowMoreButton',

            id = $('div#watchlist-courses div.course_watchlist').last().attr('data-id');

        $.ajax({
            url: 'Assets/connect/showMore.php',
            method: 'POST',
            cashe: false,
            data: {
                action: action,
                id: id
            },
            beforeSend: function () {
                $('.student-course-tab .error').html('Waiting ...').addClass('display_block').removeClass('display_none');
            },
            success: function (data) {
                if (data == '') {

                    $('.student-course-tab .error').html('This Is All Courses which Found').fadeIn(400);

                    setTimeout(function () {

                        $('.student-course-tab .error').fadeOut();

                    }, 3000);

                } else {

                    $('.student-course-tab .error').html('').addClass('display_none').removeClass('display_block');

                    $('#watchlist-courses').children('.row').append(data);
                }


            },
        })
    });

    $(document).on('submit', 'form.form_question_push', function (event) {

        event.preventDefault();

        let q_title = $('div.question_title_input input[type="text"]').val(),

            q_lang = $('select.question_lang_select').val(),

            q_depart = $('select.question_depart_select').val(),

            q_content = $('#question_content').Editor('getText'),

            action = 'Q_publish';


        if (q_title == '') {

            $(this).children('div.error').text('Please Enter Question Title').addClass('display_block').removeClass('display_none');

        } else if (q_lang == 'select_language') {

            $(this).children('div.error').text('Please Select Question Language').addClass('display_block').removeClass('display_none');
        } else if (q_depart == '-- Select Depart --') {

            $(this).children('div.error').text('Please Select Question Department').addClass('display_block').removeClass('display_none');
        } else if (q_content == '') {

            $(this).children('div.error').text('Question Content Required').addClass('display_block').removeClass('display_none');
        } else {
            $.ajax({
                url: 'Assets/connect/question_publish.php',
                method: 'POST',
                data: {
                    action: action,
                    q_title: q_title,
                    q_lang: q_lang,
                    q_depart: q_depart,
                    q_content: q_content
                },
                beforeSend: function () {
                    $('form.form_question_push').children('div.error').text('Waiting ...').addClass('display_block').removeClass('display_none');
                },
                success: function (data) {

                    $('form.form_question_push').children('div.error').text(data).addClass('display_block').removeClass('display_none');

                    $('div.question_title_input input[type="text"]').val('');

                    $('select.question_lang_select').val('select_language');

                    $('select.question_depart_select').val('-- Select Depart --');

                    $('form.form_question_push div.Editor-editor').text('');

                    setTimeout(function () {

                        $('form.form_question_push').children('div.error').text('').addClass('display_none').removeClass('display_block');

                    }, 3000);
                },
            })
        }
    });

    $(document).on('change', 'div.q_content div.question_option select', function () {

        let q_change_value = $(this).val(),

            action = 'Q_change_depart';

        $.ajax({
            url: 'Assets/connect/question_select_depart.php',
            method: 'POST',
            data: {
                action: action,
                q_change_value: q_change_value
            },
            success: function (data) {
                $('table#q_table tbody').html(data);
            }
        });
    })
    $(document).on('click', 'input[name="button_scribe"]', function (event) {

        event.preventDefault();

        let check = true;

        for (let i = 0; i < input.length; i++) {

            if ($(input[i]).val().trim() === '') {

                showValidate(input[i]);

                check = false;
            } else {

                hideValidate(input[i]);

                check = true;
            }
        }

        if (check == true) {

            let regExp_name = /^[a-zA-Z0-9 ]{5,40}$/,

                regExp_email = /^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/,

                user_scribe = $('input[name="name_scribe"]'),

                email_scribe = $('input[name="email_scribe"]');

            if (!regExp_name.test($(user_scribe).val())) {

                $(user_scribe).parent().attr('data-validate', 'Valid Name Is Required');

                showValidate(user_scribe);
            } else if (!regExp_email.test($(email_scribe).val())) {

                $(email_scribe).parent().attr('data-validate', 'Valid Email Is Required');

                showValidate(email_scribe);
            } else {

                hideValidate(user_scribe);

                hideValidate(email_scribe);

                user_scribe = $(user_scribe).val();

                email_scribe = $(email_scribe).val();

                let action = 'sendScribe';

                $.ajax({
                    url: 'Assets/connect/subscribeNow.php',
                    method: 'POST',
                    data: {
                        action: action,
                        user_scribe: user_scribe,
                        email_scribe: email_scribe
                    },
                    beforeSend: function () {
                        $('.button_scribe .tooltip_course').text('Waiting ...');
                    },
                    success: function (data) {

                        if (data == '') {

                            $('.button_scribe .tooltip_course').text('E-mail Already found');
                        } else {

                            $('.button_scribe .tooltip_course').text(data);

                            $('input[name="name_scribe"]').val('');

                            $('input[name="email_scribe"]').val('');
                        }
                    }
                });
            }

        }

    });


});


function fetch_rating() {

    let action = 'fetch_rating',

        course_id = $('div.rate').attr('data-course');

    $.ajax({
        url: 'Assets/connect/fetch_rating.php',
        method: 'POST',
        dataType: 'JSON',
        data: {
            action: action,
            course_id: course_id
        },
        success: function (data) {

            if (data.notLogin == '') {

                $('h5.number_rating').text(data.number_rating);
            } else {
                $('div.rate-bg').css('width', data.width_rating);

                $('span.rating_user').text(data.rating_user);

                $('h5.number_rating').text(data.number_rating);
            }
        }
    });

}


function notification_insert(view = '') {

    var action = 'notification_fetch';
    $.ajax({
        url: 'Assets/connect/notification.php',
        method: 'POST',
        data: {
            action: action,
            view: view
        },
        dataType: 'JSON',
        success: function (data) {

            $('.notify_view').html(data.notification);

            if (data.unseen_notification > 0) {

                $('span.dot').html(data.unseen_notification);

                $('.notify .blink').css('display', 'block');
            }
        }
    });
};