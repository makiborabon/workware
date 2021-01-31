<?php
    //Connection to database
    mysql_connect("localhost","root","kawnacge");
    mysql_select_db("new_db");

    $result = mysql_query("SELECT * FROM tbl_product");
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysql_num_fields($result);

    $headers = array();

  // Creating headers for output files
    for ($i = 0; $i < $num_fields; $i++)
    {
        $headers[] = mysql_field_name($result , $i);
    }

    $fp = fopen('php://output', 'w');
    if ($fp && $result)
    {
    // name of file with date
        $filename = "jobPostingReport-".date('Y-m-d').".csv";
        
            // Setting header types for csv file.
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);

            while ($row = mysql_fetch_row($result))
            {
                 fputcsv($fp, array_values($row));
            }
            die;
     }
?>