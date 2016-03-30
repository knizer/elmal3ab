<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists("custom_image_resize"))
{
    function custom_image_resize($source_image, $new_image, $new_width, $new_height, $quality = 90)
    {
        $CI =& get_instance();
        $CI->load->library("image_lib");

        $config["image_library"] = "gd2";
        $config["source_image"]	= $source_image;
        $config["new_image"] = $new_image;
        $config["create_thumb"] = FALSE;
        $config["maintain_ratio"] = FALSE;
		$config["quality"] = $quality;
        $config["width"] = $new_width;
        $config["height"] = $new_height;

        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();

        // Clear data just in case
        $CI->image_lib->clear();
    }
}


if ( ! function_exists("custom_image_crop"))
{
    function custom_image_crop($source_image, $new_image, $x_axis, $y_axis, $new_width, $new_height, $quality = 70)
    {
        $CI =& get_instance();
        $CI->load->library("image_lib");

        $config["image_library"] = "gd2";
        $config["source_image"]	= $source_image;
        $config["new_image"] = $new_image;
        $config["maintain_ratio"] = FALSE;
		$config["quality"] = $quality;
        $config["x_axis"] = $x_axis;
		$config["y_axis"] = $y_axis;
        $config["width"] = $new_width;
        $config["height"] = $new_height;

        $CI->image_lib->initialize($config);
        $CI->image_lib->crop();

        // Clear data just in case
        $CI->image_lib->clear();
    }
}


if ( ! function_exists("custom_image_watermark"))
{
	function custom_image_watermark($source_image, $overlay_image)
	{
		$CI =& get_instance();
        $CI->load->library("image_lib");

        $config["image_library"] = "gd2";
		$config['source_image']	= $source_image;
		$config['wm_type'] = "overlay";
		$config['wm_overlay_path']	= $overlay_image;
		$config['wm_opacity'] = 20;
		$config['wm_vrt_alignment'] = "middle";
		$config['wm_hor_alignment'] = "center";

		$CI->image_lib->initialize($config);
		$CI->image_lib->watermark();

		// Clear data just in case
        $CI->image_lib->clear();
	}
}


if ( ! function_exists("png_2_jpg"))
{
	function png_2_jpg($original_file, $output_file, $quality = 100)
	{
		$image = imagecreatefrompng($original_file);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		imagejpeg($bg, $output_file, $quality);
		imagedestroy($bg);
	}
}


if ( ! function_exists("gif_2_jpg"))
{
	function gif_2_jpg($original_file, $output_file, $quality = 100)
	{
		$image = imagecreatefromgif($original_file);
		imagejpeg($image, $output_file, $quality);
		imagedestroy($image);
	}
}


/* End of file img_processing_helper.php */
/* Location: ./application/helpers/img_processing_helper.php */
