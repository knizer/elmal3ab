<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->deny->deny_if_logged_out();

		$this->load->model("groups_model");
    }


	public function index()
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$data = array();

			$current_page = (int) $this->uri->segment(2);
			$per_page = 20;
			$groups_count = $this->common_model->get_table_rows_count("groups");

			$config["base_url"] = ROOT . "groups/";
			$config['uri_segment'] = 2;
			$config["total_rows"] = $groups_count;
			$config["per_page"] = $per_page;
			$this->pagination->initialize($config);

			$groups = $this->groups_model->get_groups($current_page, $per_page);
			if ($groups)
			{
				$data["groups"] = $groups;
				$data["pagination"] = $this->pagination->create_links();
			}

			if (isset($_POST["submit"]))
			{
				$query = htmlspecialchars(trim($_POST["search"]));
				redirect(ROOT . "groups/search/$query");
			}

			$this->load->view("manage_groups_view", $data);
		}
	}


	public function search($query = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			if (empty($query)) redirect(ROOT . "groups");
			$query = urldecode($query);

			$data = array();

			$current_page = (int) $this->uri->segment(4);
			$per_page = 20;
			$groups_count = $this->common_model->get_search_rows_count("groups", "name", $query);

			$config["base_url"] = ROOT . "groups/search/$query";
			$config['uri_segment'] = 4;
			$config["total_rows"] = $groups_count;
			$config["per_page"] = $per_page;
			$this->pagination->initialize($config);

			$groups = $this->groups_model->search_groups("name", $query, $current_page, $per_page);
			if ($groups)
			{
				$data["groups"] = $groups;
				$data["pagination"] = $this->pagination->create_links();
			}

			if (isset($_POST["submit"]))
			{
				$query = htmlspecialchars(trim($_POST["search"]));
				redirect(ROOT . "groups/search/$query");
			}

			$this->load->view("manage_groups_view", $data);
		}
	}


	public function add()
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$data = array();

			if (isset($_POST["submit"]))
			{
				$name = htmlspecialchars(trim($_POST["name"]));
				$stadiums = (isset($_POST["stadiums"])) ? 1 : 0;
				$images_albums = (isset($_POST["images_albums"])) ? 1 : 0;
				$videos = (isset($_POST["videos"])) ? 1 : 0;
				$users_groups = (isset($_POST["users_groups"])) ? 1 : 0;

				if (empty($name))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال إسم المجموعة</p>";
				}
				else
				{
                    $insert_id = $this->groups_model->insert_group($name, $stadiums, $images_albums, $videos, $users_groups);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "groups");
				}
			}

			$this->load->view("add_group_view", $data);
		}
	}


	public function view($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
            $group = $this->common_model->get_subject_with_token("groups", "id", $id);
            if (empty($id) OR ! $group) show_404();

            $data["group"] = $group;

			echo $this->load->view("ajax_view_group_view", $data, TRUE);
		}
	}


	public function edit($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$group = $this->common_model->get_subject_with_token("groups", "id", $id);
			if (empty($id) OR ! $group) show_404();

			$data["group"] = $group;

			if (isset($_POST["submit"]))
			{
                $name = htmlspecialchars(trim($_POST["name"]));
				$stadiums = (isset($_POST["stadiums"])) ? 1 : 0;
				$images_albums = (isset($_POST["images_albums"])) ? 1 : 0;
				$videos = (isset($_POST["videos"])) ? 1 : 0;
				$users_groups = (isset($_POST["users_groups"])) ? 1 : 0;

				if (empty($name))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال إسم المجموعة</p>";
				}
				else
				{

					$this->groups_model->update_group($name, $stadiums, $images_albums, $videos, $users_groups, $id);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "groups");
				}
			}

			$this->load->view("edit_group_view", $data);
		}
	}


	public function delete($id = "")
    {
		$authorized = $this->common_model->authorized_to_view_page("users_groups");
		if ($authorized)
		{
			$group = $this->common_model->get_subject_with_token("groups", "id", $id);
			if (empty($id) OR ! $group) show_404();

			$data["group"] = $group;

			$this->common_model->delete_subject("groups", "id", $id);

			$this->session->set_flashdata("status", "تمت العملية بنجاح");
			redirect($_SERVER['HTTP_REFERER']);
		}
    }




	public function test()
	{
		header("Content-Type: text/html; charset=utf-8");

	}

}


/* End of file groups.php */
/* Location: ./application/modules/groups/controllers/groups.php */
