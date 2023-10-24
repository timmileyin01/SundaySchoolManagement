<?php

include(base_app . "database/db.php");
include(base_app . "helpers/validateUser.php");

$errors = array();

$surname = "";
$firstname = "";
$email = "";
$othernames = "";
$admin = "";
$gender = "";
$denomination = "";
$phone_number = "";
$password = "";
$passwordConf = "";

$table = 'users';


if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    $id = $user['id'];
    $_SESSION['use_id'] = $id;
    $surname = $user['surname'];
    $firstname = $user['firstname'];
    $email = $user['email'];
    $othernames = $user['othernames'];
    $admin = $user['admin'];
    $gender = $user['gender'];

    $id_number = $user['id_number'];
}


if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];


    $user = selectOne($table, ['id' => $id]);

    $image = $user['avatar'];
    $path = (base_app . 'uploads/') . $image;

    $count = delete($table, $id);

    if (file_exists($path)) {
        unlink($path);

        $_SESSION['message'] = 'User Deleted successfully';
        $_SESSION['type'] = 'success';


        header("location: " . './manage-users.php');
        exit();
    } else {
        $_SESSION['message'] = 'User not Deleted';
        $_SESSION['type'] = 'error';


        header("location: " . './manage-users.php');
        exit();
    }
}



function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['unique_id'] = $user['unique_id'];

    if ($user['admin'] == 'repo_super_admin') {
        $_SESSION['admin'] = 'church_super_admin';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './admin/');

        exit();
    } elseif ($user['admin'] == 'church_teacher') {
        $_SESSION['admin'] = 'church_teacher';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './admin/');

        exit();
    } elseif ($user['admin'] == 'church_member') {
        $_SESSION['admin'] = 'church_member';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'success';


        header('location: ' . './index');

        exit();
    }
}

if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['id_number' => $_POST['id_number']]);


        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        } else {
            array_push($errors, 'wrong credentials');
        }
    }

    $id_number = $_POST['id_number'];
    $password = $_POST['password'];
}








if (isset($_POST['register'])) {
    if (isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])) {

        $errors = validateRegister($_POST);

        if (count($errors) === 0) {
            $user_number = $_POST['phone_number'];
            $verify =  selectOne('users', ['phone_number' => $user_number]);


            $_POST['admin'] = urlSaveDecode($_POST['admin']);


            //if the validation of the inputs is error free
            if ($verify && empty($verify['email'])) {
                //if the user has his or her number on the database but have not registered
                $formIndex = 'avatar';


                $filetype = ['jpg', 'png', 'webp', 'jpeg'];


                //$file_s = selectOne('settings', ['id' => 1]);
                // $filesize = $file_s['max_upload'];
                $filesize = 1000000;


                if (!empty($_FILES['avatar']['name'])) {
                    $file_name = time() . '_' . $_FILES['avatar']['name'];
                    $destination = "./admin/uploads/" . $file_name;
                    $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
                    if (count($errors) == 0) {



                        $id = $verify['id'];

                        $post = selectOne($table, ['id' => $id]);

                       

                        $_POST['avatar'] = $file_name;

                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                        $_POST['unique_id'] = bin2hex(random_bytes(16));

                        unset($_POST['register'], $_POST['passwordConf'], $_POST['csrf_token']);


                       
                            $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
                            if ($result) {


                                $user_id = update($table, $id, $_POST);



                                $login = selectOne($table, ['id' => $id]);
                                loginUser($login);
                            } else {
                                array_push($errors, "Failed to Upload Image");
                                $surname = $_POST['surname'];
                                $firstname = $_POST['firstname'];
                                $email = $_POST['email'];
                                $othernames = $_POST['othernames'];
                                $gender = $_POST['gender'];
                                $denomination = $_POST['denomination'];
                                $phone_number = $_POST['phone_number'];
                                $password = $_POST['password'];
                                $passwordConf = $_POST['passwordConf'];
                            }
                        
                    }
                } else {
                    array_push($errors, "Image Required");
                    $surname = $_POST['surname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $othernames = $_POST['othernames'];
                    $gender = $_POST['gender'];
                    $denomination = $_POST['denomination'];
                    $phone_number = $_POST['phone_number'];
                    $password = $_POST['password'];
                    $passwordConf = $_POST['passwordConf'];
                }
            } elseif ($verify && !empty($verify['email'])) {
                array_push($errors, "You have already Registered");
                $surname = $_POST['surname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $othernames = $_POST['othernames'];
                $gender = $_POST['gender'];
                $denomination = $_POST['denomination'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $passwordConf = $_POST['passwordConf'];
            } else {
                array_push($errors, "You are not allowed to Register");
                $surname = $_POST['surname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $othernames = $_POST['othernames'];
                $gender = $_POST['gender'];
                $denomination = $_POST['denomination'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $passwordConf = $_POST['passwordConf'];
            }
        } else {
            $surname = $_POST['surname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $othernames = $_POST['othernames'];
            $gender = $_POST['gender'];
            $denomination = $_POST['denomination'];
            $phone_number = $_POST['phone_number'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
    } else {
        array_push($errors, 'Invalid Form Sent, Reload Form');
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $othernames = $_POST['othernames'];
        $gender = $_POST['gender'];
        $denomination = $_POST['denomination'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}






if (isset($_POST['add-user'])) {
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    $errors = validateUser($_POST);

    $formIndex = 'avatar';


    $filetype = ['jpg', 'png', 'webp', 'jpeg'];


    $file_s = selectOne('settings', ['id' => 1]);
    $filesize = $file_s['max_upload'];










    if (count($errors) === 0) {


        unset($_POST['add-user'], $_POST['passwordConf']);

        if (!empty($_FILES['avatar']['name'])) {
            $file_name = time() . '_' . $_FILES['avatar']['name'];
            $destination = base_app . "uploads/" . $file_name;
            $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
            if (count($errors) == 0) {
                $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);

                if ($result) {
                    $_POST['avatar'] = $file_name;
                } else {
                    array_push($errors, "Failed to Upload Image");
                }
            }
        } else {
            array_push($errors, "Image Required");
        }

        $password_hash = $_POST['password'];
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($_POST['admin'] == 1) {
            $_POST['admin'] = 'repo_user';
        } elseif ($_POST['admin'] == 2) {
            $_POST['admin'] = 'repo_admin';
        } elseif ($_POST['admin'] == 3) {
            $_POST['admin'] = 'repo_super_admin';
        }

        $user_id = create($table, $_POST);

        $_SESSION['message'] = 'User Created successfully';
        $_SESSION['type'] = 'success';


        header("location: " . './manage-users.php');
        exit();
    } else {
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $othernames = $_POST['othernames'];
        if ($_POST['admin'] == 1) {
            $_POST['admin'] = 'repo_user';
        } elseif ($_POST['admin'] == 2) {
            $_POST['admin'] = 'repo_admin';
        } elseif ($_POST['admin'] == 3) {
            $_POST['admin'] = 'repo_super_admin';
        }
        $admin = $_POST['admin'];
        $gender = $_POST['gender'];

        $id_number = $_POST['id_number'];
        $password = $password1;
        $passwordConf = $password1_hash;
    }
}

if (isset($_POST['add-matric'])) {

    $matric = $_POST['id_number'];
    $user = selectOne($table, ['id_number' => $matric]);
    unset($_POST['add-matric']);

    if (!$matric) {
        array_push($errors, "You need to put a Matric ID");
    } elseif ($user) {
        array_push($errors, "User Exists");
    } else {
        $user_id = create($table, $_POST);

        $_SESSION['message'] = 'Matric Added successfully';
        $_SESSION['type'] = 'success';
    }
}







if (isset($_POST['edit-user'])) {
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    $id = $_SESSION['use_id'];

    $errors = validateUserUpdate($_POST);
    unset($_POST['update-user'], $_POST['id'], $_POST['passwordConf']);


    $formIndex = 'avatar';


    $filetype = ['jpg', 'png', 'webp', 'jpeg'];


    $file_s = selectOne('settings', ['id' => 1]);
    $filesize = $file_s['max_upload'];





    if (count($errors) === 0) {


        unset($_POST['edit-user'], $_POST['passwordConf']);

        if (!empty($_FILES['avatar']['name'])) {
            $file_name = time() . '_' . $_FILES['avatar']['name'];
            $destination = base_app . "uploads/" . $file_name;
            $errors = validateFile($_FILES, $formIndex, $filetype, $filesize);
            if (count($errors) == 0) {
                $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);

                if ($result) {
                    $_POST['avatar'] = $file_name;
                } else {
                    array_push($errors, "Failed to Upload Image");
                }
            }
        } else {
            array_push($errors, "Image Required");
        }

        $password_hash = $_POST['password'];
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($_POST['admin'] == 1) {
            $_POST['admin'] = 'repo_user';
        } elseif ($_POST['admin'] == 2) {
            $_POST['admin'] = 'repo_admin';
        }

        $post = selectOne($table, ['id' => $id]);

        $file1 = $post['avatar'];
        $path1 = (base_app . 'uploads/') . $file1;


        if (file_exists($path1)) {
            unlink($path1);
        }

        $user_id = update($table, $id, $_POST);

        unset($_SESSION['use_id']);

        $_SESSION['message'] = 'User Updated successfully';
        $_SESSION['type'] = 'success';


        header("location: " . './manage-users.php');
        exit();
    } else {
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $othernames = $_POST['othernames'];
        if ($_POST['admin'] == 1) {
            $_POST['admin'] = 'repo_user';
        } elseif ($_POST['admin'] == 2) {
            $_POST['admin'] = 'repo_admin';
        }
        $admin = $_POST['admin'];
        $gender = $_POST['gender'];

        $id_number = $_POST['id_number'];
        $password = $password1;
        $passwordConf = $password1_hash;
    }
}
