<?php
//----------------------------------------------------------------------
// based on :
// http://php.net/manual/fr/function.fgetcsv.php#68213
//
// Usage :
//
// $importer = new CsvImporter($CSV,',',true);
// if(!$importer->headerExists('URL')) {echo 'Missing column URL in the CSV.'; exit;}
// foreach($importer->get() as $num=>$ligne) {
//    print_r($ligne);
//    }
//----------------------------------------------------------------------

class CsvImporter 
    { 
    private $fp; 
    private $parse_header; 
    private $header; 
    private $delimiter; 
    private $length;

    function __construct($file_name, $delimiter=';', $parse_header=true, $length=8000) {
        $this->fp = fopen($file_name, 'r'); 
        $this->parse_header = $parse_header; 
        $this->delimiter = $delimiter; 
        $this->length = $length; 

        if ($this->parse_header) { 
            $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
            $this->header = array_map('trim',$this->header ); // // $array=array_map('trim',$array); fait un trim sur chaque val du tableau
            }
        } 

    function __destruct() { 
        if ($this->fp) { 
            fclose($this->fp); 
            } 
        } 

    function headerExists($h) {
        if ($this->parse_header) {
            if(in_array($h,$this->header)) {return true;}
            }
        return false;
        }

    function get($max_lines=0) { 
        //if $max_lines is set to 0, then get all the data 

        $data = array(); 

        if ($max_lines > 0) 
            $line_count = 0; 
        else 
            $line_count = -1; // so loop limit is ignored 

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) { 
            if ($this->parse_header) { 
                foreach ($this->header as $i => $heading_i) {
                    if(!isset($row[$i])) {$row[$i]='';}
                    $row_new[$heading_i] = trim($row[$i]);
                    } 
                $data[] = $row_new;
                } 
            else { 
                $data[] = array_map('trim',$row);  // $array=array_map('trim',$array); fait un trim sur chaque val du tableau
                } 

            if ($max_lines > 0) 
                $line_count++; 
                }

        return $data; 
        } // get()

    } // CsvImporter
