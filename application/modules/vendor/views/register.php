

<div class="login-form">
    <?= $this->session->flashdata('response'); ?>
    <form id="registerForm" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Name</label>
            <span class="error text-danger" id="name"></span>
            <input type="text" class="form-control validate" placeholder="Enter Your Name" name="name" value="<?= set_value('name') ?>">
            <?= form_error('name') ?>
        </div>

        <div class="form-group">
            <label>Shop Name</label>
            <span class="error text-danger" id="shop_name"></span>
            <input type="text" class="form-control validate" placeholder="Enter Shop Name" name="shop_name" value="<?= set_value('shop_name') ?>">
            <?= form_error('shop_name') ?>
        </div>
        <div class="form-group">
            <label>Email address</label>
            <span class="error text-danger" id="email"></span>
            <input type="email" onkeyup="checkEmail(this);" class="form-control validate" placeholder="Email" name="email" value="<?= set_value('email') ?>">
            <?= form_error('email') ?>
        </div>

        <div class="form-group">

            <label>Password</label>
            <span class="error text-danger" id="password"></span>
            <input type="password" class="form-control validate" placeholder="Password" name="password" id="myInput">
            <input type="checkbox" onclick="myFunction()">Show Password
            <?= form_error('password') ?>
        </div>
        <!-- 
                                <div class="form-group">
        
                                    <label>Mobile Number</label>
                                    <span class="error text-danger" id="mobile"></span>
                                    <input type="Number" onkeyup="checkMobile(this);" class="form-control" placeholder="Enter Mobile Number" name="mobile">
        
                                </div> -->

        <div class="form-group">

            <label>Address</label>
            <span class="error text-danger" id="latitude"></span>
            <div value="" placeholder="Enter Location" class="form-control validate" id="map" style="width:478px;height:200px;background:grey"></div>

            <div class="pac-card" id="pac-card">

                <div id="pac-container">

                    <input id="pac-input" class="form-control validate" onkeyup="checkLocation(this);" type="text" name="address" placeholder="Enter a location" value="<?= set_value('address') ?>">
                    <input id="lat" type="hidden" value="<?= set_value('latitude') ?>" class='validate' placeholder="latitude" name="latitude">
                    <input id="lng" type="hidden" value="<?= set_value('longitude') ?>" class="validate" placeholder="longitude" name="longitude">

                </div>
            </div>
            <div id="map"></div>
            <div id="infowindow-content">
                <img src="" width="16" height="16" id="place-icon">
                <span id="place-name"  class="title"></span><br>
                <span id="place-address"></span>
            </div>
        </div>
        <div class="form-group">
            <label>Image</label>
            <span class="error text-danger" id="file_upload"></span>

            <div class="form-group row titleeventimage">
                <div class="col-sm-6 file-upload">
                    <img id="blah1" src="<?php echo base_url(); ?>assets/vendor/common/images/logo/dummy.jpg" alt="your image" />
                    <label for="upload1" class="file-upload__label">Upload Image </label>
                    <input id="upload1" accept=".jpg,.png,.jpeg" class="file-upload__input validate" type="file" name="file_upload" onchange="readURL(this, 1);">
                </div>
            </div>
        </div>

        <button type="button" onclick="validate();" class="btn btn-success btn-flat m-b-30 m-t-30">Sign Up</button>

    </form>
    <div class="register-link m-t-15 text-center">
        <p>Already have account ?
            <a href="<?php echo base_url('vendor'); ?>"> Sign in </a>
        </p>
    </div>

</div>

</div>

</div>

</div>

<script src="<?php echo base_url('assets/vendor/common/js/jquery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/popper.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/Chart.bundle.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/utils.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/chart.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/custom.js'); ?>"></script>

</body>

</html>
<script type="text/javascript">
                function myFunction() {
                    var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
</script>
<script>
    function initMap() {
        var test = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: test
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script> 
<script async defer 
        src= 
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCzPCjYZGjfQyRKanR7NMOyxmRAJIS0A-Y&libraries=places&callback=initMap">
</script> 
<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
                ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            } else {
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lng').value = place.geometry.location.lng();
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);

                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function () {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
                .addEventListener('click', function () {
                    console.log('Checkbox clicked! New state=' + this.checked);
                    autocomplete.setOptions({strictBounds: this.checked});
                });
    }
</script>
<script>

    function validate() {
        var flag = true;
        var formData = $("#registerForm").find('.validate:input').not(':input[type=button]');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0') {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });

        if (flag) {
            $('#registerForm').submit();
        } else {
            return false;
        }

    }

    function checkMobile(obj) {
        var valid_mobile = true;
        var mobile = $(obj).val();
        if (mobile) {
            var regex = /^([0-9])+$/;
            if (!regex.test(mobile)) {
                valid_mobile = false;
                $('#mobile').html('mobile invalid');
                message = 'mobile invalid';
            } else {
                if (mobile.length < 6 || mobile.length > 15) {
                    valid_mobile = false;
                    message = 'mobile invalid';
                    $('#mobile').html('mobile invalid');
                } else {
                    valid_mobile = true;
                    $('#mobile').html('');

                }
            }
            return valid_mobile;
        } else {
            return valid_mobile;
        }
    }

    function checkEmail(obj) {
        var valid = true;
        var email = $(obj).val();
        if (email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                valid = false;
                $('#email').html('email invalid');
                message = 'email invalid';
            } else {
                if (mobile.length < 6 || mobile.length > 15) {
                    valid = false;
                    message = 'email invalid';
                    $('#email').html('email invalid');
                } else {
                    valid_mobile = true;
                    $('#email').html('');

                }
            }
            return valid_mobile;
        } else {
            return valid_mobile;
        }
    }
</script>