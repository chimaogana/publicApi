<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DegreeTitle extends Model {

    protected $table = 'degree_titles';
    protected $primaryKey = 'degree_title_id';
    protected $fillable = [
        'degree_title_short_code', 'degree_title_name', 'slug'
    ];
    public $changes;

    public function degree() {
        return $this->belongsTo('App\Models\Degree', 'degree_id', 'degree_id');
    }

    public function __construct($data = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->degree_title_short_code = $data['degree_title_short_code'];
        $this->degree_title_name = $data['degree_title_name'];
        $this->degree_id = $data['degree_id'];
        $this->slug = \UtilsManager::create_slug($this->table,$this->degree_title_name,(isset($this->primaryKey)?$this->primaryKey:'id'));
        if ($this->degree_title_id <= 0) {
            
        }
    }

    public function changes($data) {

        if (isset($data['status']) && $data['status'] == $this->status) {
           // $data['status_date'] = $this->status_date;
        }

        //on edit get changes
        if ((int) $this->degree_title_id) {
            $this->changes = get_user_changes($data, $this);

            if (!empty($this->changes)) {
                foreach ($this->changes as $field => &$values) {
                    switch ($field) {
                        case 'status':
                            $values['new_val'] = get_status($values['new_val']);
                            $values['old_val'] = get_status($values['old_val']);
                            break;
                        case 'degree_title_id':
                            $values['new_val'] = \CommonDao::get_table_data('degree_titles', $values['new_val'], 'degree_title_id', 'degree_title_name');
                            $values['old_val'] = \CommonDao::get_table_data('degree_titles', $values['old_val'], 'degree_title_id', 'degree_title_name');
                            break;
                    }
                }
            }
        }
    }

}
