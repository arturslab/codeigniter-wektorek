<?php
class CategoriesSeeder extends Seeder
{
    private $table = 'categories';

    public function run()
    {

        $this->db->truncate($this->table);

        //seed records manually
        $records = [
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Blog',
                'slug' => 'blog',
                'title' => 'Kategorie sekcji Blog',
                'description' => 'Kategorie artykułów do sekcji Blog',
                'created_from_ip' => '127.0.0.1',
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'name' => 'Humor',
                'slug' => 'humor',
                'title' => 'Kategorie sekcji Humor',
                'description' => 'Kategrie dowcipów do sekcji Humor',
                'created_from_ip' => '127.0.0.1',
            ],
            [
                'id' => 3,
                'parent_id' => 2,
                'name' => 'Szkolna ława',
                'slug' => 'szkolna_lawa',
                'title' => 'Dowcipy ze szkolnej ławy',
                'description' => 'Dowcipy znane ze szkolnych zeszytów',
                'created_from_ip' => '127.0.0.1',
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'name' => 'Baca',
                'slug' => 'baca',
                'title' => 'Dowcipy o bacy',
                'description' => 'Żarty i dowcipy o bacy',
                'created_from_ip' => '127.0.0.1',
            ],
            [
                'id' => 5,
                'parent_id' => 2,
                'name' => 'Różne',
                'slug' => 'rozne',
                'title' => 'Różne dowcipy',
                'description' => 'Żarty i dowcipy nie pasujące do iinych kategorii',
                'created_from_ip' => '127.0.0.1',
            ],
        ];

        echo 'Seeding ' . count($records) . ' records for ' . $this->table . ' table.';

        foreach ($records as $data) {
            if(isset($data['name']) && !empty($data['name'])) {
                echo ".";
                $this->db->insert($this->table, $data);
            }
        }
        echo PHP_EOL;
    }
}