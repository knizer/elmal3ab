<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function insert_group($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news, $move_news_to_urgent,
                                 $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control, $view_original_image, $delete_image,
                                 $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections, $delete_section, $add_subsection, $manage_subsections,
                                 $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage, $add_paper_version, $manage_paper_versions, $delete_paper_version,
                                 $add_writer, $manage_writers, $delete_writer, $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files,
                                 $delete_interactive_file, $add_user, $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video, $manage_videos,
                                 $edit_video, $delete_video, $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope,
                                 $open_sections)
    {
        $sql = "INSERT INTO `groups` (`name`, `add_news`, `add_news_without_related_articles`, `manage_news`, `view_news_history`, `edit_news`, `delete_news`,
                `move_news_to_urgent`, `move_news_to_reviewed`, `move_news_to_published`, `unlock_news`, `review_news`, `featured_news_control`, `banners_control`, `view_original_image`,
                `delete_image`, `delete_album`, `featured_albums`, `add_section`, `manage_sections`, `arrange_sections`, `delete_section`, `add_subsection`, `manage_subsections`,
                `delete_subsection`, `add_coverage`, `manage_coverages`, `delete_coverage`, `add_paper_version`, `manage_paper_versions`, `delete_paper_version`, `add_writer`,
                `manage_writers`, `delete_writer`, `manage_keywords`, `delete_keyword`, `add_interactive_file`, `manage_interactive_files`, `delete_interactive_file`, `add_user`,
                `manage_users`, `delete_user`, `add_group`, `manage_groups`, `delete_group`, `add_video`, `manage_videos`, `edit_video`, `delete_video`, `users_monitor`,
                `users_monitor_archive`, `add_metadata`, `manage_metadata`, `delete_metadata`, `manage_horoscope`, `open_sections`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $query = $this->db->query($sql, array($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
                                              $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control,
                                              $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections,
                                              $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage,
                                              $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer, $manage_writers, $delete_writer, $manage_keywords,
                                              $delete_keyword, $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user, $manage_users, $delete_user,
                                              $add_group, $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video, $delete_video, $users_monitor,
                                              $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope, $open_sections));
        return $this->db->insert_id();
    }
    
    
    private function update_permissions_of_users_in_group($add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
                                                          $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control,
                                                          $banners_control, $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections,
                                                          $arrange_sections, $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage,
                                                          $manage_coverages, $delete_coverage, $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer,
                                                          $manage_writers, $delete_writer, $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files,
                                                          $delete_interactive_file, $add_user, $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video,
                                                          $manage_videos, $edit_video, $delete_video, $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata,
                                                          $delete_metadata, $manage_horoscope, $open_sections, $group_id)
    {
        $sql = "UPDATE `users_permissions` SET `add_news` = ?, `add_news_without_related_articles` = ?, `manage_news` = ?, `view_news_history` = ?, `edit_news` = ?,
                `delete_news` = ?, `move_news_to_urgent` = ?, `move_news_to_reviewed` = ?, `move_news_to_published` = ?, `unlock_news` = ?, `review_news` = ?, `featured_news_control` = ?,
                `banners_control` = ?, `view_original_image` = ?, `delete_image` = ?, `delete_album` = ?, `featured_albums` = ?, `add_section` = ?, `manage_sections` = ?,
                `arrange_sections` = ?, `delete_section` = ?, `add_subsection` = ?, `manage_subsections` = ?, `delete_subsection` = ?, `add_coverage` = ?, `manage_coverages` = ?,
                `delete_coverage` = ?, `add_paper_version` = ?, `manage_paper_versions` = ?, `delete_paper_version` = ?, `add_writer` = ?, `manage_writers` = ?,
                `delete_writer` = ?, `manage_keywords` = ?, `delete_keyword` = ?, `add_interactive_file` = ?, `manage_interactive_files` = ?, `delete_interactive_file` = ?,
                `add_user` = ?, `manage_users` = ?, `delete_user` = ?, `add_group` = ?, `manage_groups` = ?, `delete_group` = ?, `add_video` = ?, `manage_videos` = ?,
                `edit_video` = ?, `delete_video` = ?, `users_monitor` = ?, `users_monitor_archive` = ?, `add_metadata` = ?, `manage_metadata` = ?, `delete_metadata` = ?,
                `manage_horoscope` = ?, `open_sections` = ?
                WHERE `group_id` = ?";
        
        $query = $this->db->query($sql, array($add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news, $move_news_to_urgent,
                                              $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control, $view_original_image,
                                              $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections, $delete_section, $add_subsection,
                                              $manage_subsections, $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage, $add_paper_version,
                                              $manage_paper_versions, $delete_paper_version, $add_writer, $manage_writers, $delete_writer, $manage_keywords, $delete_keyword,
                                              $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user, $manage_users, $delete_user, $add_group,
                                              $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video, $delete_video, $users_monitor, $users_monitor_archive,
                                              $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope, $open_sections, $group_id));
    }
    
    
    public function update_group($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news, $move_news_to_urgent,
                                 $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control, $view_original_image, $delete_image,
                                 $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections, $delete_section, $add_subsection, $manage_subsections,
                                 $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage, $add_paper_version, $manage_paper_versions, $delete_paper_version,
                                 $add_writer, $manage_writers, $delete_writer, $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files,
                                 $delete_interactive_file, $add_user, $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video, $manage_videos,
                                 $edit_video, $delete_video, $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope,
                                 $open_sections, $group_id)
    {
        $sql = "UPDATE `groups` SET `name` = ?, `add_news` = ?, `add_news_without_related_articles` = ?, `manage_news` = ?, `view_news_history` = ?, `edit_news` = ?,
                `delete_news` = ?, `move_news_to_urgent` = ?, `move_news_to_reviewed` = ?, `move_news_to_published` = ?, `unlock_news` = ?, `review_news` = ?, `featured_news_control` = ?,
                `banners_control` = ?, `view_original_image` = ?, `delete_image` = ?, `delete_album` = ?, `featured_albums` = ?, `add_section` = ?, `manage_sections` = ?,
                `arrange_sections` = ?, `delete_section` = ?, `add_subsection` = ?, `manage_subsections` = ?, `delete_subsection` = ?, `add_coverage` = ?, `manage_coverages` = ?,
                `delete_coverage` = ?, `add_paper_version` = ?, `manage_paper_versions` = ?, `delete_paper_version` = ?, `add_writer` = ?, `manage_writers` = ?,
                `delete_writer` = ?, `manage_keywords` = ?, `delete_keyword` = ?, `add_interactive_file` = ?, `manage_interactive_files` = ?, `delete_interactive_file` = ?,
                `add_user` = ?, `manage_users` = ?, `delete_user` = ?, `add_group` = ?, `manage_groups` = ?, `delete_group` = ?, `add_video` = ?, `manage_videos` = ?,
                `edit_video` = ?, `delete_video` = ?, `users_monitor` = ?, `users_monitor_archive` = ?, `add_metadata` = ?, `manage_metadata` = ?, `delete_metadata` = ?,
                `manage_horoscope` = ?, `open_sections` = ?
                WHERE `id` = ?";
        
        $query = $this->db->query($sql, array($name, $add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
                                              $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control,
                                              $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections,
                                              $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage,
                                              $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer, $manage_writers, $delete_writer, $manage_keywords,
                                              $delete_keyword, $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user, $manage_users, $delete_user,
                                              $add_group, $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video, $delete_video, $users_monitor,
                                              $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope, $open_sections, $group_id));
        
        // Also update permissions of all users with given group
        $this->update_permissions_of_users_in_group($add_news, $add_news_without_related_articles, $manage_news, $view_news_history, $edit_news, $delete_news,
                                                    $move_news_to_urgent, $move_news_to_reviewed, $move_news_to_published, $unlock_news, $review_news, $featured_news_control, $banners_control,
                                                    $view_original_image, $delete_image, $delete_album, $featured_albums, $add_section, $manage_sections, $arrange_sections,
                                                    $delete_section, $add_subsection, $manage_subsections, $delete_subsection, $add_coverage, $manage_coverages, $delete_coverage,
                                                    $add_paper_version, $manage_paper_versions, $delete_paper_version, $add_writer, $manage_writers, $delete_writer,
                                                    $manage_keywords, $delete_keyword, $add_interactive_file, $manage_interactive_files, $delete_interactive_file, $add_user,
                                                    $manage_users, $delete_user, $add_group, $manage_groups, $delete_group, $add_video, $manage_videos, $edit_video, $delete_video,
                                                    $users_monitor, $users_monitor_archive, $add_metadata, $manage_metadata, $delete_metadata, $manage_horoscope, $open_sections,
                                                    $group_id);
    }
    
    
    public function get_groups($offset, $limit)
    {
        $sql = "SELECT * FROM `groups` ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));
        
        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
	
	
	public function search_groups($token_type, $token_value, $offset, $limit)
    {
        $sql = "SELECT * FROM `groups` WHERE `$token_type` LIKE CONCAT('%', ?, '%') ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($token_value, $offset, $limit));
        
        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
    
}


/* End of file groups_model.php */
/* Location: ./application/modules/groups/models/groups_model.php */