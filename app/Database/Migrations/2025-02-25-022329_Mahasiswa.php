<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'npm' => [
                'type'           => 'INT',
                'constraint'     => 7,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_mahasiswa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_matkul' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' =>'50',
            ],
            'prodi' => [
                'type' => 'VARCHAR',
                'constraint' =>'30',
            ],
            'prodi' => [
                'type' => 'VARCHAR',
                'constraint' =>'30',
            ],
            'tahun_akademik' => [
                'type' => 'YEAR',
                'constraint'     => 4,
            ],
            
        ]);
        $this->forge->addKey('npm', true);
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}