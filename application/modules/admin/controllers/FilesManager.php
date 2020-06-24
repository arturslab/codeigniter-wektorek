<?php

class FilesManager extends Admin_Controller
{
    function __construct()
    {

        parent::__construct();

        $this->load->model(['admin/files']);
        $group = 'admin';
        if ( ! $this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }

        $this->load->helper('file');
        $this->load->helper('number');

        $this->view_data['module_path'] = '/application/modules/admin';
        $this->view_data['module_url']  = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/';
    }

    public function index()
    {
        $files         = $this->files->get_all('', [], '', '', '', '', false);

        $this->wrapFiles($files);
        //print_r($files); die('dgfdgfdgd');

        $this->view_data['module_description']  = 'W tym miejscu zarządzasz wszystkimi plikami, które dostępne będą w galeriach, sekcji download i innych miejscach serwisu.';
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "files_list";
        $this->view_data['files'] = $files;

        $this->load->view($this->_container, $this->view_data);
    }

    public function get_list()
    {
        $data = [];

        $_data = $this->files->getRows($_POST);
        $i = $_POST['start'];
        foreach($_data as $member){
            $i++;
            $created = date( 'jS M Y', strtotime($v->created_at));
            $status = ($v->status == 1)?'Active':'Inactive';
            $data[] = [$i, $v->name, $v->title, $v->is_image, $v->ext, $v->size, $created, $status];
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->files->countAll(),
            "recordsFiltered" => $this->files->countFiltered($_POST),
            "data" => $data,
        ];

        // Output to JSON format
        echo json_encode($output);
    }

    public function upload()
    {
        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "files_create";

        $this->load->view($this->_container, $this->view_data);
    }

    public function do_upload()
    {
        $config['upload_path']          = './uploads/'; // TODO: Artur rozdziel wedlug typu pliku, np. ./uploads/images/
        $config['allowed_types']        = 'gif|jpg|png|zip|doc|pdf';
        $config['max_size']             = 2048; // 2MB. 0 - brak limitu (limit serwera)
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_ext_tolower']           = TRUE;
        $config['overwrite']           = FALSE; // domyślnie
        //$config['file_name']           = 'nowa_nazwa_pliku.ext'; // Ustaw nazwe pliku z rozszerzeniem. Codeigniter ja zastosuje

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            //$this->view_data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('message', $this->upload->display_errors());
//            redirect('/admin/filesmanager/upload', 'refresh');
        }
        else
        {
            $_data = $this->upload->data();

            $data = $this->prepare_insert_data($_data);
            if($this->insert($data)) {
                $this->session->set_flashdata('message', 'Przesłano plik');
            }
            else {
                $this->session->set_flashdata('message', 'Nie zapisano informacji o pliku w bazie danych.');
            }
//            redirect('/admin/filesmanager', 'refresh');

        }

    }

    // insert do bazy
    private function insert(array $data)
    {
        if (!empty($data)) {
            if($this->files->insert($data)){
                $this->session->set_flashdata('message', 'Plik został zapisany.');
            }
            else {
                $this->session->set_flashdata('message', 'Nie udało się zapisać pliku w bazie danych.');
            }
            redirect('/admin/filesmanager', 'refresh');

        }
        else {
            $this->session->set_flashdata('message', 'Nie udało się przesłać pliku.');
            redirect('/admin/filesmanager', 'refresh');
            return false;
        }

    }

    // Przygotuj dane do insertu
    private function prepare_insert_data($data)
    {
        $db_data = [
            'name' => $data['file_name'],
            'name_hash' => sha1($data['file_name']),
            'type' => '',
            'is_image' => $data['is_image'],
            'image_width' => $data['image_width'],
            'image_height' => $data['image_height'],
            'image_type' => $data['image_type'],
            'ext' => ltrim($data['file_ext'], '.'),
            'size' => (int) $data['file_size']*1024,
            'created_from_ip' => '127.0.0.1',
        ];

        return $db_data;
    }

    public function edit($id)
    {
        // TODO: Artur zezwolic tylko na zmiane wybranych pol
        die('edycja pliku....');
        if ($this->input->post('value')) {
            $data['value'] = $this->input->post('value');
            $this->files->update($data, $id);
            redirect('/admin/filesmanager', 'refresh');
        }
        $setting         = $this->setting->get($id);

        $this->view_data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "files_edit";
        $this->view_data['setting'] = $setting;

        $this->load->view($this->_container, $this->view_data);
    }

    public function delete($id)
    {
        $this->files->delete($id);
        redirect('/admin/filesmanager', 'refresh');
    }

    /**
     * Zwraca tablicę z danymi sformatowanymi do widoku
     *
     * @param $files
     */
    private function wrapFiles(&$files)
    {
        if($files && !empty($files)) {
            foreach($files as $k => $v) {
                $files[$k]['mime'] = get_mime_by_extension($v['name']);
                $files[$k]['size'] = byte_format($v['size']);
            }
        }

    }
}