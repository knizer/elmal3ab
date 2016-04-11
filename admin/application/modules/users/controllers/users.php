<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->deny->deny_if_logged_out();

		$this->load->model("users_model");
		$this->load->helper("img_processing");
    }


	public function index()
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$data = array();

			$current_page = (int) $this->uri->segment(2);
			$per_page = 20;
			$users_count = $this->common_model->get_table_rows_count("users_details");

			$config["base_url"] = ROOT . "users/";
			$config['uri_segment'] = 2;
			$config["total_rows"] = $users_count;
			$config["per_page"] = $per_page;
			$this->pagination->initialize($config);

			$users = $this->users_model->get_users($current_page, $per_page);
			if ($users)
			{
				$data["users"] = $users;
				$data["pagination"] = $this->pagination->create_links();
			}

			if (isset($_POST["submit"]))
			{
				$query = htmlspecialchars(trim($_POST["search"]));
				redirect(ROOT . "users/search/$query");
			}

			$this->load->view("manage_users_view", $data);
		}
    }


	public function search($query = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			if (empty($query)) redirect(ROOT . "users");
			$query = urldecode($query);

			$data = array();

			$current_page = (int) $this->uri->segment(4);
			$per_page = 20;
			$users_count = $this->users_model->get_search_rows_count($query);

			$config["base_url"] = ROOT . "users/search/$query";
			$config['uri_segment'] = 4;
			$config["total_rows"] = $users_count;
			$config["per_page"] = $per_page;
			$this->pagination->initialize($config);

			$users = $this->users_model->search_users($query, $current_page, $per_page);
			if ($users)
			{
				$data["users"] = $users;
				$data["pagination"] = $this->pagination->create_links();
			}

			if (isset($_POST["submit"]))
			{
				$query = htmlspecialchars(trim($_POST["search"]));
				redirect(ROOT . "users/search/$query");
			}

			$this->load->view("manage_users_view", $data);
		}
	}


	public function add()
	{
        $authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
            $data = array();

			$groups = $this->common_model->get_all_from_table("groups");
			if ($groups) $data["groups"] = $groups;

			if (isset($_POST["submit"]))
			{
				$name = htmlspecialchars(trim($_POST["name"]));
				$group_id = $_POST["group_id"];
				$picture_name = basename($_FILES["picture"]["name"]);
				$username = htmlspecialchars(trim($_POST["username"]));
				$password = htmlspecialchars(trim($_POST["password"]));
				$confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
				$mobile = htmlspecialchars(trim($_POST["mobile"]));
				$email = htmlspecialchars(trim($_POST["email"]));
				$w = $_POST["w"];
				$h = $_POST["h"];
				$x1 = $_POST["x1"];
				$y1 = $_POST["y1"];

				if (empty($name) OR empty($group_id) OR empty($username) OR empty($password) OR empty($confirm_password))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال جميع البيانات الإجبارية (*)</p>";
				}
				elseif ($this->common_model->subject_exists("users_details", "username", $username))
				{
					$data["status"] = "<p class='error-msg'>إسم المستخدم الذي  قمت بإختياره مستخدم بالفعل</p>";
				}
				elseif ($password !== $confirm_password)
				{
					$data["status"] = "<p class='error-msg'>تأكيد كلمة السر لم يطابق كلمة السر</p>";
				}
				elseif (strlen($password) < 6)
				{
					$data["status"] = "<p class='error-msg'>يجب ألا تقل كلمة السر عن 6 حروف</p>";
				}
				elseif ( ! empty($mobile) && ( ! is_numeric($mobile) OR strlen($mobile) != 11))
				{
					$data["status"] = "<p class='error-msg'>قمت بإدخال رقم موبايل غير صحيح</p>";
				}
				elseif ( ! empty($email) && ( ! filter_var($email, FILTER_VALIDATE_EMAIL)))
				{
					$data["status"] = "<p class='error-msg'>قمت بإدخال بريد إلكتروني غير صحيح</p>";
				}
				else
				{
					if ( ! empty($_FILES["picture"]["name"]))
					{
						$tmp_name = $_FILES['picture']['tmp_name']; // getting the temporary file name
						$allowed_exts = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'); // specifying the allowed extensions
						$a = explode('.', $picture_name);
						$file_ext = strtolower(end($a)); unset($a);
						$path = USER_PHOTOS_PATH; // folder we store the employees photos in

						// Restricting file uploading to image files only
						if ( ! in_array($file_ext, $allowed_exts))
						{
							$data["status"] = "<p class='error-msg'>يجب ان تكون الصورة من انواع ملفات الصور</p>";
						}
						else
						{
							// Success. Give the picture a unique name and upload it
							$last_id = $this->common_model->get_table_max_id("users_details");
							$picture_name = $last_id + 1 . "_" . time() . "." . $file_ext;
							move_uploaded_file($tmp_name, $path . $picture_name);

							// Now crop then resize the picture
							custom_image_crop($path . $picture_name, $path . $picture_name, $x1, $y1, $w, $h);
							custom_image_resize($path . $picture_name, $path . $picture_name, 250, 250);
						}
					}

					// Insert information into database
					$insert_id = $this->users_model->insert_user($name, $group_id, $picture_name, $username, $password, $mobile, $email);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "users");
				}
			}

			$this->load->view("add_user_view", $data);
		}
	}


	public function view($id = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$user = $this->users_model->get_user_details($id);
			if (empty($id) OR ! $user) show_404();

            $data["user"] = $user;

			$user_permissions = $this->common_model->get_subject_with_token("users_permissions", "user_id", $id);
			if ($user_permissions) $data["user_permissions"] = $user_permissions;

			echo $this->load->view("ajax_view_user_view", $data, TRUE);
		}
	}


    public function edit($id = "")
	{
        $authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$user = $this->common_model->get_subject_with_token("users_details", "id", $id);
			if (empty($id) OR ! $user) redirect(ROOT . "users");

            $data["user"] = $user;

			$groups = $this->common_model->get_all_from_table("groups");
			if ($groups) $data["groups"] = $groups;

			$user_permissions = $this->common_model->get_subject_with_token("users_permissions", "user_id", $id);
			if ($user_permissions) $data["user_permissions"] = $user_permissions;
			if (isset($_POST["info_submit"]))
			{
				$name = htmlspecialchars(trim($_POST["name"]));
				$group_id = $_POST["group_id"];
				$mobile = htmlspecialchars(trim($_POST["mobile"]));
				$email = htmlspecialchars(trim($_POST["email"]));
				if (empty($name) OR empty($group_id))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال جميع البيانات الإجبارية (*)</p>";
				}
				elseif ( ! empty($mobile) && ( ! is_numeric($mobile) OR strlen($mobile) != 11))
				{
					$data["status"] = "<p class='error-msg'>قمت بإدخال رقم موبايل غير صحيح</p>";
				}
				elseif ( ! empty($email) && ( ! filter_var($email, FILTER_VALIDATE_EMAIL)))
				{
					$data["status"] = "<p class='error-msg'>قمت بإدخال بريد إلكتروني غير صحيح</p>";
				}
				else
				{
                    $group_id = $_POST['group_id'];

                    if ($group_id != $user['group_id'])
                    {

                        $this->users_model->update_user_group_and_permissions($group_id, $id);
                    }

					$this->users_model->update_user_info($name, $group_id, $mobile, $email, $id);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "users");
				}
			}
			elseif (isset($_POST["password_submit"]))
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

					$this->users_model->update_user_password($password, $id);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "users");
				}
			}
			elseif (isset($_POST["picture_submit"]))
			{
				$picture_name = basename($_FILES["picture"]["name"]);
				$w = $_POST["w"];
				$h = $_POST["h"];
				$x1 = $_POST["x1"];
				$y1 = $_POST["y1"];
				$tmp_name = $_FILES['picture']['tmp_name']; // getting the temporary file name
				$allowed_exts = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'); // specifying the allowed extensions
				$a = explode('.', $picture_name);
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
						@unlink($path . $user["picture"]);
						$picture_name = $id . "_" . time() . "." . $file_ext;
						move_uploaded_file($tmp_name, $path . $picture_name);

						// Now crop then resize the picture
						custom_image_crop($path . $picture_name, $path . $picture_name, $x1, $y1, $w, $h);
						custom_image_resize($path . $picture_name, $path . $picture_name, 250, 250);

						$this->users_model->update_user_picture($picture_name, $id);

						$this->session->set_flashdata("status", "تمت العملية بنجاح");
						redirect(ROOT . "users");
					}
				}
			}
			elseif (isset($_POST["permissions_submit"]))
			{
                $stadiums = (isset($_POST["stadiums"])) ? 1 : 0;
				$images_albums = (isset($_POST["images_albums"])) ? 1 : 0;
				$videos = (isset($_POST["videos"])) ? 1 : 0;
				$users_groups = (isset($_POST["users_groups"])) ? 1 : 0;


				$this->users_model->update_user_permissions($stadiums, $images_albums, $videos, $users_groups, $id);

				$this->session->set_flashdata("status", "تمت العملية بنجاح");
				redirect(ROOT . "users");
			}

			$this->load->view("edit_user_view", $data);
		}
	}


	public function delete($id = "")
    {
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$user = $this->common_model->get_subject_with_token("users_details", "id", $id);
			if (empty($id) OR ! $user) redirect(ROOT . "users");

			$this->common_model->delete_subject("users_details", "id", $id);

			// Also delete user permissions
			$this->common_model->delete_subject("users_permissions", "user_id", $id);

			// And if user has a photo delete it from desk as well
			if ( ! empty($user["picture"]))
			{
				$user_photo = USER_PHOTOS_PATH . $user["picture"];
				if (file_exists($user_photo)) unlink($user_photo);
			}

			$this->session->set_flashdata("status", "تمت العملية بنجاح");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}




    public function test()
	{
		header("Content-Type: text/html; charset=utf-8");

	}

}


/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */
