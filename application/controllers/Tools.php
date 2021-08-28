<?php

require APPPATH . 'database/Seeder.php';

/**
 * Class Tools
 *
 * Klasa obsługująca migracje z poziomu konsoli
 * Wywołanie:
 * php index.php tools help
 */
class Tools extends MY_Controller
{

    /**
     * Tools constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // can only be called from the command line
        if ( ! $this->input->is_cli_request()) {
            exit('Direct access is not allowed. This is a command line tool, use the terminal');
        }
        $this->load->dbforge();
        // initiate faker
        $this->faker = Faker\Factory::create();
    }

    /**
     * Wyświetla w konsoli dostepne polecenia
     * Wywołanie: php index.php tools help
     *
     */
    public function help()
    {
        $result = "The following are the available command line interface commands\n\n";
        $result .= "php index.php tools migration \"file_name\" Create new migration file\n";
        $result .= "php index.php tools migrate [\"version_number\"] Run all migrations. The version number is optional.\n";
        $result .= "php index.php tools seeder \"file_name\" Creates a new seed file.\n";
        $result .= "php index.php tools seed \"file_name\" Run the specified seed file.\n";
        $result .= "php index.php tools model \"model_name\" Create new model file in folder /application/modules/admin/models/ .\n";
        echo $result . PHP_EOL;
    }

    /**
     * Tworzy nowy plik migracji
     *
     * @param string $name - Nazwa tabeli w bazie danych
     */
    public function migration(string $name)
    {
        $this->make_migration_file($name);
    }

    /**
     * @param null $version
     */
    public function migrate($version = null)
    {
        $this->load->library('migration');
        if ($version != null) {
            if ($this->migration->version($version) === false) {
                show_error($this->migration->error_string());
            } else {
                echo "Migrations run successfully" . PHP_EOL;
            }

            return;
        }
        if ($this->migration->latest() === false) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations run successfully" . PHP_EOL;
        }
    }

    /**
     * Tworzy plik z danymi testowymi
     *
     * @param string $name - Nazwa tabeli w bazie danych
     */
    public function seeder(string $name)
    {
        $this->make_seed_file($name);
    }

    public function seed($name)
    {
        $seeder = new Seeder();
        $seeder->call($name);
    }

    public function model($name)
    {
        $this->make_model_file($name);
    }

    protected function make_model_file($name)
    {
        $path = APPPATH . "modules/admin/models/$name.php";

        if(file_exists($path)) {
            die("Model file already exist!");
        }

        $my_model = fopen($path, "w") or die("Unable to create model file!");
        $model_template
            = "<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); 
            class $name extends MY_Model 
            { 
                public function __construct() 
                { 
                    parent::__construct(); 
                } 
            } ";
        fwrite($my_model, $model_template);
        fclose($my_model);
        echo "$path model has successfully been created." . PHP_EOL;
    }

    /**
     * @param string $name - Nazwa tabeli w bazie danych
     */
    protected function make_migration_file(string $name)
    {
        $date       = new DateTime();
        $timestamp  = $date->format('YmdHis');
        $table_name = strtolower($name);
        $path       = APPPATH . "database/migrations/$timestamp" . "_" . "$name.php";

        if(file_exists($path)) {
            die("Migration file already exist!");
        }

        $my_migration = fopen($path, "w") or die("Unable to create migration file!");
        $migration_template
            = "<?php 
            class Migration_$name extends CI_Migration 
            { 
                public function up() 
                { 
                    \$this->dbforge->add_field([
                        'id' => [
                            'type' => 'INT', 
                            'constraint' => 11,
                            'unsigned' => TRUE, 
                            'auto_increment' => TRUE 
                        ],
                        'is_active' => [
                            'type' => 'INT', 
                            'constraint' => 1, 
                            'default' => 1,
                            'comment' => '1=Active | 0=Inactive'
                        ],
                        'name' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                            'unique' => TRUE,
                        ],
                        'title' => [
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                        ],
                        'description' => [
                            'type' => 'TEXT',
                            'null' => TRUE,
                        ],
                        'created_from_ip' => [
                            'type' => 'VARCHAR', 
                            'constraint' => 100,
                            'comment' => 'Log user IP on create record'
                        ],
                        'updated_from_ip' => [
                            'type' => 'VARCHAR', 
                            'constraint' => 100,
                            'comment' => 'Log user IP on update record'
                        ],
                        'created_at DATETIME DEFAULT current_timestamp',
                        'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp',
                    ]); 
                    \$this->dbforge->add_key('id', TRUE); 
                    \$attributes = ['ENGINE' => 'InnoDB'];
                    \$this->dbforge->create_table('$table_name', FALSE, \$attributes); 
                } 
                
                public function down() 
                { 
                    \$this->dbforge->drop_table('$table_name'); 
                }
             }";
        fwrite($my_migration, $migration_template);
        fclose($my_migration);
        echo "$path migration has successfully been created." . PHP_EOL;
    }

    /**
     * Tworzy plik z danymi testowymi do importu do bazy danych
     *
     * @param string $name - Nazwa tabeli w bazie danych
     */
    protected function make_seed_file(string $name)
    {
        $path = APPPATH . "database/seeds/$name.php";
        $table_name = str_replace('seeder', '', strtolower($name));

        if(file_exists($path)) {
            die("Seed file already exist!");
        }

        $my_seed = fopen($path, "w") or die("Unable to create seed file!");
        $seed_template
            = "<?php 
        class $name extends Seeder 
        { 
            private \$table = '{$table_name}';
             
            public function run() 
            { 
            
                \$this->db->truncate(\$this->table); 
                
                // Seed records manually 
                \$records = [
                    [ 
                        'name' => 'Name 1', 
                        'title' => 'Title 1',
                        'description' => 'Lorem ipsum 1',
                        'created_from_ip' => '127.0.0.1',
                    ],
                    [ 
                        'name' => 'Name 2', 
                        'title' => 'Title 2',
                        'description' => 'Lorem ipsum 2',
                        'created_from_ip' => '127.0.0.1',
                    ],
                ];
                
                echo 'Seeding ' . count(\$records) . ' records for ' . \$this->table . ' table.';
                
                foreach (\$records as \$data) {
                    if(isset(\$data['name']) && !empty(\$data['name'])) {
                        echo \".\"; 
                        \$this->db->insert(\$this->table, \$data);
                    }
                }
                
                
                // Initiate faker
                \$this->faker = Faker\Factory::create();
                
                // Seed many records using faker 
                \$limit = 20; 
                echo \"seeding \$limit user accounts\"; 
                for (\$i = 0; \$i < \$limit; \$i++) { 
                    echo \".\"; 
                    \$data = [ 
                        'user_name' => \$this->faker->unique()->userName, 
                        'password' => '1234', 
                        'name' => \$this->faker->unique()->word,
                        'title' => \$this->faker->unique()->word,
                        'created_from_ip'    => \$this->faker->ipv4,
                        'updated_from_ip'    => \$this->faker->ipv4,
                        'created_at'    => \$this->faker->date(\$format = 'Y-m-d'),
                        'updated_at'    => \$this->faker->date(\$format = 'Y-m-d'),
                        'email'    => \$this->faker->unique()->email,
                    ];
                    \$this->db->insert(\$this->table, \$data); 
                } 
                echo PHP_EOL; 
            }
        }";
        fwrite($my_seed, $seed_template);
        fclose($my_seed);
        echo "$path seeder has successfully been created." . PHP_EOL;
    }
}