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

			$config["base_url"] = site_url() . "users/";
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
				redirect(site_url() . "users/search/$query");
			}

			$this->load->view("manage_users_view", $data);
		}
    }


	public function search($query = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			if (empty($query)) redirect(site_url() . "users");
			$query = urldecode($query);

			$data = array();

			$current_page = (int) $this->uri->segment(4);
			$per_page = 20;
			$users_count = $this->users_model->get_search_rows_count($query);

			$config["base_url"] = site_url() . "users/search/$query";
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
				redirect(site_url() . "users/search/$query");
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

					// Insert information into database and log action
					$insert_id = $this->users_model->insert_user($name, $group_id, $picture_name, $username, $password, $mobile, $email);

					$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "إضافة مستخدم", "user", $insert_id, $name, $username);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "users");
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

			$sections = $this->common_model->get_all_from_table("sections");
			if ($sections) $data["sections"] = $sections;

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
			if (empty($id) OR ! $user) redirect(site_url() . "users");

            $data["user"] = $user;

			$groups = $this->common_model->get_all_from_table("groups");
			if ($groups) $data["groups"] = $groups;

			$sections = $this->common_model->get_all_from_table("sections");
			if ($sections) $data["sections"] = $sections;

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
					// Log action before updating information
					$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل بيانات مستخدم", "user", $id, $user["username"]);

					$this->users_model->update_user_info($name, $group_id, $mobile, $email, $id);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "users");
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
					// Log action before updating information
					$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل كلمة سر مستخدم", "user", $id, $user["username"]);

					$this->users_model->update_user_password($password, $id);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "users");
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

						// Log action before updating information
						$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل صورة مستخدم", "user", $id, $user["username"]);

						$this->users_model->update_user_picture($picture_name, $id);

						$this->session->set_flashdata("status", "تمت العملية بنجاح");
						redirect(site_url() . "users");
					}
				}
			}
			elseif (isset($_POST["permissions_submit"]))
			{
				$add_news = (isset($_POST["add_news"])) ? 1 : 0;
				$add_news_without_related_articles = (isset($_POST["add_news_without_related_articles"])) ? 1 : 0;
				$manage_news = (isset($_POST["manage_news"])) ? 1 : 0;
				$view_news_history = (isset($_POST["view_news_history"])) ? 1 : 0;
				$edit_news = (isset($_POST["edit_news"])) ? 1 : 0;
				$delete_news = (isset($_POST["delete_news"])) ? 1 : 0;
				$move_news_to_urgent = (isset($_POST["move_news_to_urgent"])) ? 1 : 0;
				$move_news_to_reviewed = (isset($_POST["move_news_to_reviewed"])) ? 1 : 0;
				$move_news_to_published = (isset($_POST["move_news_to_published"])) ? 1 : 0;
				$unlock_news = (isset($_POST["unlock_news"])) ? 1 : 0;
				$review_news = (isset($_POST["review_news"])) ? 1 : 0;
				$featured_news_control = (isset($_POST["featured_news_control"])) ? 1 : 0;
				$banners_control = (isset($_POST["banners_control"])) ? 1 : 0;
				$view_original_image = (isset($_POST["view_original_image"])) ? 1 : 0;
				$delete_image = (isset($_POST["delete_image"])) ? 1 : 0;
				$delete_album = (isset($_POST["delete_album"])) ? 1 : 0;
				$featured_albums = (isset($_POST["featured_albums"])) ? 1 : 0;
				$add_section = (isset($_POST["add_section"])) ? 1 : 0;
				$manage_sections = (isset($_POST["manage_sections"])) ? 1 : 0;
				$arrange_sections = (isset($_POST["arrange_sections"])) ? 1 : 0;
				$delete_section = (isset($_POST["delete_section"])) ? 1 : 0;
				$add_subsection = (isset($_POST["add_subsection"])) ? 1 : 0;
				$manage_subsections = (isset($_POST["manage_subsections"])) ? 1 : 0;
				$delete_subsection = (isset($_POST["delete_subsection"])) ? 1 : 0;
				$add_coverage = (isset($_POST["add_coverage"])) ? 1 : 0;
				$manage_coverages = (isset($_POST["manage_coverages"])) ? 1 : 0;
				$delete_coverage = (isset($_POST["delete_coverage"])) ? 1 : 0;
				$add_paper_version = (isset($_POST["add_paper_version"])) ? 1 : 0;
				$manage_paper_versions = (isset($_POST["manage_paper_versions"])) ? 1 : 0;
				$delete_paper_version = (isset($_POST["delete_paper_version"])) ? 1 : 0;
				$add_writer = (isset($_POST["add_writer"])) ? 1 : 0;
				$manage_writers = (isset($_POST["manage_writers"])) ? 1 : 0;
				$delete_writer = (isset($_POST["delete_writer"])) ? 1 : 0;
				$manage_keywords = (isset($_POST["manage_keywords"])) ? 1 : 0;
				$delete_keyword = (isset($_POST["delete_keyword"])) ? 1 : 0;
				$add_interactive_file = (isset($_POST["add_interactive_file"])) ? 1 : 0;
				$manage_interactive_files = (isset($_POST["manage_interactive_files"])) ? 1 : 0;
				$delete_interactive_file = (isset($_POST["delete_interactive_file"])) ? 1 : 0;
				$add_user = (isset($_POST["add_user"])) ? 1 : 0;
				$manage_users = (isset($_POST["manage_users"])) ? 1 : 0;
				$delete_user = (isset($_POST["delete_user"])) ? 1 : 0;
				$add_group = (isset($_POST["add_group"])) ? 1 : 0;
				$manage_groups = (isset($_POST["manage_groups"])) ? 1 : 0;
				$delete_group = (isset($_POST["delete_group"])) ? 1 : 0;
				$add_video = (isset($_POST["add_video"])) ? 1 : 0;
				$manage_videos = (isset($_POST["manage_videos"])) ? 1 : 0;
				$edit_video = (isset($_POST["edit_video"])) ? 1 : 0;
				$delete_video = (isset($_POST["delete_video"])) ? 1 : 0;
				$users_monitor = (isset($_POST["users_monitor"])) ? 1 : 0;
				$users_monitor_archive = (isset($_POST["users_monitor_archive"])) ? 1 : 0;
				$add_metadata = (isset($_POST["add_metadata"])) ? 1 : 0;
				$manage_metadata = (isset($_POST["manage_metadata"])) ? 1 : 0;
				$delete_metadata = (isset($_POST["delete_metadata"])) ? 1 : 0;
				$manage_horoscope = (isset($_POST["manage_horoscope"])) ? 1 : 0;

				$open_sections = array();
				if ($sections)
				{
					foreach ($sections as $section)
					{
						if (isset($_POST[$section["id"]]))
						{
							$open_sections[] = $section["id"];
						}
					}
				}

				$open_sections = implode(",", $open_sections);

				// Log action before updating information
				$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل صلاحيات المستخدم", "user", $id, $user["username"]);

				$this->users_model->update_user_permissions($add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
															$move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control,
															$banners_control, $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections,
															$arrange_sections, $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage,
															$manage_coverages, $delete_coverage, $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer,
															$manage_writers, $delete_writer, $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files,
															$delete_interactive_file, $add_user, $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video,
															$manage_videos, $edit_video, $delete_video, $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata,
															$delete_metadata, $manage_horoscope, $open_sections, $id);

				$this->session->set_flashdata("status", "تمت العملية بنجاح");
				redirect(site_url() . "users");
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
			if (empty($id) OR ! $user) redirect(site_url() . "users");

			// Log action before deleting
			$deleted_name = $user["name"];
			$deleted_username = $user["username"];
			$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "مسح مستخدم", "user", $id, $deleted_name, $deleted_username);

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
