<?php


	function sum_time($times){
		$mins = 0;
		foreach($times as $time){
			list($hour, $min) = explode(':',$time);
			$mins += $hour * 60;
			$mins += $min;
		}

		$hours = floor($mins /60);
		$mins -= $hours * 60;

		return sprintf('%02dm:%02ds',$hours,$mins);
	};


	function query_sum_lessons($conn,$id){

		$query_course = 'select * from videos_files where course_id = ? and video_file_type = "video" ';

		$stmt_course = $conn->prepare($query_course);

		$execute_course = array($id);

		$stmt_course->execute($execute_course);

		$rowCount_course = $stmt_course->rowCount();

		return $rowCount_course;
	}

	function rating($conn,$id){

		$query = 'select * from courses_rating where course_id = ?';

		$stmt = $conn->prepare($query);

		$execute = array($id);

		$stmt->execute($execute);

		$rowCount = $stmt->rowCount();

		if($rowCount == 0){

			return '0' . ' Review(s)';
		}
		else{

			return $rowCount . ' Review(s)';
		}
		
	}

	function total_visitors($conn,$x){

		$query_check = 'select * from visitors_number where course_id = "'.$x.'"'; 

		$stmt_check = $conn->prepare($query_check);

		$stmt_check->execute();

		$rowCount_check = $stmt_check->rowCount();

		$rowCount_fetch = '';

		if($rowCount_check > 0){

			$rowCount_fetch .= $rowCount_check;
		}
		else{

			$rowCount_fetch .= 1;
		}

		return $rowCount_fetch;
	}

	require_once("connected.php");

	require_once("pagination.class.php");

	$perPage = new PerPage();

	$sql = "SELECT * from courses order by course_id";

	$paginationlink = "Assets/connect/fetchCourses.php?page=";	

	$pagination_setting = '';
				
	$page = 1;

	if(!empty($_GET["page"])) {

		$page = $_GET["page"];
	}

	$start = ($page-1) * $perPage->perpage;

	if($start < 0) $start = 0;

	$query_fetch =  $sql . " limit " . $start . "," . $perPage->perpage; 

	$output = '';

	$stmt_fetch = $conn->prepare($query_fetch);

	$stmt_fetch->execute();

	$rowCount_fetch = $stmt_fetch->rowCount();

	$result_fetch = $stmt_fetch->fetchAll();


	/********* Courses Count ***********/

	$query_count = 'select * from courses order by course_id';

	$stmt_count = $conn->prepare($query_count);

	$stmt_count->execute();

	$rowCount_count = $stmt_count->rowCount();

	if(empty($_GET["rowcount"])) {

		$_GET["rowcount"] = $rowCount_count;
	}

	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	

	$output .= '<input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />';

	if($rowCount_count > 0){
		
		foreach($result_fetch as $value_fetch){

            $array = [];
            
			$query_sum = 'select * from videos_files where course_id = "'.$value_fetch['course_id'].'" and video_file_type = "video" ';

                        $stmt_sum  = $conn->prepare($query_sum);

                        $stmt_sum->execute();

                        $result_sum = $stmt_sum->fetchAll();
                        
                        foreach($result_sum as $value_video){

                            array_push($array,$value_video['video_duration']);
                        };

		$output .= '<div class="col-lg-6 col-xl-4 col-12 ">
						<div class="courses-wrapper text-center mb-30">
							<div class="courses-img">
								<img src="courses_content/course_images/'.$value_fetch['course_title'].'/'.$value_fetch['course_image'].'" alt="course_image">
							</div>
							<div class="courses-text">
								<h4><a href="single-course.php?id='.convert_id('encrypt',$value_fetch['course_id']) .'">'.$value_fetch['course_title'].'</a></h4>

								<div class="feedback">
									<span class="star d-inline-block">
										<span class="yes"><i class="fa fa-star"></i></span>
										<span class="yes"><i class="fa fa-star"></i></span>
										<span class="yes"><i class="fa fa-star"></i></span>
										<span class="yes"><i class="fa fa-star"></i></span>
										<span class="yes"><i class="fa fa-star-half-o"></i></span>
									</span>
									<span>'.rating($conn,$value_fetch['course_id']).'</span>
								</div>

								<div class="course-meta">
									<span><i class="fa fa-bookmark"></i>'.query_sum_lessons($conn,$value_fetch['course_id']).' Lesson</span>
									<span><i class="fa fa-clock-o"></i>'.sum_time($array).'</span>
									<span><i class="fa fa-users"></i>'.total_visitors($conn,$value_fetch['course_id']).'</span>
								</div>

							</div>
						</div>
					</div>';
				}
			} 
			else{
				$output .= '<div class="no_course text-center w-100">No Courses Yet Added</div>';
			}
	
	if(!empty($perpageresult)) {

		$output .= '<div id="pagination">' . $perpageresult . '</div>';
	}
	
	echo $output;
?>
