<?php
    $date = date('Y-m-d', strtotime('-4 days', time()));

    $username = 'brianholtz44';
    $password = '9B29EA9B-90F2-4B00-A019-58026C294840';
    $remote_url = 'https://a826-web01.nyc.gov/AMRDataAPI/user/consumption.json?startDate='.$date.'&endDate='.$date;

    // Create a stream
    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header' => "Authorization: Basic " . base64_encode("$username:$password")
        )
    );

    $context = stream_context_create($opts);

    // Open the file using the HTTP headers set above
    $file = file_get_contents($remote_url, false, $context);
    $data = json_decode($file, true);
    $fp = fopen('/var/www/html/its-api/public/dep/csv/'.$date.'.csv', 'w');
    foreach($data['Bldgs'] as $Building){
        $row = [];
        $row[] = $Building['BBL'];
        $row[] = $Building['Accts'][0]['AcctNo'];
        $row[] = $Building['Accts'][0]['Mtrs'][0]['MtrNo'];
        $row[] = $Building['Accts'][0]['Mtrs'][0]['MtrRegs'][0]['RegId'];
        $row[] = $Building['Accts'][0]['Mtrs'][0]['MtrRegs'][0]['MtrRdgs'][0]['Time'];
        $row[] = $Building['Accts'][0]['Mtrs'][0]['MtrRegs'][0]['MtrRdgs'][0]['Value'];
        $row[] = $Building['Accts'][0]['Mtrs'][0]['MtrRegs'][0]['MtrRdgs'][0]['Units'];
        fputcsv($fp, $row);
    }
    fclose($fp);

    // connect and login to FTP server
    $ftp_server = "157.139.225.137";
    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
    $login = ftp_login($ftp_conn, "svc_ftp", "svc_ftp_2017");
    ftp_pasv($ftp_conn, true);
    $file = '/var/www/html/its-api/public/dep/csv/'.$date.'.csv';

    // upload file
    ftp_put($ftp_conn, $date.'.csv', $file, FTP_ASCII);

    // close connection
    ftp_close($ftp_conn);

?>