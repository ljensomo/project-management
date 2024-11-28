<?php

require_once 'DatabaseQuery.php';

class DatabaseBackup extends DatabaseQuery{

    public function __construct(){
        parent::__construct(null);
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
    
        $file = '../database/db-backup-' . date('YmdHis') . '.sql';
        file_put_contents($file, $sqlDump);

        return $file;
    }
}