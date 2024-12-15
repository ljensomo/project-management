<?php

require_once 'DatabaseQuery.php';

class DatabaseBackup extends DatabaseQuery{

    const table = 'database_backups';

    private $backup_id;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setBackupId($backup_id){
        $this->backup_id = $backup_id;
    }

    // generates a mysql dump to backup tables and records
    public function doBackup(){

        $this->setFetchMode(PDO::FETCH_NUM);

        // get all tables
        $tables_query = "SHOW FULL TABLES";
        $this->setQuery($tables_query);
        $tables = $this->fetchAll();

        $sqlDump = "";

        foreach ($tables as $table) {

            if($table[1] == 'BASE TABLE'){
                $this->setQuery("SHOW CREATE TABLE $table[0]");
                $table_result = $this->fetch();
                $sqlDump .= "\n\n" . $table_result[1] . ";\n\n";
        
                $this->setQuery("SELECT * FROM $table[0]");
                $table_rows = $this->fetchAll();
                $columnCount = $this->getColumnCount();
    
                foreach($table_rows as $row){
                    $sqlDump .= "INSERT INTO $table[0] VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = $row[$j] !== null ? $this->getPDO()->quote($row[$j]) : "NULL";
                        $sqlDump .= $row[$j] . ($j < ($columnCount - 1) ? ',' : '');
                    }
                    $sqlDump .= ");\n";
                }
            }
            
            if($table[1] == 'VIEW'){
                $this->setQuery("SHOW CREATE VIEW $table[0]");
                $table_result = $this->fetch();
                $sqlDump .= "\n\n" . $table_result[1] . ";\n\n";
            }
    
            $sqlDump .= "\n\n\n";
        }

        $filename = 'db-backup-' . date('YmdHis') . '.sql';
    
        $file = '../database/'.$filename;
        file_put_contents($file, $sqlDump);

        $this->createEntry($filename);

        return $file;
    }

    public function createEntry($filename){
        $this->sqlInsert([
            'filename' => $filename
        ]);
    }

    public function getAllBackups(){
        return $this->sqlFetchAll();
    }

    public function delete($id){

        $backup = $this->sqlFetchById($id);
        unlink('../database/'.$backup['filename']);

        return $this->sqlDelete($id);
    }
}