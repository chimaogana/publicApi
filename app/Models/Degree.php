<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model {

    protected $table = 'degrees';
    protected $primaryKey = 'degree_id';
    protected $fillable = [
        'degree_name', 'degree_code', 'acad_level_code', 'status'
    ];
    public $changes;

    public function degree_titles() {
        return $this->hasMany('App\Models\DegreeTitle', 'degree_id', 'degree_id');
    }

    public function __construct($data = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->degree_name = $data['degree_name'];
        $this->degree_code = $data['degree_code'];
        $this->acad_level_code = $data['acad_level_code'];
        $this->status = $data['status'];
        $this->slug = \UtilsManager::create_slug($this->table, $this->degree_name, (isset($this->primaryKey) ? $this->primaryKey : 'id'));
        if ($this->degree_id <= 0) {
            
        }
    }

    public function changes($data) {


        //on edit get changes
        if ((int) $this->degree_id) {
            $this->changes = get_user_changes($data, $this);

            if (!empty($this->changes)) {
                foreach ($this->changes as $field => &$values) {
                    switch ($field) {
                        case 'status':
                            $values['new_val'] = get_status($values['new_val']);
                            $values['old_val'] = get_status($values['old_val']);
                            break;
                        case 'acad_level_code':
                            $values['new_val'] = get_acad_lvl_name($values['new_val']);
                            $values['old_val'] = get_acad_lvl_name($values['old_val']);
                            break;
                    }
                }
            }
        }
    }

}
