/*==============================================
/* ========= Avoid 'console' errors ============
/*==============================================*/

var method;

var noop = function () {};

var methods = [
    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
    'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
];

var length = methods.length;

var console = (window.console = window.console || {});

while (length--) {

    method = methods[length];

    // Only stub undefined methods.

    if (!console[method]) {

        console[method] = noop;
    }
}

/*===================================
/* { 01 } => Home Slider Carousel
/*===================================*/

function home_slider() {
    $('#home-slider').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 0,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        slideSpeed: 800,
        smartSpeed: 500,
        dots: true,
        items: 1,
        responsive: {
            0: {
                items: 1,
            },
            500: {
                items: 1,
            },
            900: {
                items: 1,
            }
        }
    });
};


function testmonials() {
    $('#owl-testmonials').owlCarousel({
        loop: true,
        autoplay: true,
        nav: false,
        slideSpeed: 800,
        smartSpeed: 500,
        dots: true,
        items: 1,
        responsive: {
            0: {
                items: 1,
            },
            500: {
                items: 1,
            },
            900: {
                items: 1,
            }
        }
    });
};
/*=====================================
/*============= FancyBox ==============
/*===================================== */

function fancybox() {

    $('[data-fancybox]').fancybox({
        youtube: {
            controls: 1,
            showinfo: 0
        },

        protect: true,

        vimeo: {
            color: 'f00'
        },

        spinnerTpl: '<div class="fancybox-loading"></div>',
    });
}

/*=====================================
/*============= NiceScroll ============
/*===================================== */

function nicescroll() {

    if ($(window).width() > 768) {

        $('html').niceScroll({
            zindex: 13253252,
            cursorborder: 0,
            background: "white",
            cursorcolor: "#3b3e79",
            cursorwidth: "10px",
            border: 0,
            overflowX: 'hidden',
            cursorborderradius: 0,
        });
    } else {

        $('html').niceScroll({
            zindex: 13253252,
            cursorborder: 0,
            background: "white",
            cursorcolor: "gray",
            cursorwidth: "5px",
            border: 0,
            overflowX: 'hidden',
            cursorborderradius: 0,
        });
    }

}

function dropdown() {
    $('.notification-site-content ul li.dropdown-body').niceScroll({
        zindex: 13253252,
        cursorborder: "0px",
        background: "white",
        cursorcolor: "#45487d",
        cursorwidth: "10px",
        border: 0,
        overflowX: 'hidden',
        cursorborderradius: "0px",
    });
};

dropdown();

function search() {
    $('ul.courses_search_content').niceScroll({
        zindex: 13253252,
        cursorborder: "0px",
        background: "#45487d",
        cursorcolor: "#fff",
        cursorwidth: "10px",
        border: 0,
        overflowX: 'hidden',
        cursorborderradius: "0px",
    });
};

search();

/*=====================================
/*============= Preloader ============
/*===================================== */

$(window).on('load', function () {

    $('.preloader').fadeOut(300);

});

/*=====================================
/*============= MatchHeight ============
/*===================================== */

function matchHeight() {
    $('.item,.courses-text h4').matchHeight();

}


/*=====================================
/*============= CounterUp ============
/*===================================== */
function counter() {
    $('.counter').counterUp({
        delay: 10,
        time: 1000,
        offset: 70,
    });
};

/*=====================================
/*============= textEditor ============
/*===================================== */

function textEditor() {

    $("#txtEditor").Editor();


    $("#txtEditor").Editor('setText', $('#txtEditor').val());
};


/*=====================================
/*============= ButtonClick ==========
/*===================================== */


$('i.search-button').on('click', function () {

    $(this).siblings('div.col-12').toggleClass('show');

    $('form[name="form_search"] .token').remove();

    $('.courses_search_content').children().remove();

});

$('.search_content_phone>i').click(function () {

    $(this).siblings('.form-search').toggleClass('show');

    $('form[name="form_search"] .token').remove();

    $('.courses_search_content').children().remove();

});

$('.navbar-header .menu-left .menu-left-dropdown').on('click', function () {

    $('.navbar-header .menu-left .column').toggleClass('show');

});
$('.site-enter .site-enter-button>i').on('click', function () {

    $('.site-enter-button .column').toggleClass('show');

});



$('.notification-site>.notification-display').on('click', function () {

    $(this).siblings('div').toggleClass('show');

});

$('.notification-site>.avater-display').on('click', function () {

    $(this).siblings('div').toggleClass('show');
});

$('.content-show a.notification-display').on('click', function () {

    $('.site-notification .column1').toggleClass('show');
});

$('.site-enter1 .avater-display1').on('click', function () {

    $('.site-notification .column2').toggleClass('show');
});



/*==================================================================

[ Focus input ]*/

$('.input_100').each(function () {

    $(this).on('blur', function () {

        if ($(this).val().trim() !== "") {

            $(this).addClass('has-val');
        } else {
            $(this).removeClass('has-val');
        }
    })
});


/*==================================================================
[ Validate ]*/

let input = $('div .input_100');

$(input).each(function () {

    $(this).focus(function () {

        hideValidate(this);

    });
});

function showValidate(input) {

    let thisAlert = $(input).parent();

    $(thisAlert).addClass('alert-validate');
};

function hideValidate(input) {

    let thisAlert = $(input).parent();

    $(thisAlert).removeClass('alert-validate');
}

$($('.panel_header').parent()).on('click', function () {

    if ($(this).attr('aria-expanded', 'true')) {

        $(this).children('.panel_header').children('i').toggleClass('fa-arrow-down');
    }




});

$(document).on('scroll', function () {

    if ($(this).scrollTop() > 500) {
        $('.avater-info-content-left').css({
            position: 'fixed',
            top: '90px',
            width: '19%',
            transition: 'position .3s ease-in-out',
        });
    } else {
        $('.avater-info-content-left').css({
            position: 'relative',
            top: '0',
            width: 'auto',
        })
    }

});

$('button.learn_section_button , button.require_section_button').on('click', function (event) {

    event.preventDefault();

    if ($(this).hasClass('learn_section_button')) {

        if ($(this).siblings('div.goal_form_course_content_learn').length) {

            if ($(this).siblings('div.goal_form_course_content_learn:last').children('div.input-group').children('input[type="text"]').val() != '') {

                $(this).siblings('div.goal_form_course_content_learn:last').after($(this).parent().siblings('div.goal_form_course_content_learn').clone().removeClass('display_none').addClass('learn_tabs'));


            }

            $('html').getNiceScroll().resize();
        } else {

            $(this).siblings('label').after($(this).parent().siblings('div.goal_form_course_content_learn').clone().removeClass('display_none').addClass('learn_tabs'));
        }
    } else if ($(this).hasClass('require_section_button')) {

        if ($(this).siblings('div.goal_form_course_content_require').length) {

            if ($(this).siblings('div.goal_form_course_content_require:last').children('div.input-group').children('input[type="text"]').val() != '') {

                $(this).siblings('div.goal_form_course_content_require:last').after($(this).parent().siblings('div.goal_form_course_content_require').clone().removeClass('display_none').addClass('require_tabs'));

            }

            $('html').getNiceScroll().resize();
        } else {

            $(this).siblings('label').after($(this).parent().siblings('div.goal_form_course_content_require').clone().removeClass('display_none').addClass('require_tabs'));
        }
    }

});

$(document).on('click', 'button[for="button_delete_input"]', function () {

    $(this).parents('div.goal_form_course_content').remove();
});

$(document).on('click', 'button.add_video_course,button.add_file_course', function () {

    if ($(this).hasClass('add_video_course')) {

        $('div#add_video_modal').attr('data-number', $(this).parents('.section_content').data('number'));
    } else if ($(this).hasClass('add_file_course')) {

        $('div#add_article_modal').attr('data-number', $(this).parents('.section_content').data('number'));
    }


});

let count = 0;

let count_tr = 1;

$(document).on('click', 'button.add_video_course,button.add_file_course,button.add_section', function () {

    if ($(this).hasClass('add_video_course')) {

        $('input[name="video_title"]').val('');

        $('input[name="video_url"]').val('');

        $('div#add_video_modal .modal-header h3').text('Add Video');

        let data_section = $(this).parents('.content_video_article').siblings('.section_content_header').children('.section_name').children('.section_name_content').children('.section_span').text();

        $('form.add_video').attr('data-section', data_section);

        $('input[name="add_video_course"]').val('Add Video');

        $('form.add_video .error').addClass('display_none').removeClass('display_block');


    } else if ($(this).hasClass('add_file_course')) {

        $('input[name="fileName"]').val('');

        $('input[class="input_readonly_file"]').val('No File Selected');

        $('input#upload_file_input').val('');

        let data_section = $(this).parents('.content_video_article').siblings('.section_content_header').children('.section_name').children('.section_name_content').children('.section_span').text();

        $('form.add_file_form').attr('data-section', data_section);

        $('div#add_article_modal .modal-header h3').text('Add File');

        $('input[name="add_file_form"]').val('Add File');

        $('form.add_file_form .error').addClass('display_none').removeClass('display_block');
    } else if ($(this).hasClass('add_section')) {

        $('form.add_section_form input:not(input[type="submit"])').val('');

        $('div#add_section_form .modal-header h3').text('Add Section');

        $('input[name="add_section"]').val('Add && Save');

        $('form.add_section_form .error').addClass('display_none').removeClass('display_block');
    }
});

/********* Add Videos To Course ******/

$(document).on('click', 'input[name="add_video_course"]', function (event) {

    event.preventDefault();

    let video_title = $('input[name="video_title"]').val(),

        video_url = $('input[name="video_url"]').val(),

        data_section = $(this).parents('.add_video').attr('data-section');

    if (video_title == '' || video_url == '') {

        $('form.add_video .error').html('Both Fields Are Required').addClass('display_block').removeClass('display_none');
    } else {



        if (!RegExp(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/).test(video_url)) {

            $('form.add_video .error').html('Please Enter Valid Url').addClass('display_block').removeClass('display_none');
        } else if ($(this).val() == 'Add Video') {

            let count1 = $('table.table_content_video_file tbody tr:last').attr('data-id');

            if (count1 == undefined) {

                count1 = 1;
            } else {
                count1 = eval(count1) + 1;
            }

            count = count + 1;

            $('form.add_video .error').html('').addClass('display_none').removeClass('display_block');

            $('form.add_video input:not(input[type="submit"])').val('');

            $('div#add_video_modal').modal('hide');

            let video_details = '';

            video_details += '<tr  id="row_' + count1 + '" class="video_tr" data-id="' + count1 + '">';

            video_details += '<td data-reponsive-text="filename" id="video_title_' + count1 + '" class="video_title">' + video_title + '</td>';

            video_details += '<input type="hidden" value="' + video_url + '" name="content_video_input" class="video_file video_file_section_' + count_tr + '" id="video_url_' + count1 + '" data-section="' + data_section + '">';

            video_details += '<td data-reponsive-text="type">Video</td>';

            video_details += '<td data-reponsive-text="date" id="date_video_' + count1 + '" class="date_video">' + new Date().toLocaleDateString() + '</td>';

            video_details += '<td data-reponsive-text="edit">\n' +
                '<div class="d-flex edit_content_table">\n' +
                '   <div class="edit_video" id="' + count1 + '">\n' +
                '      <span>\n' +
                '          <i class="fa fa-pencil"></i>\n' +
                '      </span>\n' +
                '   </div>\n' +
                '   <div class="delete_field">\n' +
                '     <span>\n' +
                '         <i class="fa fa-trash-o"></i>\n' +
                '     </span>\n' +
                '   </div>\n' +
                '</div>\n' +
                '</td>';
            video_details += '<\\tr>';

            let number_table = $(this).parents('#add_video_modal').attr('data-number');

            $('div.section_content').each(function () {

                if ($(this).attr('data-number') === number_table) {

                    $(this).data('number', '' + number_table + '').children('div.content_video_article').children().children('table').children('tbody').append(video_details);
                };

            });
            $('html').getNiceScroll().resize();
        } else if ($(this).val() == 'Edit Video') {

            var id = $(this).parents('.add_video').attr('id');

            let video_edit_title = $('input[name="video_title"]').val(),

                video_edit_url = $('input[name="video_url"]').val();

            $('tr#row_' + id + '').children('td:first').text(video_edit_title);

            $('tr#row_' + id + '').children('input[name="content_video_input"]').val(video_edit_url);

            $('#date_video_' + id + '').text(new Date().toLocaleDateString());

            $('div#add_video_modal').modal('hide');

        }
    }
});

/********* Edit Video To course ******/

$(document).on('click', 'div.edit_video,div.edit_file,div.edit_section', function () {

    var id = $(this).attr('id');

    if ($(this).hasClass('edit_video')) {

        let video_title = $('#video_title_' + id + '').text(),

            video_url = $('#video_url_' + id + '').val();

        $('input[name="video_title"]').val(video_title);

        $('input[name="video_url"]').val(video_url);

        $('div#add_video_modal .modal-header h3').text('Edit Video');

        $('input[name="add_video_course"]').val('Edit Video');

        $('form.add_video .error').addClass('display_none').removeClass('display_block');

        $('form.add_video').attr('id', id);

        $('div#add_video_modal').modal('show');
    } else if ($(this).hasClass('edit_file')) {

        let file_title = $('#file_title_' + id + '').text(),

            file_content = $('#file_content_' + id + '').val();

        $('form.add_file_form').attr('id', id);

        $('input[name="fileName"]').val(file_title);

        $('input[class="input_readonly_file"]').val(file_content);

        $('div#add_article_modal .modal-header h3').text('Edit File');

        $('input[name="add_file_form"]').val('Edit File');

        //$('input#upload_file_input').val(file_content);

        $('form.add_file_form .error').addClass('display_none').removeClass('display_block');

        $('form.add_file_form').attr('id', id);

        $('div#add_article_modal').modal('show');
    } else if ($(this).hasClass('edit_section')) {

        $('form.add_section_form').attr('id', id);

        let section_name = $('span.section_edit_' + id + '').text();

        $('div#add_section_form .modal-header h3').text('Edit Section');

        $('input[name="add_section"]').val('Edit && Save');

        $('form.add_section_form .error').addClass('display_none').removeClass('display_block');

        $('input[name="section_name"]').val(section_name);

        $('div#add_section_form').modal('show');
    }

})

$('input[id="upload_file_input"]').change(function () {

    $('input[class="input_readonly_file"]').val($(this).val());

});

/********* Add Files To Course ******/

$(document).on('submit', 'form.add_file_form', function (event) {

    event.preventDefault();

    let file_title = $('input[name="fileName"]').val(),

        value_of_file = $('input[id="upload_file_input"]').val(),

        course_title = $('form.course_landing_page_form input[name="title"]').val(),

        data_section = $(this).attr('data-section');

    if (course_title == '') {

        $('form.add_file_form .error').html('Course Title Is Required').addClass('display_block').removeClass('display_none');

    } else if (file_title == '' || value_of_file == '') {

        $('form.add_file_form .error').html('Both Fields Are Required').addClass('display_block').removeClass('display_none');
    } else if ($('input[name="add_file_form"]').val() == 'Add File') {

        let formData = new FormData(this);

        formData.append('course_title', course_title);

        $.ajax({
            url: 'Assets/connect/extension_file.php',
            method: 'POST',
            dataType: 'JSON',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('form.add_file_form .error').html('Waiting ...').addClass('display_block').removeClass('display_none');
            },
            success: function (data) {

                if (data.ok == '') {

                    let count1 = $('table.table_content_video_file tbody tr:last').attr('data-id');

                    if (count1 == undefined) {

                        count1 = 1;
                    } else {
                        count1 = eval(count1) + 1;
                    }

                    $('form.add_file_form input:not(input[type="submit"],input[name="files"])').val('');

                    $('input[class="input_readonly_file"]').val('No File Selected');

                    $('form.add_file_form .error').html('').addClass('display_none').removeClass('display_block');

                    $('div#add_article_modal').modal('hide');

                    let file_content = '';

                    file_content += '<tr id="row_' + count1 + '" class="file_tr" data-id="' + count1 + '">';

                    file_content += '<td data-reponsive-text="filename" id="file_title_' + count1 + '" class="file_title">' + file_title + '</td>';

                    file_content += '<input type="hidden" value="' + data.path + '" id="file_content_' + count1 + '" name="content_file_input" class="video_file video_file_section_' + count_tr + '" data-section="' + data_section + '">';

                    file_content += '<td data-reponsive-text="type">file</td>';

                    file_content += '<td data-reponsive-text="date" id="data_file_' + count1 + '" class="date_file">' + new Date().toLocaleDateString() + '</td>';

                    file_content += '<td data-reponsive-text="edit">\n' +
                        '<div class="d-flex edit_content_table">\n' +
                        '   <div class="edit_file" id="' + count1 + '">\n' +
                        '      <span>\n' +
                        '          <i class="fa fa-pencil"></i>\n' +
                        '      </span>\n' +
                        '   </div>\n' +
                        '   <div class="delete_field">\n' +
                        '     <span>\n' +
                        '         <i class="fa fa-trash-o"></i>\n' +
                        '     </span>\n' +
                        '   </div>\n' +
                        '</div>\n' +
                        '</td>';
                    file_content += '<\\tr>';

                    let number_table = $('input[name="add_file_form"]').parents('#add_article_modal').attr('data-number');

                    $('div.section_content').each(function () {

                        if ($(this).attr('data-number') === number_table) {

                            $(this).data('number', '' + number_table + '').children('div.content_video_article').children().children('table').children('tbody').append(file_content);
                        };

                    });

                    $('html').getNiceScroll().resize();
                } else {
                    $('form.add_file_form .error').html(data.error).addClass('display_block').removeClass('display_none');
                }
            }
        });

    } else if ($('input[name="add_file_form"]').val() == 'Edit File') {

        let formData = new FormData(this);

        formData.append('course_title', course_title);

        $.ajax({
            url: 'Assets/connect/extension_file.php',
            method: 'POST',
            dataType: 'JSON',
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {

                if (data.ok == '') {

                    let id = $('input[name="add_file_form"]').parents('.add_file_form').attr('id'),

                        file_edit_title = $('input[name="fileName"]').val();

                    $('tr#row_' + id + '').children('td[data-reponsive-text="filename"]').text(file_edit_title);

                    $('tr#row_' + id + '').children('input[name="content_file_input"]').val(data.path);

                    $('#date_file_' + id + '').text(new Date().toLocaleDateString());

                    $('div#add_article_modal').modal('hide');


                    $('html').getNiceScroll().resize();
                } else {
                    $('form.add_file_form .error').html(data.error).addClass('display_block').removeClass('display_none');
                }
            }
        });
    }

});

/********* Add Sections To Course ******/

$(document).on('click', 'div.add_or_cancel input[type="submit"]', function (event) {

    event.preventDefault();

    let section_name = $('input[name="section_name"]').val();

    if (section_name == '') {

        $('form.add_section_form .error').html('Section Name Required').addClass('display_block').removeClass('display_none');
    } else if ($(this).val() == 'Add && Save') {

        count = count + 1;

        count_tr = count_tr + 1;

        if (count == 0) {

            count = 0;
        } else {
            count = count + 1;
        }
        let x = $('div.section_content:last').data('number');

        function xValue() {

            if (x == undefined) {

                x = 1;
            } else {

                ++x;
            }
            return x;
        };

        let content = '<div class="section_content" data-number="' + xValue() + '">\n' +
            '\n' +
            '                                        <div class="section_content_header">\n' +
            '                                            <div class="section_name">\n' +
            '                                                <span class="section_name_default">Section : </span>\n' +
            '                                                <span class="section_name_content">\n' +
            '                                                    <span><i class="fa fa-file-text-o"></i></span>\n' +
            '                                                    <span id="' + xValue() + '" class="section_span section_edit_' + count + '">' + section_name + '</span>\n' +
            '                                                </span>\n' +
            '                                            </div>\n' +
            '                                            <div class="section_edit d-flex">\n' +
            '                                                <div class="edit_section section_edit_' + count + '" id="' + count + '">\n' +
            '                                                    <span>\n' +
            '                                                        <i class="fa fa-pencil"></i>\n' +
            '                                                    </span>\n' +
            '                                                </div>\n' +
            '                                                <div class="delete_section">\n' +
            '                                                    <span>\n' +
            '                                                        <i class="fa fa-trash-o"></i>\n' +
            '                                                    </span>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '\n' +
            '                                        <div class="content_video_article">\n' +
            '                                            <div class="row">\n' +
            '                                                <table  class="table w-100 table_content table table-bordered table-sm table_content_video_file" style="border-collapse: separate; margin-top:30px; border:0">\n' +
            '                                                    <thead class="thead-dark">\n' +
            '                                                        <tr>\n' +
            '                                                           <th role="columnheader" scope="col">Filename</th>\n' +
            '                                                           <th role="columnheader" scope="col">Type</th>\n' +
            '                                                           <th role="columnheader" scope="col">Date</th>\n' +
            '                                                           <th role="columnheader" scope="col"></th>\n' +
            '                                                        </tr>\n' +
            '                                                    </thead>\n' +
            '                                                    <tbody></tbody>\n' +
            '                                                </table>\n' +
            '\n' +
            '                                                <div class="add_video_article mx-auto">\n' +
            '                                                    <button class="btn add_video_course" type="button" data-toggle="modal" data-target="#add_video_modal" role="button">Add Video</button>\n' +
            '                                                    <button class="btn add_file_course" type="button" data-toggle="modal" data-target="#add_article_modal" role="button">Add File</button>\n' +
            '                                                </div>\n' +
            '                                            </div><!-- End Row -->\n' +
            '                                        </div>\n' +
            '\n' +
            '                                    </div>';
        if ($('div.section_content:last').length) {

            $('div.section_content:last').after(content);

            $('div#add_section_form').modal('hide');

            $('input[name="section_name"]').val('');

            $('html').getNiceScroll().resize();

        } else {

            $('div.title_adding_course').siblings('.error').after(content);

            $('div#add_section_form').modal('hide');

            $('input[name="section_name"]').val('');

            $('html').getNiceScroll().resize();
        }

    } else if ($(this).val() == 'Edit && Save') {

        let id = $('form.add_section_form').attr('id'),

            section_edit_name = $('input[name="section_name"]').val();

        $('span.section_edit_' + id + '').text(section_edit_name);

        $('input.video_file_section_' + id + '').attr('data-section', section_edit_name);

        $('div#add_section_form').modal('hide');
    }

});

/********* Delete Details In Course ******/

$(document).on('click', 'div.delete_section , div.delete_field', function () {

    if ($(this).hasClass('delete_section')) {

        let section_name = $(this).parents('.section_content').attr('data-section_name'),

            action = 'delete_section';

        if ($('button.button_edit_course').hasAttribute = 'data-id') {

            $.ajax({
                url: 'Assets/connect/delete_section_field.php',
                method: 'POST',
                data: {
                    action: action,
                    section_name: section_name
                },
            });

            $(this).parents('.section_content').remove();
        } else {
            $(this).parents('.section_content').remove();
        }


    } else if ($(this).hasClass('delete_field')) {

        let id = $('button.button_edit_course').attr('data-id'),

            section_name = $(this).parents('.section_content').attr('data-section_name'),

            field_name = $(this).parents('.edit_content_table').parent().siblings('td[data-reponsive-text="filename"]').text(),

            action = 'delete_field';

        if ($('button.button_edit_course').hasAttribute = 'data-id') {

            $.ajax({
                url: 'Assets/connect/delete_section_field.php',
                method: 'POST',
                data: {
                    action: action,
                    id: id,
                    section_name: section_name,
                    field_name: field_name
                },
            });

            $(this).parents('tr').remove();
        } else {
            $(this).parents('tr').remove();
        }



    }
});

$(document).on('mouseenter', 'div.rate-btn', function () {

    $('.rate-btn').removeClass('rate-btn-hover');

    var therate = $(this).attr('id');

    for (var i = therate; i >= 0; i--) {

        $('.btn-' + i).addClass('rate-btn-hover');
    };

});

$(document).on('click', 'div.rate-btn', function () {

    var therate = $(this).attr('id');

    $('.rate-btn').removeClass('rate-btn-active');

    for (var i = therate; i >= 0; i--) {

        $('.btn-' + i).addClass('rate-btn-active');

    };
});

$(window).on('scroll', function () {

    $('html').getNiceScroll().resize();

});

$('select[name="depart_name_notify"]').change(function () {

    var id = $(this).val(),

        action = 'fetch_semester';

    $('select[name="depart_name_notify"]').val(id);

    if (id === '-- Select Depart --') {

        $('select[name="semester_name_alter"]').html('<option value="-- Select Semester --">-- Select Semester --</option>');
    } else {
        $.ajax({
            url: 'Assets/connect/fetch_semester.php',
            method: 'POST',
            data: {
                action: action,
                id: id
            },
            success: function (data) {
                $('select[name="semester_name_alter"]').html(data);
            }
        });
    }
});

$(document).on('click', 'a.edit_notfication', function () {

    $('div.fetch_notification').toggleClass('active');
});

$(document).on('submit', 'form[name="form_search"]', function (event) {

    event.preventDefault();

});