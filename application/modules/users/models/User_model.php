<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User_model
 *
 * @property Group_model $group_model
 * @property Profile_model $profile_model
 */
class User_model extends MY_Model
{
    public $table = 'user_users';
    public $primary_key = 'id';
    public $fillable = [
        'ip_address','username','password','salt','email','activation_code','forgotten_password_code','branch_id',
        'forgotten_password_time','remember_code','active','lang','group_id','last_login'
    ];

    public function __construct()
    {
        $this->has_one['profile'] = ['users/Profile_model', 'user_id', 'id'];
        $this->has_one['group'] = ['users/Group_model', 'id', 'group_id'];
        $this->has_one['branch'] = ['reference/Branch_office_model', 'id', 'branch_id'];

        parent::__construct();
    }

    public function identityCheck($identity = '', $field)
    {
        if (empty($identity)) {
            return false;
        }

        return $this->count_rows([ $field => $identity ]) > 0;
    }

    public function create($data = [], $profile = [])
    {
        $this->_database->trans_start();

        $user_id = $this->insert($data);

        $profile['user_id'] = $user_id;
        $this->load->model('users/profile_model');
        $this->profile_model->insert($profile);

        $this->_database->trans_complete();
        if ($this->_database->trans_status() === FALSE) {
            $this->_database->trans_rollback();
            return false;
        }

        return $user_id;
    }

    public function edit($id, $user, $profile)
    {
        $this->load->model('users/profile_model');

        $this->_database->trans_start();

        $this->update($user, ['id' => $id]);
        $this->profile_model->update($profile, ['user_id' => $id]);

        $this->_database->trans_complete();
        if ($this->_database->trans_status() === FALSE) {
            $this->_database->trans_rollback();
            return false;
        }

        return $id;
    }

    public function remove($id)
    {
        $this->load->model('users/profile_model');

        $this->_database->trans_start();

        $this->delete(['id' => $id]);
        $this->profile_model->delete(['user_id' => $id]);

        $this->_database->trans_complete();
        if ($this->_database->trans_status() === false) {
            $this->_database->trans_rollback();
            return false;
        }

        return true;
    }
}