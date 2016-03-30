<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model("home_model");
		$this->load->helper("img_processing");
		session_start();

		//print_r($this->session->all_userdata()); exit;
		//$this->session->sess_destroy();
    }


    public function index()
    {
		$this->deny->deny_if_logged_out();
		$data = array();

		$this->load->view("home_view");
    }


	public function login()
    {
        $this->deny->deny_if_logged_in();

		require_once(UPLOADS_PATH . 'recaptchalib.php');

        $data = array();

        if (isset($_POST["submit"]))
        {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if (empty($username) OR empty($password))
            {
                $data["error"] = "يجب إدخال إسم المستخدم  و كلمة السر";
            }
            else
            {
                if ($user_info = $this->home_model->login($username, $password))
                {
					$authorized = TRUE;

					if (isset($_COOKIE["invalid_login_attempts"]) && $_COOKIE["invalid_login_attempts"] > 5)
					{
						// Checking entered captcha code
						$resp = recaptcha_check_answer('6LcDaQsTAAAAAIZ9SnZijpKNbMhQDPN9DvJ9Ygz5',
														$_SERVER["REMOTE_ADDR"],
														$_POST["recaptcha_challenge_field"],
														$_POST["recaptcha_response_field"]);

						if ( ! $resp->is_valid)
						{
							$authorized = FALSE;
						}
					}

					if ($authorized)
					{
						if (isset($_COOKIE["invalid_login_attempts"]))
						{
							setcookie("invalid_login_attempts", 0, 0, "/");
						}

						// Successful login. $user_info now holds the user information. Also get user permissions then set session values
						$user_permissions = $this->common_model->get_subject_with_token("users_permissions", "user_id", $user_info["id"]);

						extract($user_info);
						extract($user_permissions);

						$session_data = array(
							"logged_in" => TRUE,
							"id" => $id,
							"name" => $name,
							"picture" => $picture,
							"username" => $username,
							"group_id" => $group_id,
							"stadiums" => $stadiums,
							"images_albums" => $images_albums,
							"videos" => $videos,
							"users_groups" => $users_groups
						);

						$this->session->set_userdata($session_data);

						$_SESSION["logged_in"] = TRUE;

						// Redirect user to admin home page
						redirect(ROOT);
					}
					else
					{
						$data["error"] = "يرجي إدخال كود التحقق بطريقة صحيحة!";

						$new_value = $_COOKIE["invalid_login_attempts"] + 1;
						setcookie("invalid_login_attempts", $new_value, 0, "/");
					}
                }
				else
                {
                    $data["error"] = "إسم المستخدم أو كلمة السر غير صحيحة";

					if ( ! isset($_COOKIE["invalid_login_attempts"]))
					{
						setcookie("invalid_login_attempts", 1, 0, "/");
					}
					else
					{
						$new_value = $_COOKIE["invalid_login_attempts"] + 1;
						setcookie("invalid_login_attempts", $new_value, 0, "/");
					}
                }
            }
        }

        $this->load->view("login_view", $data);
    }


	public function logout()
	{
		$this->deny->deny_if_logged_out();

		$this->session->sess_destroy();
		session_destroy();

		redirect(ROOT . "login");
	}


	public function change_password()
	{
		$this->deny->deny_if_logged_out();
		$data = array();

		if (isset($_POST["submit"]))
		{
			$password = htmlspecialchars(trim($_POST["password"]));
			$confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));

			if (empty($password) OR empty($confirm_password))
			{
				$data["status"] = "<p class='error-msg'>يجب إدخال جميع البيانات الإجبارية (*)</p>";
			}
			elseif ($password !== $confirm_password)
			{
				$data["status"] = "<p class='error-msg'>تأكيد كلمة السر لم يطابق كلمة السر</p>";
			}
			elseif (strlen($password) < 6)
			{
				$data["status"] = "<p class='error-msg'>يجب ألا تقل كلمة السر عن 6 حروف</p>";
			}
			else
			{
				$this->home_model->update_user_password($password, $this->session->userdata("id"));

				$data["status"] = "<p class='success-msg'>تم تغيير كلمة السر بنجاح</p>";
			}
		}

		$this->load->view("change_password_view", $data);
	}


	public function change_picture()
	{
		$this->deny->deny_if_logged_out();
		$data = array();

		if (isset($_POST["submit"]))
		{
			$picture_name = basename($_FILES["picture"]["name"]);
			$w = $_POST["w"];
			$h = $_POST["h"];
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$tmp_name = $_FILES["picture"]["tmp_name"]; // getting the temporary file name
			$allowed_exts = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF"); // specifying the allowed extensions
			$a = explode(".", $picture_name);
			$file_ext = strtolower(end($a)); unset($a); // getting the allowed extensions
			$path = USER_PHOTOS_PATH; // folder we store the employees photos in

			if (empty($picture_name))
			{
				$data["status"] = "<p class='error-msg'>لم تقوم بإختيار صورة</p>";
			}
			else
			{
				// Restricting file uploading to image files only
				if ( ! in_array($file_ext, $allowed_exts))
				{
					$data["status"] = "<p class='error-msg'>يجب ان تكون الصورة من انواع ملفات الصور</p>";
				}
				else
				{
					// Success. First delete the old picture then make new one
					@unlink($path . $this->session->userdata("picture"));
					$picture_name = $this->session->userdata("id") . "_" . time() . "." . $file_ext;
					move_uploaded_file($tmp_name, $path . $picture_name);

					// Now crop then resize the picture
					custom_image_crop($path . $picture_name, $path . $picture_name, $x1, $y1, $w, $h);
					custom_image_resize($path . $picture_name, $path . $picture_name, 250, 250);

					$this->home_model->update_user_picture($picture_name, $this->session->userdata("id"));
					$this->session->set_userdata("picture", $picture_name);

					$this->session->set_flashdata("status", "<p class='success-msg'>تم تغيير الصورة بنجاح</p>");
					redirect(ROOT . "change_picture");
				}
			}
		}

		$this->load->view("change_picture_view", $data);
	}

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
