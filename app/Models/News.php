<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'unit_id', 'unit_module', 'news_item_type', 'title', 'status', 'access_type', 'timeout_date', 'logo', 'body', 'created_at', 'updated_at', 'added_by',
        'logo_base_url'
    ];
    public $changes;

    public function __construct($data = '') {
        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }
    public $incrementing= false;

    
    public function set($data) {
        $this->unit_module = $data['unit_module'];
        $this->unit_id = $data['unit_id'];
        $this->news_item_type = $data['news_item_type'];
        $this->title = $data['title'];
        $this->status = $data['status'];
        $this->access_type = $data['access_type'];
        $this->timeout_date = $data['timeout_date'];
        $this->logo = $data['logo'];
        $this->body = $data['body'];
        $this->created_at = $data['created_at'];
        $this->added_by = $data['added_by'];
        $this->updated_at = $data['updated_at'];
        $this->logo_base_url = config('WEBSITE_URL').config('app_config.uploads_images_dir').config('app_config.news_image_dir_medium');


        if ($this->id <= 0) {
            
        }
    }

    public function changes($data) {

        if (isset($data['status']) && $data['status'] == $this->status) {
            $data['status_date'] = $this->status_date;
        }

        //on edit get changes
        if ($this->title) {
            $this->changes = get_user_changes($data, $this);

            if (!empty($this->changes)) {
                foreach ($this->changes as $field => &$values) {
                    switch ($field) {
                        case 'status':
                            $values['new_val'] = get_status($values['new_val']);
                            $values['old_val'] = get_status($values['old_val']);
                            break;
                    }
                }
            }
        }
    }

}
