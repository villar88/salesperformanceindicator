@extends('app')

@section('content')
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
    <form method="POST" action="{{ url('/licenses/shoppingcart') }}" accept-charset="UTF-8" class="form-horizontal" mothod="POST">
        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 rounded-form-container">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  rounded-form">
                <h3 class="text-right">Payment Information</h3>
                <div class="form-group marg-top-30">
                    <label for="cardType" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Card Type*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                        <select class="form-control"  id="cardType" name="cardType" size="1" data-on="Component.Select">
                            <option value="">Select Your Card</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="Visa">Visa</option>
                            <option value="Discover">Discover</option>
                            <option value="American Express">American Express</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cnumber" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Credit Card Number*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="cnumber" type="text" id="cnumber"></div>
                </div>
                <div class="form-group">
                    <label for="month" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Month</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                        <select class="form-control"  id="month" name="month" size="1" data-on="Component.Select">
                            <option value="">Select Month</option>
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
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="year" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Year</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
                        <select class="form-control"  id="year" name="year" size="1" data-on="Component.Select">
                            <option value="">Select Year</option>
                            <option value="2015">2015</option>
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
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>
            
                <h3 class="text-right">Product Information</h3>
                <div class="form-group marg-top-30">
                    <label for="cnumber" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Product Name*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">licenses</div>
                </div>
                <div class="form-group">
                    <label for="Quantity" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right" >Quantity</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter">
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
                <div class="form-group">
                    <label for="total" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Total Price</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter" style="padding-top: 20px;" id="total">$ 15.00 (Total amount that will be added to your existing monthly billing amount.)</div>
                </div>
                <div class="col-md-12 text-right pad0">
                    <input class="btn btn-primary vcenter" type="submit" value="Submit">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  rounded-form">
                <h3 class="text-right">Billing Information</h3>
                <div class="form-group marg-top-30">
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
                <div class="form-group">
                    <label for="emailAddress" class="col-md-3 col-sm-3 col-xs-3 control-label vcenter pad0 text-right">Email Address*</label><div class="col-md-9 col-sm-9 col-xs-9 vcenter"><input class="form-control" required="required" name="emailAddress" type="text"></div>
                </div>
              </div> 
        </div>
        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
    </form>   
</div>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center back-to-top">
            <a href="#" class="icon-godaddy icon-big100">&nbsp;</a>
        </div>
        <div class="col-lg-12 text-center back-to-top">
            <a href="#" class="icon-ssl icon-big">&nbsp;</a>
        </div>
    </div>
</div>
<script>
    function cal(val) {
        var ammount = val * 15;
        document.getElementById('totle').innerHTML = '$ ' + ammount + '.00';
    }
</script>
@endsection

