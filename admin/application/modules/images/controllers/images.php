<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MX_Controller {

	private $watermark_image;
	private $image_sizes;

	public function __construct()
    {
        parent::__construct();
		$this->deny->deny_if_logged_out();

		$this->load->model("images_model");
		$this->load->helper("img_processing");

		// Path to watermark png image
		$this->watermark_image = IMG_ARCHIVE_PATH . "elwatan_watermark.png";

		// Image sizes array
		$this->image_sizes = array(
			"647x471" => "watermark_on",
			"622x307" => "watermark_on",
			"400x400" => "watermark_off",
			"279x305" => "watermark_off"
		);
    }


	public function index()
	{
		$data = array();

		$current_page = (int) $this->uri->segment(2);
		$per_page = 24;
		$images_count = $this->common_model->get_table_rows_count("images");

		$config["base_url"] = site_url() . "images/";
		$config['uri_segment'] = 2;
		$config["total_rows"] = $images_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$images = $this->images_model->get_images($current_page, $per_page);
		if ($images)
		{
			$data["images"] = $images;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "images/search/$query");
		}

		$this->load->view("manage_images_view", $data);
	}


	public function search($query = "")
	{
		if (empty($query)) redirect(site_url() . "images");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 24;
		$images_count = $this->common_model->get_search_rows_count("images", "description", $query);

		$config["base_url"] = site_url() . "images/search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $images_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$images = $this->images_model->search_images("description", $query, $current_page, $per_page);
		if ($images)
		{
			$data["images"] = $images;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "images/search/$query");
		}

		$this->load->view("manage_images_view", $data);
	}


	public function list_images()
	{
		$data = array();

		$current_page = (int) $this->uri->segment(3);
		$per_page = 36;
		$images_count = $this->common_model->get_table_rows_count("images");

		$config["base_url"] = site_url() . "images/list_images/";
		$config['uri_segment'] = 3;
		$config["total_rows"] = $images_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$images = $this->images_model->get_images($current_page, $per_page);
		if ($images)
		{
			$data["images"] = $images;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "images/images_search/$query");
		}

		$this->load->view("list_images_view", $data);
	}


	public function images_search($query = "")
	{
		if (empty($query)) redirect(site_url() . "images/list_images");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 20;
		$images_count = $this->common_model->get_search_rows_count("images", "description", $query);

		$config["base_url"] = site_url() . "images/images_search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $images_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$images = $this->images_model->search_images("description", $query, $current_page, $per_page);
		if ($images)
		{
			$data["images"] = $images;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "images/images_search/$query");
		}

		$this->load->view("list_images_view", $data);
	}


	/* This function is private, never accessed directly by the user */
	private function convert_to_jpg($original_image_path)
	{
		$image_name = basename($original_image_path);
		$parts = explode(".", $image_name);
		$image_name_without_extension = $parts[0];
		$file_extension = strtolower($parts[1]);

		if ($file_extension == "jpeg")
		{
			// If original file is jpeg we don't convert, we merely rename to jpg
			rename($original_image_path, IMG_ARCHIVE_PATH . "original/" . $image_name_without_extension . ".jpg");
		}
		elseif ($file_extension == "png")
		{
			// If original file is png we convert it to jpg
			png_2_jpg($original_image_path, IMG_ARCHIVE_PATH . "original/" . $image_name_without_extension . ".jpg");
			unlink($original_image_path);
		}
		elseif ($file_extension == "gif")
		{
			// If original file is gif we convert it to jpg
			gif_2_jpg($original_image_path, IMG_ARCHIVE_PATH . "original/" . $image_name_without_extension . ".jpg");
			unlink($original_image_path);
		}

		return $image_name_without_extension . ".jpg";
	}


	/* This function is private, never accessed directly by the user */
	private function process_image_version($original_image_path, $wanted_image_path, $wanted_version, $resize_only = FALSE)
	{
		// Calculate original image ratio from its height and width
		list($original_width, $original_height) = getimagesize($original_image_path);
		$original_ratio = $original_height / $original_width;

		// Get wanted version's height and width and calculate its ratio
		list($wanted_width, $wanted_height) = explode("x", $wanted_version);
		$wanted_ratio = $wanted_height / $wanted_width;

		// Start resizing logic
		if (abs($original_ratio - $wanted_ratio) >= 0 && abs($original_ratio - $wanted_ratio) <= 0.05)
		{
			// First we check the best case scenario where original image ratio is almost identical to the wanted
			// version. If so we just resize and decrease quality, no cropping needed. Return 1 to signify this
			custom_image_resize($original_image_path, $wanted_image_path, $wanted_width, $wanted_height, 60);
			return;
		}
		else
		{
			if (($original_width < $wanted_width && $original_height < $wanted_height) OR
				($original_width > $wanted_width && $original_height > $wanted_height))
			{
				// If both original width and height are less or more than what we want, we see if image is very wide or long (or square)
				if ($original_ratio < $wanted_ratio)
				{
					// Very wide image. Need to resize with wanted height (while manually calculating width that maintains ratio)
					$width_that_maintains_ratio = $wanted_height / $original_ratio;
					custom_image_resize($original_image_path, $wanted_image_path, $width_that_maintains_ratio, $wanted_height);

					if ( ! $resize_only)
					{
						// Crop vertical center
						list($current_width, $current_height) = getimagesize($wanted_image_path);
						$diff = $current_width - $wanted_width;
						$x_axis = floor($diff / 2);
						custom_image_crop($wanted_image_path, $wanted_image_path, $x_axis, 0, $wanted_width, $current_height);
					}
				}
				else
				{
					// Long (or square-ish) image. Need to resize with wanted width (while manually calculating height that maintains ratio)
					$height_that_maintains_ratio = $wanted_width * $original_ratio;
					custom_image_resize($original_image_path, $wanted_image_path, $wanted_width, $height_that_maintains_ratio);

					if ( ! $resize_only)
					{
						// Crop horizontal center
						list($current_width, $current_height) = getimagesize($wanted_image_path);
						$diff = $current_height - $wanted_height;
						$y_axis = floor($diff / 2);
						custom_image_crop($wanted_image_path, $wanted_image_path, 0, $y_axis, $current_width, $wanted_height);
					}
				}
			}
			elseif ($original_width <= $wanted_width && $original_height >= $wanted_height)
			{
				// If width of original image less than what we want but not height, resize with width
				$height_that_maintains_ratio = $wanted_width * $original_ratio;
				custom_image_resize($original_image_path, $wanted_image_path, $wanted_width, $height_that_maintains_ratio);

				if ( ! $resize_only)
				{
					// Crop horizontal center
					list($current_width, $current_height) = getimagesize($wanted_image_path);
					$diff = $current_height - $wanted_height;
					$y_axis = floor($diff / 2);
					custom_image_crop($wanted_image_path, $wanted_image_path, 0, $y_axis, $current_width, $wanted_height);
				}
			}
			elseif ($original_height <= $wanted_height && $original_width >= $wanted_width)
			{
				// If height of original image less than what we want but not width, resize with height
				$width_that_maintains_ratio = $wanted_height / $original_ratio;
				custom_image_resize($original_image_path, $wanted_image_path, $width_that_maintains_ratio, $wanted_height);

				if ( ! $resize_only)
				{
					// Crop vertical center
					list($current_width, $current_height) = getimagesize($wanted_image_path);
					$diff = $current_width - $wanted_width;
					$x_axis = floor($diff / 2);
					custom_image_crop($wanted_image_path, $wanted_image_path, $x_axis, 0, $wanted_width, $current_height);
				}
			}
		}
	}


	/* This function is private, never accessed directly by the user */
	private function make_long_version($original_file, $output_file)
	{
		$img_dimensions = getimagesize($original_file);
		$img_width_to_height_ratio = $img_dimensions[0] / $img_dimensions[1];
		$img_calculated_height = 620 / $img_width_to_height_ratio;
		$img_readable_size = "620x$img_calculated_height";
		$this->process_image_version($original_file, $output_file, $img_readable_size, TRUE);
	}


	public function add($version = "")
	{
		error_reporting(0);
		if ( ! empty($_FILES))
		{
			// Code that runs after image upload
			$file_name = basename($_FILES["image"]["name"]);
			$tmp_file = $_FILES["image"]["tmp_name"];
			$tmp = explode(".", $file_name);
			$file_ext = strtolower(end($tmp)); unset($tmp);

			// Set image name
			$image_name_without_extension = rand() . time();

			// Case where user is replacing an existing image
			if (isset($_POST["replace"]))
			{
				$existing_name = $_POST["existing_name"];
				$image_name_without_extension = array_shift(explode(".", $existing_name));

				// Delete all image versions from disk first to avoid permission issues
				@unlink(IMG_ARCHIVE_PATH . "original/" . $existing_name);
				@unlink(IMG_ARCHIVE_PATH . "original_lower_quality/" . $existing_name);
				foreach ($this->image_sizes as $key => $value)
				{
					@unlink(IMG_ARCHIVE_PATH . "$key/" . $existing_name);
				}
			}

			$image_name = $image_name_without_extension . "." . $file_ext;

			// Upload original version
			$original_file = IMG_ARCHIVE_PATH . "original/" . $image_name;
			move_uploaded_file($tmp_file, $original_file);

			// Convert to jpg if image is not and reset image name and path
			$image_name = $this->convert_to_jpg($original_file);
			$original_file = IMG_ARCHIVE_PATH . "original/" . $image_name;

			// Make all wanted versions (if file was successfully uploaded)
			if (file_exists($original_file))
			{
				foreach ($this->image_sizes as $key => $value)
				{
					$this->process_image_version($original_file, IMG_ARCHIVE_PATH . "$key/" . $image_name, "$key");
				}
				// Make original version with lowered quality
				$this->make_long_version($original_file, IMG_ARCHIVE_PATH . "original_lower_quality/" . $image_name);

				if (isset($_POST["replace"]))
				{
					$existing_id = $_POST["existing_id"];
					$old_image_watermark = $_POST["existing_watermark"];
					$new_image_watermark = (isset($_POST["watermark_new"])) ? 1 : 0;

					// If user wants watermark on new image, add it
					if ($new_image_watermark == 1)
					{
						foreach ($this->image_sizes as $key => $value)
						{
							if ($value == "watermark_on")
							{
								custom_image_watermark(IMG_ARCHIVE_PATH . "$key/" . $image_name, $this->watermark_image);
							}
						}
						custom_image_watermark(IMG_ARCHIVE_PATH . "original_lower_quality/" . $image_name, $this->watermark_image);
					}

					// Also update the 'watermarked' flag to new value if it has changed
					if ($new_image_watermark != $old_image_watermark)
					{
						$this->images_model->update_watermarked_flag($existing_id, $new_image_watermark);
					}

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(site_url() . "images");
				}
				else
				{
					reset($this->image_sizes);
					$first_size = key($this->image_sizes);
					if (file_exists(IMG_ARCHIVE_PATH . "$first_size/" . $image_name))
					{
						// Insert image and upload identifier into database and log action
						$session_id = $_POST["session_id"];
						$uploaded_by = $this->session->userdata("name");
						$insert_id = $this->images_model->upload_image($image_name, $uploaded_by, $session_id);
					}
					else
					{
						echo "quality_error";
					}
				}
			}
		}
		elseif (isset($_POST["submit"]))
		{
			// Code that runs after submitting image descriptions and watermarking information
			$image_descriptions = array();
			foreach ($_POST as $key => $value)
			{
				if (strpos($key, "desc") === 0)
				{
					$image_descriptions[$key] = htmlspecialchars(trim($value));
				}
			}

			foreach ($image_descriptions as $key => $value)
			{
				$image_info = explode(":", $key);
				$image_id = $image_info[1];
				// Convert underscore to dot in image name cause php automatically convert dots in POST keys into underscores
				$image_name = str_replace("_", ".", $image_info[2]);
				$watermarked = (isset($_POST["watermarked_$image_id"])) ? 1 : 0;

				if ($watermarked === 1)
				{
					foreach ($this->image_sizes as $key => $watermark_val)
					{
						if ($watermark_val == "watermark_on")
						{
							custom_image_watermark(IMG_ARCHIVE_PATH . "$key/" . $image_name, $this->watermark_image);
						}
					}
					custom_image_watermark(IMG_ARCHIVE_PATH . "original_lower_quality/" . $image_name, $this->watermark_image);
				}

				$this->images_model->update_image_info($value, $watermarked, $image_id);
			}

			$redirect_path = ($version == "mini") ? site_url() . "images/list_images" : site_url() . "images";
			redirect($redirect_path);
		}
		else
		{
			// Just load the view if no files were uploaded or POST data submitted
			$data["timestamp"] = time();

			$view = ($version == "mini") ? "add_image_mini_view" : "add_image_view";
			$this->load->view($view, $data);
		}
	}


	public function view($id = "")
    {
		$image = $this->images_model->get_image_details($id);
		if (empty($id) OR ! $image) show_404();

		$data["image"] = $image;
		$data["image_sizes"] = $this->image_sizes;

		echo $this->load->view("ajax_view_image_view", $data, TRUE);
	}


	public function edit($id = "")
    {
		$image = $this->common_model->get_subject_with_token("images", "id", $id);
		if (empty($id) OR ! $image) show_404();

		$data["image"] = $image;

		// Send our different sizes to the view
		$data["image_sizes"] = $this->image_sizes;

		$original_file = IMG_ARCHIVE_PATH . "original/" . $image["name"];
		if (file_exists($original_file))
		{
			foreach ($this->image_sizes as $key => $value)
			{
				$this->process_image_version($original_file, IMG_ARCHIVE_PATH . "cache/{$key}_" . $image["name"], "$key", TRUE);
			}
			// Make original version with lowered quality
		    $this->make_long_version($original_file, IMG_ARCHIVE_PATH . "cache/original_lower_" . $image["name"]);

			sleep(1); // Stop the script for a moment to give it more time to make the resized images we will show, just in case
		}

		if (isset($_POST["submit"]))
		{
			$description = htmlspecialchars(trim($_POST["description"]));
			$watermarked = (isset($_POST["watermarked"])) ? 1 : 0;

			// Crop cached versions with given values to overwrite their old versions in their respective folders
			foreach ($this->image_sizes as $key => $value)
			{
				list($crop_x, $crop_y) = array($_POST["{$key}_x"], $_POST["{$key}_y"]);
				list($wanted_size_x, $wanted_size_y) = explode("x", $key);
				custom_image_crop(IMG_ARCHIVE_PATH . "cache/{$key}_" . $image["name"], IMG_ARCHIVE_PATH . "$key/" . $image["name"], $crop_x, $crop_y,
								  $wanted_size_x, $wanted_size_y);
			}
			copy(IMG_ARCHIVE_PATH . "cache/original_lower_" . $image["name"], IMG_ARCHIVE_PATH . "original_lower_quality/" . $image["name"]);

			if ($watermarked === 1)
			{
				foreach ($this->image_sizes as $key => $value)
				{
					if ($value == "watermark_on")
					{
						custom_image_watermark(IMG_ARCHIVE_PATH . "$key/" . $image["name"], $this->watermark_image);
					}
				}
				custom_image_watermark(IMG_ARCHIVE_PATH . "original_lower_quality/" . $image["name"], $this->watermark_image);
			}

			// Update image info in database
			$this->images_model->update_image_info($description, $watermarked, $id);

			// Delete all cached versions of this image
			foreach ($this->image_sizes as $key => $value)
			{
				@unlink(IMG_ARCHIVE_PATH . "cache/{$key}_" . $image["name"]);
			}
			@unlink(IMG_ARCHIVE_PATH . "cache/original_lower_" . $image["name"]);

			$this->session->set_flashdata("status", "تمت العملية بنجاح");
			redirect(site_url() . "images");
		}

		$this->load->view("edit_image_view", $data);
	}


	public function delete($id = "")
    {
		$authorized = TRUE;
		if ( ! isset($_POST["token"]))
		{
			$authorized = $this->common_model->authorized_to_view_page("delete_image");
		}

		if ($authorized)
		{
			$image = $this->common_model->get_subject_with_token("images", "id", $id);
			if (empty($id) OR ! $image OR $image["times_used"] > 0) show_404();

			// Delete from database
			$this->common_model->delete_subject("images", "id", $id);

			// Delete image associations with any albums
			$this->common_model->delete_subject("album_images", "image_id", $id);

			// Delete all image versions from disk
			@unlink(IMG_ARCHIVE_PATH . "original/" . $deleted_image_name);
			@unlink(IMG_ARCHIVE_PATH . "original_lower_quality/" . $deleted_image_name);
			foreach ($this->image_sizes as $key => $value)
			{
				@unlink(IMG_ARCHIVE_PATH . "$key/" . $deleted_image_name);
			}

			// Only redirect to images home page if request wasn't via ajax
			if ( ! isset($_POST["token"]))
			{
				$this->session->set_flashdata("status", "تمت العملية بنجاح");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}


	/* This function is only accessed via ajax via a POST request, never directly by the user */
	public function check_for_images_just_uploaded()
	{
		if (isset($_POST["session_id"]))
		{
			$session_id = $_POST["session_id"];

			$images = $this->common_model->get_all_subjects_with_token("images", "session_id", $session_id);
			if ($images) echo json_encode($images);
			else echo 0;
		}
	}

}


/* End of file images.php */
/* Location: ./application/modules/images/controllers/images.php */
