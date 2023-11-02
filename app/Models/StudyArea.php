<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyArea extends Model {

    protected $table = 'study_areas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'study_area_code', 'study_area_title', 'status'
    ];
    public $changes;

    public function __construct($data = '') {
        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->study_area_code = $data['study_area_code'];
        $this->study_area_title = $data['study_area_title'];
        $this->status = $data['status'];
        if ($this->id <= 0) {
            
        }
    }

    public function changes($data) {

        if (isset($data['status']) && $data['status'] == $this->status) {
            $data['status_date'] = $this->status_date;
        }

        //on edit get changes
        if ((int) $this->id) {
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
