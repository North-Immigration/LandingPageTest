<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $CountryValue = $_POST['CountryValue'];
    $selected_country_code = $_POST['selectedCountryCode']; 
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location']; 
    $answer = $_POST['answer'];
    $ip_address = get_client_ip();
    $status = 'empty';

    if (!empty($name) || !empty($email) || !empty($CountryValue) || !empty($selected_country_code)  || !empty($phone_number) || !empty($location) || !empty($answer) || !empty($ip_address)) {

        $conn = mysqli_connect("localhost", "NorthCanada", "NorthCanada@2023", "contactform") or die("Connection Error: " . mysqli_error($conn));

        $sql = "INSERT INTO test_contact_us(name, email, country, phone_number,location, answer, ip_address, date) VALUES ('" . $name . "', '" . $email . "', '" . $CountryValue . "', '". $selected_country_code . $phone_number . "', '" . $answer . "', '" . $location . "', '" . $ip_address . "', '" . date('Y-m-d H:i:s') . "')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die(var_dump($conn->connect_error));
        } else {
            $TO = "haneen@northimmigration.com";
            $subject = "Saint lucia contact request landing page";
            $body = '<html> 
                                <head>
                                  <style>
                     table, td, th {   
                        text-align: left;
                        border: 1px solid transparent; 
                       }
                       tr th:first-child, tr td:first-child{
                        border-right: 2px solid #850000; 
                       }
                       tr:last-child td{
                        border-bottom: 1px solid transparent;
                       }
                       tr th, tr td{
                        border-bottom: 1px solid #850000;
                       }
                       tr th{
                          background-color: #ffe0e0;  
                        }
                       table {
                         border-collapse: collapse;
                         width: 100%;
                       }
                       th, td {
                         padding: 10px;
                       }
                 </style>
                                    <title>Saint lucia contact request landing page</title>
                                </head>
                                <body>
                                    <table  border="1" cellspacing="3" width="60%">
                                        <tr>
                                            <th>Name:</th>
                                            <th>' . $name . '</th>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>' . $email . '</td>
                                        </tr>
                                        <tr>
                                        <td>Country:</td>
                                        <td>' . $CountryValue . '</td>
                                    </tr>
                                        <tr>
                                            <td>Phone Number:</td>
                                            <td>+'. $selected_country_code . $phone_number . '</td>
                                        </tr> 
                                        <tr>
                                        <td>location:</td>
                                        <td>' . $location . '</td>
                                         </tr>
                                        <tr>
                                            <td>Nationality:</td>
                                            <td>' . $answer . '</td>
                                        </tr>
                                        <tr>
                                        <td>Laptop IP Address:</td>
                                        <td>' . $ip_address . '</td>
                                    </tr>
                                    </table>
                                </body>
                            </html>';

            // Set additional headers for the email (optional)
            $headers = "From: North@n3plcpnl0066.prod.ams3.secureserver.net\r\n";
           
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";

            // Send the email using the mail function
            if (mail($TO, $subject, $body, $headers)) {
                $status = "success";
            } else {
                $status = "failed";
            }
        }
    }
    echo $status;
    die;
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>