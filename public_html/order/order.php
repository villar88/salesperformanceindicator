<?php
$dbhost = "localhost";
$dbname = "salesper_metrics";
$dbuser		= "salesper_order";
$dbpass		= "{|!@#order@31}";
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);



if (isset($_POST['ajaxemail'])) {
    $email = $_POST['ajaxemail'];
    $sql = "SELECT id FROM  users WHERE email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo $result[0]['id'];
    exit;
}

if (isset($_POST['first_name'])) {

    require_once("infusion/isdk.php");
    $app = new iSDK;
    if ($app->cfgCon("connectionName")) {
        $qry = array('Email' => $_POST['emailAddress']);
        $ret = array("Id");
        $dups = $app->dsQuery("Contact", 1, 0, $qry, $ret);
        if (empty($dups)) {
            $contact = array(
                "FirstName" => $_POST['first_name'],
                "LastName" => $_POST['last_name'],
                "State" => $_POST['state'],
                "Phone1" => $_POST['phoneNumber'],
                "City" => $_POST['city'],
                "Email" => $_POST['emailAddress'],
                "Address1Type" => $_POST['addressLine1'],
                "ZipFour1" => $_POST['zipCode'],
                "Country" => $_POST['country'],
                "Company" => $_POST['company'],
            );
            $date = date('d/m/y');
            $cid = $app->addCon($contact);
        } else {
            $cid = $dups[0]['Id'];
            $contact = array(
                "FirstName" => $_POST['first_name'],
                "LastName" => $_POST['last_name'],
                "State" => $_POST['state'],
                "Phone1" => $_POST['phoneNumber'],
                "City" => $_POST['city'],
                "Email" => $_POST['emailAddress'],
                "Address1Type" => $_POST['addressLine1'],
                "ZipFour1" => $_POST['last_name'],
                "Country" => $_POST['last_name'],
                "Company" => $_POST['company'],
            );
            $contact_ID = $app->updateCon($cid, $contact);
        }
        $fullname = explode(" ", $_POST['nameoncard']);
        $card['FirstName'] = $fullname[0];
        $card['LastName'] = $fullname[1];
        $card['CardNumber'] = $_POST['cnumber'];
        $card['ExpirationMonth'] = $_POST['cardmonth'];
        $card['ExpirationYear'] = $_POST['cardyear'];
        $card['CVV2'] = $_POST['CVV'];
        $result = $app->validateCard($card);
        if ($result['Valid'] == 'false') {
            $error = "Order cancel due to credit card";
        } else {
            $ccid = $app->dsAdd("CreditCard", $card);
            //$timezone = new DateTimeZone( "America/New_York" );
            //$date = new DateTime();
            //$date->setTimezone( $timezone );
            $currentDate = date('Y-m-d H:i:s');
            $oDate = $app->infuDate($currentDate);
            try {
                $invID = $app->blankOrder($cid, "Order for Licenses" . $cid, $oDate, 0, 0);
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
            $ord = $app->getOrderId($invID);
            $Quantity = $_POST['Quantity'];
            $subID = array();
            for ($i = 1; $i <= $Quantity; $i++) {
                $app->addOrderItem((int) $invID, (int) 50, (int) 4, (double) 0.1, (int) 1, 'Licenses Item' . $i, '');
                $_intproductid = $app->addRecurringAdv((int) $cid, true, (int) 34, (int) 1, (double) 0.1, false, (int) 2, (int) $ccid, (int) 0, (int) 30);
                $_nextBillDate = date("d-m-Y", strtotime("1 Months + 1 day"));
                $subID[$i] = $_intproductid;
                $thedate = $app->infuDate($_nextBillDate);
                $app->updateSubscriptionNextBillDate($_intproductid, $thedate);
                $service["Frequency"] = 1;
                $service["BillingCycle"] = 2;
                $app->dsUpdate("RecurringOrder", $_intproductid, $service);
            }
            $payStat = $app->chargeInvoice((int) $invID, "Payment Via API", (int) $ccid, (int) 2, false);
            if (substr($payStat['Message'], 0, 2) == "91") {
                $payStat = $app->chargeInvoice((int) $invID, "Payment Via API", (int) $ccid, (int) 2, false);
            }
            if ($payStat['RefNum'] != "E" && $payStat['Code'] == "APPROVED") {

                $email = $_POST['emailAddress'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $address1 = $_POST['addressLine1'];
                $address2 = $_POST['addressLine1'];
                $contact_number = $_POST['phoneNumber'];
                $company = $_POST['company'];
                $created_by = 0;
                $created_at = date('Y-m-d H:i:s');
                $sql = "SELECT id,company_id FROM  users WHERE email='$email'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if (!empty($result)) {
                    $user_id = $result[0]['id'];
                    $company_id = $result[0]['company_id'];
                } else {
                    $sql = "INSERT INTO companies (name,status,created_by,created_at,updated_by) VALUES (:name,:status,:created_by,:created_at,:updated_by)";
                    $q = $conn->prepare($sql);
                    $q->execute(array(':name' => $company,
                        ':status' => 'ACTIVE', ':created_by' => 0, ':created_at' => $created_at, ':updated_by' => 0));
                    $company_id = $conn->lastInsertId();
                    $manager_id = 0;

                    $sql = "INSERT INTO users (email,first_name,last_name,address1,address2,contact_number,role_id,company_id,manager_id,password,created_by,updated_by) VALUES (:email,:first_name,:last_name,:address1,:address2,:contact_number,:role,:company_id,:manager_id,:password,:created_by,:updated_by)";
                    $q = $conn->prepare($sql);
                    $q->execute(array(':email' => $email,
                        ':first_name' => $first_name, ':last_name' => $last_name, ':address1' => $address1, ':address2' => $address1, ':contact_number' => $contact_number, ':role' => 4, ':company_id' => $company_id, ':manager_id' => 0, ':password' => '$2y$10$HutAwgWnlrlJxAPtcum4Qua.kLJ7DUvskVJKf1qeJjBY7YyqqeITW', ':updated_by' => 1, ':created_by' => 1));
                    $user_id = $conn->lastInsertId();
                    $sql = "INSERT INTO goal_managements (user_id,jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,annual,created_by,created_at) VALUES (:user_id,:jan,:feb,:mar,:apr,:may,:jun,:jul,:aug,:sep,:oct,:nov,:annual,:created_by,:created_at)";
                    $q = $conn->prepare($sql);
                    $q->execute(array(':user_id' => $user_id,
                        ':jan' => '10000', ':feb' => '10000', ':mar' => '10000', ':apr' => '10000', ':may' => '10000', ':jun' => '10000', ':jul' => '10000', ':aug' => '10000', ':sep' => '10000', ':oct' => '10000', ':nov' => '10000', ':annual' => '120000', ':created_by' => 0, ':created_at' => $created_at));
                    $sql = "UPDATE companies SET created_by=" . $user_id . " , updated_by=" . $user_id . " WHERE id=" . $company_id;
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                }
                for ($i = 1; $i <= $Quantity; $i++) {
                    $license_key = $subID[$i];
                    $sql = "INSERT INTO licenses (company_id,user_id,start_date,status,license_key,created_at,created_by) VALUES (:company_id,:user_id,:start_date,:status,:license_key,:created_at,:created_by)";
                    $q = $conn->prepare($sql);
                    $q->execute(array(':company_id' => $company_id,
                        ':user_id' => $user_id, ':start_date' => $created_at, ':status' => 'ACTIVE', ':license_key' => "$license_key", ':created_at' => $created_at, ':created_by' => $user_id));
                }
                $error = "Your Order is placed";
            } else {
                $error = "Order cancel due payment";


                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metrics Solution</title>
        <link href="https://salesperformanceindicator.com/app/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/bootstrap.css">
        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/fixes.css">
        <link rel="stylesheet" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/bootswatch.min.css">
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="js/validationEngine.jquery.css" type="text/css"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
        </script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img class="hidden-xs hidden-sm img-responsive" src="https://salesperformanceindicator.com/app/images/modLogo.png" alt="logo description" />
                        <img class="hidden-xs visible-sm img-responsive" src="https://salesperformanceindicator.com/app/images/modLogo-half.png" alt="logo description" />
                        <img class="visible-xs img-responsive" src="https://salesperformanceindicator.com/images/app/modLogo-small.png" alt="logo description" />
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><img class="img-responsive" src="https://salesperformanceindicator.com/app/images/presented-edited.png" />&nbsp;</li>
                    </ul>
                </div>


            </div>
        </nav>
        <br><br><br><br><br>
        <script>
            jQuery(document).ready(function () {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#godown').height($("#ss_fixed_nav").height());
                window.onresize = function () {
                    $('#godown').height($("#ss_fixed_nav").height());
                }
            });
        </script>
        <div class="container-fluid">



            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div class="credit-cards-icons col-md-6 col-sm-12 col-xs-12">
                        <div class="icons-container">
                            <a href="#" class="icon-visa">&nbsp;</a>
                            <!-- <a href="#" class="icon-paypal">&nbsp;</a> -->
                            <a href="#" class="icon-master-card">&nbsp;</a>
                            <a href="#" class="icon-discover">&nbsp;</a>
                            <a href="#" class="icon-american-express">&nbsp;</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="POST" id="formID" action="" accept-charset="UTF-8" class="form-horizontal" mothod="POST">
                    <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 rounded-form-container">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  rounded-form">
                            <input name="_token" type="hidden" value="hGt13WOCPmicV6AKWMgR6vcZoVz9jW9heQEkx4VV">
                            <h3 class="text-right">Billing Information</h3>

                            <div class="form-group marg-top-30">
                                <label for="usertype" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">User Type</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <div><input  name="usertype" id="exist" type="radio">&nbsp;&nbsp;&nbsp;Existing User</div>
                                    <div><input  name="usertype" id="new" type="radio" checked="checked">&nbsp;&nbsp;&nbsp;New User</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="first_name" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">First Name*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="first_name" type="text"></div>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Last Name*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="last_name" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="company" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Company*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="company" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="addressLine1" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Address Line1*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="addressLine1" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">City*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="city" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="state" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">State*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="state" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="zipCode" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Zip Code*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="zipCode" type="text"></div>
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Country*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control" id="role_id" name="country" onchange="setAction('2')">
                                        <option value="">Please select one</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Democratic Republic Of Congo">Democratic Republic Of Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Côte D'Ivoire">Côte D'Ivoire</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard and McDonald Islands">Heard and McDonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Republic of Macedonia">Republic of Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Réunion">Réunion</option>
                                        <option value="St. Barthélemy">St. Barthélemy</option>
                                        <option value="St. Helena, Ascension and Tristan Da Cunha">St. Helena, Ascension and Tristan Da Cunha</option>
                                        <option value="St. Kitts And Nevis">St. Kitts And Nevis</option>
                                        <option value="St. Lucia">St. Lucia</option>
                                        <option value="St. Martin">St. Martin</option>
                                        <option value="St. Pierre And Miquelon">St. Pierre And Miquelon</option>
                                        <option value="St. Vincent And The Grenedines">St. Vincent And The Grenedines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard And Jan Mayen">Svalbard And Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phoneNumber" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Phone Number*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="phoneNumber" type="text"></div>
                            </div>
                            <!--<div class="form-group ">
                                <label for="phoneNumber	" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Phone Number*</label>
                                <div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control validate[required,custom[phone]]"  name="phoneNumber" type="text"></div>
                            </div>-->
                            <div class="form-group">
                                <label for="emailAddress" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Email Address*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="emailAddress" type="text" ></div>
                            </div>
                            <!--<div class="form-group ">
                                <label for="emailAddress" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Email Address*</label>
                                <div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control validate[required,custom[email]]"  name="emailAddress" id="email" type="text"onblur="checkemail(this.value)"></div>
                            </div>-->
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  rounded-form">
                            <h3 class="text-right">Payment Information</h3>
                            <div class="form-group" style="margin-top: 30px;">
                                <label for="nameoncard" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Name On Card*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="nameoncard" type="text"></div>
                            </div>
                            <!--<div class="form-group marg-top-30">
                                <label for="nameoncard" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Name On Card*</label>
                                <div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control validate[required]"  name="nameoncard" type="text"></div>
                            </div>-->

                            <div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Card Type</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control"  name="cardType" size="1" data-on="Component.Select"><option value="">Select Your Card</option><option value="MasterCard">MasterCard</option><option value="Visa">Visa</option><option value="Discover">Discover</option><option value="American Express">American Express</option></select>
                                </div>
                            </div>
                            <!--<div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Card Type</label>
                                <div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control validate[required]"  name="cardType" size="1" data-on="Component.Select"><option value="">Select Your Card</option><option value="MasterCard">MasterCard</option><option value="Visa">Visa</option><option value="Discover">Discover</option><option value="American Express">American Express</option></select>
                                </div>
                            </div>-->


                            <div class="form-group">
                                <label for="cnumber" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Credit Card Number*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control validate[required]"  name="cnumber" type="text"></div>
                            </div>

                            <div class="form-group">
                                <label for="CVV" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">CVV*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control validate[required]"  name="CVV" type="text" ></div>
                            </div>


                            <div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Month</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control validate[required]"  name="cardmonth" size="1" data-on="Component.Select"><option value="">Select Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option><option value="12">12</option></select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Year</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control validate[required]" name="cardyear" size="1" data-on="Component.Select"><option value="">Select Year</option><option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2016">2016</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  rounded-form">
                            <h3 class="text-right">Product Information</h3>
                            <div class="form-group marg-top-30">
                                <label for="cnumber" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Product Name*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">licenses</div>
                            </div>

                            <div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Quantity</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                                    <select class="form-control"  id="Quantity" name="Quantity" size="1" data-on="Component.Select" onchange="cal(this.value)">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>



                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Total Price</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter" id="totle">
                                    $ 15.00
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="	" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right"> </label>
                                <div class="col-md-9 col-sm-9 col-xs-9 vcenter"> <input class="btn btn-primary" type="submit" value="Place Order"></div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
                </form>

            </div>

            <script>
                function cal(val) {
                    var ammount = val * 15;
                    document.getElementById('totle').innerHTML = '$ ' + ammount + '.00';
                }
            </script>
        </div>
        <div class="container-fluid">
            <footer>
                <div class="row">
                    <br /><br /><br />
                    <div class="col-lg-12 text-center back-to-top">
						<a href="#" class="icon-godaddy icon-big100">&nbsp;</a>
					</div>
					<div class="col-lg-12 text-center back-to-top">
						<a href="#" class="icon-ssl icon-big">&nbsp;</a>
					</div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center back-to-top">
                        <a class="btn btn-default" href="#top">Back to top</a>
                    </div>
                    <br /><br /><br />
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-unstyled">
                            <li>
                                <div class="footer-copyright">
                                    <div class="container text-center">
                                        Sales Performance Indicator | &copy; 2014-2015 Good as Gold Training, All rights reserved.<br />
                                        <a class="grey-text text-lighten-4 right" href="mailto:support@staffingandrecruiting.com">support@staffingandrecruiting.com | 219 663 9609</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </footer>
        </div>


    </body>
</html>
<script>
    function checkemail(val) {
        var data = 'ajaxemail=' + val;
        if (document.getElementById('exist').checked == true) {
            var exist = 1;
        } else {
            var exist = 0;
        }
        $.ajax({
            url: '<?php echo $_SERVER['REQUEST_URI']; ?>',
            type: 'POST',
            data: data,
            success: function (data) {
                if (exist == 1 && data == '') {
                    alert('You are not exist in our system');
                    document.getElementById('email').value = '';
                }
                if (exist == 0 && data != '') {
                    alert('Email already exists in your system');
                    document.getElementById('email').value = '';
                }
            }
        });
    }
</script>