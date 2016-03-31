<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums_featured extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->deny->deny_if_logged_out();

        $this->load->model("albumsfeatured_model");
      //  error_reporting(0);
    }


    public function index()
    {
        $authorized = $this->common_model->authorized_to_view_page("images_albums");
		if ($authorized)
		{

			$per_page = 5;
			$offset = (int) $this->uri->segment(2);
			$data['list_data'] = $this->albumsfeatured_model->retrieveListData('featured_albums');
			$data['albums'] = $this->albumsfeatured_model->retrieveData($offset, $per_page);
			$data['albums_count'] = $this->albumsfeatured_model->countData();
			$config["base_url"] = ROOT . "albums_featured/";
			$config['uri_segment'] = 2;
			$config["total_rows"] = $data['albums_count'];
			$config["per_page"] = $per_page;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_link'] = 'الأول';
			$config['last_link'] = 'الأخير';
			$this->pagination->initialize($config);
			$data["pagination"] = $this->pagination->create_links();
			$data['offset'] = $offset;
			$data['per_page'] = $per_page;
			$this->load->view('playlists_view', $data);
        }
    }

     public function search($query)
    {
		if(! $query) redirect(ROOT);
        $authorized = $this->common_model->authorized_to_view_page("images_albums");
		if ($authorized)
		{

			$query = urldecode($query);
			$per_page = 5;
			$offset = (int) $this->uri->segment(4);
			$data['list_data'] = $this->albumsfeatured_model->retrieveListData('featured_albums');
			$data['albums'] = $this->albumsfeatured_model->retrieveDataSearch($query, $offset, $per_page);
			$data['albums_count'] = $this->albumsfeatured_model->countData($query);
			$config["base_url"] = ROOT . "albums_featured/search/".$query;
			$config['uri_segment'] = 4;
			$config["total_rows"] = $data['albums_count'];
			$config["per_page"] = $per_page;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_link'] = 'الأول';
			$config['last_link'] = 'الأخير';
			$this->pagination->initialize($config);
			$data["pagination"] = $this->pagination->create_links();
			$data['offset'] = $offset;
			$data['per_page'] = $per_page;
			$this->load->view('playlists_view', $data);
        }
    }


    public function get_album()
    {
        $data['article'] = $this->albumsfeatured_model->retrieveCustomDatabyID('albums', $_POST['album_id']);
        $this->load->view('article_view', $data);


    }




    public function saveChanges()
    {
        //echo $_POST['list_det'];
        $arr = explode('tabindex="1"', $_POST['list_det']);

        $flag = 0;

        foreach ($arr as $listElement) {

            //--check if list already contains data
            if (strpos($listElement, 'to_') !== false)
                $flag = 1;
        }

        //--delete old list elements
        if ((count($arr) - 1) <= 6) {
            if ($flag == 1)
                $this->albumsfeatured_model->delOldData();



            foreach ($arr as $listElement) {

                $html = $this->findAttribute($listElement, 'id');
                $html = str_replace(array('from_', 'to_'), '', $html);
                //add new elements to selected list
                if ($html != 0)
                    $newArr[] = $html;
            }

            $countArr = array_count_values($newArr);
            $count_flag = 0;
            foreach ($countArr as $element) {
                if ($element > 1) {

                    $count_flag = 1;
                }
            }

            if ($count_flag != 1) {
                foreach ($newArr as $element) {
                    $this->albumsfeatured_model->addFeaturedToLost($element);
                }
                echo 1;
            } else
                echo 2;
        }else {

            echo 0;
        }
    }


    public function findAttribute($html, $att)
    {
        $pattern = '/' . $att . '="([^"]+)"/isU';
        preg_match($pattern, $html, $matchs);
        if (isset($matchs[1]))
        {
            return $matchs[1];
        }
        else
        {
            return null;
        }
    }


}


/* End of file featured_news.php */
/* Location: ./application/modules/featured_news/controllers/featured_news.php */
