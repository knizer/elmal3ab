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
		$authorized = $this->common_model->authorized_to_view_page("manage_groups");
		if ($authorized)
		{
			$data = array();
		
			$current_page = (int) $this->uri->segment(2);
			$per_page = 20;
			$groups_count = $this->common_model->get_table_rows_count("groups");
			
			$config["base_url"] = site_url() . "groups/";
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
				redirect(site_url() . "groups/search/$query");
			}
			
			$this->load->view("manage_groups_view", $data);
		}
	}
	
	
	public function search($query = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("manage_groups");
		if ($authorized)
		{
			if (empty($query)) redirect(site_url() . "groups");
			$query = urldecode($query);
			
			$data = array();
			
			$current_page = (int) $this->uri->segment(4);
			$per_page = 20;
			$groups_count = $this->common_model->get_search_rows_count("groups", "name", $query);
			
			$config["base_url"] = site_url() . "groups/search/$query";
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
				redirect(site_url() . "groups/search/$query");
			}
			
			$this->load->view("manage_groups_view", $data);
		}
	}
	
	
	public function add()
	{
		$authorized = $this->common_model->authorized_to_view_page("add_group");
		if ($authorized)
		{
			$data = array();
			
			$sections = $this->common_model->get_all_from_table("sections");
			if ($sections) $data["sections"] = $sections;
			
			if (isset($_POST["submit"]))
			{
				$name = htmlspecialchars(trim($_POST["name"]));
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
	
				if (empty($name))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال إسم المجموعة</p>";
				}
				else
				{
					// Success. First get open sections then insert info and log action
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
					
					$insert_id = $this->groups_model->insert_group($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
																   $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control,
																   $banners_control, $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section,
																   $manage_sections, $arrange_sections, $delete_section, $add_subsection, $manage_subsections, $delete_subsection,
																   $add_coverage, $manage_coverages, $delete_coverage, $add_paper_version, $manage_paper_versions,
																   $delete_paper_version, $add_writer, $manage_writers, $delete_writer, $manage_keywords, $delete_keyword,
																   $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user, $manage_users,
																   $delete_user, $add_group, $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video, $delete_video,
																   $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope,
																   $open_sections);
					
					$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "إضافة مجموعة", "group", $insert_id, $name);
					
					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "groups");
				}
			}
			
			$this->load->view("add_group_view", $data);
		}
	}
	
	
	public function view($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("manage_groups");
		if ($authorized)
		{
			$group = $this->common_model->get_subject_with_token("groups", "id", $id);
			if (empty($id) OR ! $group) show_404();
			
			$data["group"] = $group;
			
			$sections = $this->common_model->get_all_from_table("sections");
			if ($sections) $data["sections"] = $sections;
			
			echo $this->load->view("ajax_view_group_view", $data, TRUE);
		}
	}
	
	
	public function edit($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("add_group");
		if ($authorized)
		{
			$group = $this->common_model->get_subject_with_token("groups", "id", $id);
			if (empty($id) OR ! $group) show_404();
			
			$data["group"] = $group;
			
			$sections = $this->common_model->get_all_from_table("sections");
			if ($sections) $data["sections"] = $sections;
			
			if (isset($_POST["submit"]))
			{
				$name = htmlspecialchars(trim($_POST["name"]));
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
	
				if (empty($name))
				{
					$data["status"] = "<p class='error-msg'>يجب إدخال إسم المجموعة</p>";
				}
				else
				{
					// Success. First get open sections then log action before updating
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
					
					$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل مجموعة", "group", $id);
					
					$this->groups_model->update_group($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
													  $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control,
													  $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections,
													  $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage,
													  $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer, $manage_writers, $delete_writer,
													  $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user,
													  $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video,
													  $delete_video, $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope,
													  $open_sections, $id);
					
					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "groups");
				}
			}
			
			$this->load->view("edit_group_view", $data);
		}
	}
	
	
	public function delete($id = "")
    {
		$authorized = $this->common_model->authorized_to_view_page("delete_group");
		if ($authorized)
		{
			$group = $this->common_model->get_subject_with_token("groups", "id", $id);
			if (empty($id) OR ! $group) show_404();
			
			$data["group"] = $group;
			
			// Log action before deleting
			$deleted_name = $group["name"];
			$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "مسح مجموعة", "group",  $id, $deleted_name);
			
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