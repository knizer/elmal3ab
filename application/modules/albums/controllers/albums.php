<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('albums_model');
    }

    public function index($id = "")
    {
		$data = array();
        $data['title'] = "ألبومات الصور";
        $per_page = 12;

        $albums = $this->albums_model->get_albums(0, $per_page);
        if ($albums)
        {
            foreach ($albums as &$album)
            {
                $album['album_images'] = $this->common_model->get_all_subjects_with_token("album_images", "album_id", $album['id']);
            }
            $data['albums'] = $albums;
        }

        $this->load->view('albums_view', $data);
    }

    public function load_more_albums()
	{
	    if (isset($_POST['offset']))
		{
			$data = array();
			$albums = $this->albums_model->get_albums((int)$_POST['offset'], 12);
            if ($albums)
            {
                foreach ($albums as &$album)
                {
                    $album['album_images'] = $this->common_model->get_all_subjects_with_token("album_images", "album_id", $album['id']);
                }
                $data['albums'] = $albums;
            }

		    $this->load->view('load_more_view', $data);
		}
	}

}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
