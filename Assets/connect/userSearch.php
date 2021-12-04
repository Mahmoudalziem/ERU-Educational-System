<?php


require_once 'connected.php';

    function Validate($userName)
    {
        $output = trim($userName);

        $output = htmlspecialchars($output);

        $output = stripcslashes($output);

        $output = filter_var($output, FILTER_SANITIZE_STRING);

        return $output;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'fetchUser') {
                $userName = $_POST['userName'];

                $userName = Validate($userName);

                class fetchUser
                {

                    // prob

                    public $username = 0;

                    //Methods

                    public function fetchImage($x)
                    {
                        return $x['avater_image'] != null ? "images_users/avaters/" . $x['username'] . '/' . $x['avater_image'] : "Assets/images/profiles/default_avater/default_avater.png";
                    }

                    public function showStatus($conn, $username)
                    {
                        $query = 'select status from users where username = ? and (actived = 1 or 0)';

                        $stmt = $conn->prepare($query);


                        $stmt->execute(array($username));

                        $fetch = $stmt->fetch();
                                    
                        if ($fetch['status'] == 'user') {
                            return 'make';
                        } else {
                            return 'remove';
                        }
                    }
                    public function show($conn, $x)
                    {
                        if ($this->showStatus($conn, $x) == 'make') {
                            return 'Do';
                        } else {
                            return 'Undo';
                        }
                    }

                    public function fetch_user($conn)
                    {
                        $query_search = 'select username,name,avater_image,email from profile where username like :username ';

                        $stmt_search = $conn->prepare($query_search);

                        $source_search = ['username' => '%'. $this->username . '%'];

                        $stmt_search->execute($source_search);

                        $fetchAll = $stmt_search->fetchAll();

                        $rowCount = $stmt_search->rowCount();

                        if ($this->username != '') {
                            if ($rowCount > 0) {
                                foreach ($fetchAll as $user) {
                                    echo '<div class="col-xl-4 col-md-6 col-12">
                                            <div class="details_fetch_user position-relative">
                                                <div class="user_info d-md-flex">
                                                    <div class="user_image mx-md-3 mx-auto mb-sm-4 mb-md-0">
                                                        <img src="'.$this->fetchImage($user).'" alt="' . $user['username'] . '">
                                                    </div>  
                                                    <div class="user_details text-md-left text-center">
                                                        <h3 class="name">' . $user['name'] . '</h3>
                                                        <p class="username">@ ' . $user["username"] . '</p>
                                                        <p class="username text-center">'.$user['email']. '</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="button_option">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </div>
                                                
                                                <ul class="option_select w-100 position-absolute" data-user="'.convert_string('encrypt', $user['username']).'">
                                                    <li class="'.$this->showStatus($conn, $user['username']).'_mod">'.$this->show($conn, $user['username']).' Moderator</li>
                                                    <li class="delete_user">Delete User</li>
                                                </ul>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo '<div class="not_found col-9">User Not Found</div>';
                            }
                        } else {
                            $query = 'select username,name,avater_image,email from profile where username != "" order by ID';

                            $fetch = $conn->prepare($query);

                            $fetch->execute();

                            $fetchAll = $fetch->fetchAll();

                            $rowCount = $fetch->rowCount();

                            if ($rowCount > 0) {
                                foreach ($fetchAll as $value) {
                                    echo '<div class="col-xl-4 col-md-6 col-12">
                                        <div class="details_fetch_user position-relative">
                                            <div class="user_info d-md-flex">
                                                <div class="user_image mx-md-3 mx-auto mb-sm-4 mb-md-0">
                                                    <img src="'.$this->fetchImage($value).'" alt="' . $value['username'] . '">
                                                </div>  
                                                <div class="user_details text-md-left text-center">
                                                    <h3 class="name">' . $value['name'] . '</h3>
                                                    <p class="username">@ ' . $value["username"] . '</p>
                                                    <p class="username text-center">'.$value['email']. '</p>
                                                </div>
                                            </div>
                                            
                                            <div class="button_option">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                            
                                            <ul class="option_select w-100 position-absolute" data-user="'.convert_string('encrypt', $value['username']).'">
                                                <li class="'.$this->showStatus($conn, $value['username']).'_mod">'.$this->show($conn, $value['username']).' Moderator</li>  
                                                <li class="delete_user">Delete User</li>
                                            </ul>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<div class="not_found col-9">No Users Not Found</div>';
                            }
                        }
                    }
                }// class


                $fetch_search = new fetchUser();

                $fetch_search->username = $userName;

                echo $fetch_search->fetch_user($conn);
            }
        }
    }
