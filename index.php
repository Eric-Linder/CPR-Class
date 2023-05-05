            <?php
                include('./Config/config.php');
            ?>
            
            <?php
                $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname","$dbusername","$dbpassword");
                $query = $dbh->prepare("SELECT COUNT(session) AS EIGHT FROM `cprclass` WHERE session='8PM'");
                $query->execute();
                $confirmaton = $query->fetch(PDO::FETCH_ASSOC);
                // print('<h1>EIGHT: '.$confirmaton['EIGHT'].'</h1>');
                $eight = $confirmaton['EIGHT'];

                $query = $dbh->prepare("SELECT COUNT(session) AS TENAM FROM `cprclass` WHERE session='10AM'");
                $query->execute();
                $confirmaton = $query->fetch(PDO::FETCH_ASSOC);
                // print('<h1>EIGHT: '.$confirmaton['EIGHT'].'</h1>');
                $tenam = $confirmaton['TENAM'];
             ?>

<?php  include('./Includes/header.php'); ?>
<script>
    var dt = new Date();
    dt.setFullYear(new Date().getFullYear()-16);

    $('#datepicker').datepicker(
        {
            viewMode: "years",
            endDate : dt
        }
    );
</script>

<?php
        /*

        fname
        middle e
        lname

        home address
        phone
        email
        age [drop down start 16 - 99]
        */

        /*
        max 50 (possibly increase)
        do not display 

        2 sessions
        10AM
        8PM

        prompt to other session if full
        Output as spreadsheet

        */

        // id="add_to_cart"

        /*

        After Successful registration
        the user should get a confirmation page
        that shows unique registration number
        or barcode or UR code. Something they
        can download and present - although in 
        actuality they won't be required show anything

        full address street, city, zip 
        all required except apt no.
         
        All fields required except apt no.

        -- on successful registration user
        gets email and a page with confirmation 
        number

        Date of Birth DOB - instead of drop-down for age.
        If user is younger than 16 they cannot register.

        put donation button on the landing page
        and in the email

        */
   ?>
<div class="container minheight">
   <div class="row">
      <div class="container newsletter_container">
         <?php
            // if (isset($_GET['message'])){
            //     print('<div class="alert alert-danger" role="alert">');
            //     print(stripslashes($_GET['message']));
            //     print('</div>');
            // }
            ?>
         <!-- <form class="col-md-6 offset-md-3" method="POST" action="./">
            <h3 class="title">Sign Up For Newsletter</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="signincode" id="signincode" placeholder="Sign in with code">
            </div>
            <button type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i>&nbsp; Sign in</button>
            </form>  -->

            <script>
                var placeSearch, autocomplete;

                // List all address components (corresponds to form field IDs and Google address object)
                var componentForm = {
                autocomplete: ['street_number', 'route'],
                inputCity: 'locality',
                inputState: 'administrative_area_level_1',
                inputZip: 'postal_code',
                inputCounty: 'administrative_area_level_2',
                inputCountry: 'country'
                };

                // Create autocomplete object based on the autocomplete ("street") field
                // Location type restricted to geocode
                function initAutocomplete() {
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */ (document.getElementById('autocomplete')),
                    {type: ['geocode']});

                // Call fillInAddress when user selects an address from dropdown
                autocomplete.addListener('place_changed', fillInAddress);
                }

                // Fill fields with values from Google Maps autocomplete object
                function fillInAddress() {

                // Get place data from autocomplete object
                var place = autocomplete.getPlace();
                console.log(place);
                
                // Enable each field, then fill them with the corresponding value from the place object
                for (var component in componentForm) {
                    document.getElementById(component).disabled = false;
                    document.getElementById(component).value = search(componentForm[component], place.address_components);
                }

                // Original Google Implementation - do not use
                // Get each component of the address from the place
                // object and fill the corresponding field
                //   for (var i = 0; i < place.address_components.length; i++) {

                //     var addressType = place.address_components[i].types[0];

                //     if (componentForm[addressType]) {
                //       var val = place.address_components[i][componentForm[addressType]];
                //       document.getElementById(addressType).value = val;
                //     }
                //   }
                
                // Fill the autocomplete field with values from the place object
                // If a street number is not found, set the field to route only.
                if (search("street_number", place.address_components) != "") {
                    document.getElementById("autocomplete").value = search("street_number", place.address_components) + " ";
                }
                document.getElementById("autocomplete").value += search("route", place.address_components);
                
                // Search the passed object for a specified address component/type and return the short_name value of the matched component/type
                // If requested type does not exist in the placeObject, return an empty string
                function search(type, placeObject) {
                    for (var i = 0; i < placeObject.length; i++) {
                    if (placeObject[i].types[0] === type) {
                        return placeObject[i].short_name;
                    } else if (i === placeObject.length - 1) {
                        return "";
                    }
                    }
                }
                }
            </script>


         <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onloadTurnstileCallback" defer></script>

         <!-- <script>
            window.onloadTurnstileCallback = function () {
            turnstile.render('#example-container', {
            sitekey: '0x4AAAAAAAEUWVl7kkpksetT',
            callback: function(token) {
               console.log(`Challenge Success ${token}`);
            },
            });
            };
         </script> -->

         <!-- <div id="example-container">
            <form action="/login" method="POST">
               <input type="text" placeholder="username"/>
               <input type="password" placeholder="password"/>
               <div class="cf-turnstile" data-sitekey="0x4AAAAAAAEUWVl7kkpksetT'"></div>
               <button type="submit" value="Submit">Log in</button>
            </form>
            </div> -->
         <!-- <div class="cf-turnstile"></div> -->
         <!-- <div id="example-container"> -->
         <!-- <form class="col-md-6 offset-md-3" method="POST" action="bounce.newcustomer.php"> -->
        <div id="example-container">
        <form class="col-md-6 offset-md-3" method="POST" action="bounce.cprclass.php#jumsuccess">
            <input type="hidden" name="submit" value="submit"/>
            <div class="form-group">
               <label for="fname"><span class="required_field">&#x2a;</span> First Name</label>
               <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="form-group">
               <label for="middle"> Middle Initial</label>
               <input type="text" class="form-control" id="middle" name="middle">
            </div>
            <div class="form-group">
               <label for="lname"><span class="required_field">&#x2a;</span> Last Name</label>
               <input type="text" class="form-control" id="lname" name="lname" required>
            </div>

            <div class="form-group">
               <label for="clientemail"><span class="required_field">&#x2a;</span> Email Address</label>
               <input type="email" class="form-control" id="clientemail" name="clientemail" required>
            </div>

            <!-- <div class="form-group">
                <label for="clientphone"><span class="required_field">&#x2a;</span> Phone Number:</label>
                <input type="tel" class="form-control" id="clientphone" name="clientphone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                <small>Format: 123-456-7890</small>
            </div> -->


            <div class="form-group">
                <label for="clientphone"><span class="required_field">&#x2a;</span> Phone Number:</label>
                <input type="text" class="form-control" id="clientphone" name="clientphone" required>
            </div>

            
            <br/>
            <div class="form-group">
                <table class="table" id="address_table">
                    <tr><td><span class="required_field">&#x2a;</span> Street</td><td><input type="street" class="form-control" name="inputStreet" id="autocomplete" required></td></tr>
                    <tr><td><span class="required_field">&#x2a;</span> City</td><td><input type="city" class="form-control" name="inputCity" id="inputCity" required></td></tr>
                    <tr><td><span class="required_field">&#x2a;</span> State</td><td><input type="state" class="form-control" name="inputState" id="inputState" required></td></tr>
                    <tr><td><span class="required_field">&#x2a;</span> Zip Code</td><td><input type="zip" class="form-control" name="inputZip" id="inputZip" required></td></tr>
                    <tr><td> Apt No.</td><td><input type="text" class="form-control" name="inputAptNo" id="inputAptNo"></td></tr>
                </table>
            </div>

            <br/>


            <!-- <div class="form-group" style="background: #f8f8f8; padding: 20px; border: solid #ccc 1px;">
                <h4><span class="required_field">&#x2a;</span>  Birthdate</h4>
                <p><i>Must be at least 16</i></p>
             <input type="date" name="birthdate" value="" min="2007-05-21" style="width: 100%; border: solid #ccc 1px;" required>
            </div>
            <br/> -->


            <div class="form-group" style="background: #f8f8f8; padding: 20px; border: solid #ccc 1px;">
                <h4><span class="required_field">&#x2a;</span>  Birthdate</h4>
                <p><i>Must be at least 16</i></p>
             <input type="date" name="birthdate" max="2007-05-21" style="width: 100%; border: solid #ccc 1px;" required>
              </div>
            <br/>


            <div class="form-group">
                <h4><span class="required_field">&#x2a;</span>  Choose Session</h4>
                <?php // print('<p>Count 8PM:  '.$eight.'</p>');?>
                 <?php  // print('<p>Count 10AM: '.$tenam.'</p>');?>
               <table class="table" style="border: solid #ccc 1px;">
                    <tr>  
                        <?php if($tenam < 51 ){ ?>
                        <td style="background: #f8f8f8;">
                            <input type="radio" id="10AM" name="choose_session" value="10AM" required>
                            <label for="html">&nbsp;10AM</label>
                        </td>
                        <?php }else{ ?>
                        <td style="background: #f8f8f8;" id="closed_session">
                            <i>Session Full</i>
                            <label for="html">&nbsp;10AM</label>
                        </td>
                      <?php } ?>
                    </tr>                  
                    <tr>  
                        <?php if($eight < 51){ ?>
                        <td style="background: #f8f8f8;">                          
                            <input type="radio" id="8PM" name="choose_session" value="8PM" required>
                            <label for="html">&nbsp;8PM</label>
                        </td>
                        <?php }else{ ?>
                        <td style="background: #f8f8f8;" id="closed_session">
                            <i>Session Full</i>
                            <label for="html">&nbsp;8PM</label>
                        </td>
                      <?php  } ?>
                    </tr>
                    <tr>
                        <td style="background: #f8f8f8;">
                            <input type="radio" id="future" name="choose_session" value="future" required>
                            <label for="html">&nbsp;Future Session</label>
                            <p><i>Unable to attend? Get notified of future sessions</i></p>
                        </td>
                    </tr>
               </table>
            </div>
            <br/>
            <div class="cf-turnstile" data-sitekey="0x4AAAAAAAEUWVl7kkpksetT"></div> 
            <br/>
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
         <!-- </div> -->
      </div>
    </div>
   </div>
</div>
<?php include('./Includes/footer.php'); ?>
