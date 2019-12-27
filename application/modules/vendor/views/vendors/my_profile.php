<style>
    .edit_anchor{
        position: absolute;
        margin-left: 20px;
        background: #ff9800;
        border-radius: 14px;
        padding: 1px 5px;
        cursor: pointer;
    }
    .errorPrint{
        font-size: 12px;
        color: #196e2f;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Vendor Detail</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?= base_url('admin/dashboard'); ?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                        Vendor Detail

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

            </div>





            <!--page title end-->
            <div class="container-fluid">
                <!-- state start-->
                <div class="row">

                    <div class="col-lg-12"  id="detailDive">
                        <div class="panel profile-cover" >
                            <div class="profile-cover__img">
                                
                                <?php if ($user['image']) {
                                    ?>
                                    <img src="<?= $user['image']; ?>" alt="" style="width: 100px;height: 100px;">
                                    <?php
                                } else {
                                    ?>
                                    <img src="https://library.kissclipart.com/20180901/krw/kissclipart-user-thumbnail-clipart-user-lorem-ipsum-is-simply-bfcb758bf53bea22.jpg" alt="">
                                    <?php
                                }
                                ?>
                                <h3 class="h3"><?= $user['name']; ?></h3>
                            </div>
                            <div class="profile-cover__action bg--img" data-overlay="0.3" style="background:url('../assets/admin/images/admin/userback.jpg') no-repeat;background-size: cover;">
                                <button class="btn btn-rounded btn-info" onclick="edit();">
                                    <i class="fa fa-edit"></i>
                                    <span>Edit Profile
                                    </span>
                                </button>
                                <!--<a onclick="showProfile(this);" class="btn btn-rounded btn-info">-->
                                <!--    <i class="fa fa-edit"></i>-->
                                <!--    <span>Edit Detail</span>-->
                                <!--</a>-->
                            </div>
                            <div class="profile-cover__info">
                                <ul class="nav">

                                    <li>
                                        <strong><?= $order_count ?></strong>Order
                                    </li>
                                    <li>
                                        <strong><?= $booking_count ?></strong>Booking
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('response') ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">About Me</h3>
                                <!--<a class="panel-title" onclick="deleteUser(this,'<?= $user['id']; ?>')" style="position: absolute;margin-left: 192px;cursor: pointer;">-->
                                <!--    <i class="fa fa-trash fa-2x"></i></a>-->
                            </div>
                            <div class="panel-content panel-about">
<!--                                    <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem odit esse quae, et praesentium eligendi, corporis minima
                                    repudiandae similique voluptatum dolorem temporibus doloremque.
                                </p>-->
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <i class="fa fa-envelope"></i>Email</th>
                                            <td><?= $user['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fa fa-mobile-phone"></i>Mobile No.</th>
                                            <td>
                                                <a href="#" class="btn-link"><?= $user['mobile']; ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fa fa-vcard-o"></i>Company Name</th>
                                            <td><?php
                                                if ($user['shop_name']) {
                                                    echo $user['shop_name'];
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fa fa-map-marker"></i>Location</th>
                                            <td>
                                                <?php
                                                if ($user['address']) {
                                                    echo $user['address'];
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fa fa-calendar"></i>Register Date</th>
                                            <td><?= date('Y-m-d H:i:s', $user['created_at']); ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--                         <div class="panel">
                                                            <div class="panel-heading ">
                                                                <h3 class="panel-title">Company Detail</h3>
                                                            </div>
                                                            <div class="panel-content panel-about">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-user"></i>Name</th>
                                                                            <td>Souqalasal</td>
                                                                        </tr>
                        
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-map-marker"></i>Locatoin</th>
                                                                            <td>123 Lorem Steet, NY, United States.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-mobile-phone"></i>Mobile No.</th>
                                                                            <td>
                                                                                <a href="#" class="btn-link">731-839-7510</a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <i class="fa fa-globe"></i>Email</th>
                                                                            <td>
                                                                                <a href="#" class="btn-link">Ronery08@gmail.com</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                        
                                                        </div>-->

                    </div>
                    <div class="edit col-md-12" id="updateDive" style="<?= $this->session->flashdata('error_response') ? 'display:block' : 'display:none' ?>">
                        <?=$this->session->flashdata('error_response')?>
                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Edit My Profile

                                </div>

                            </div>

                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" action="<?=base_url()?>vendor/edit-profile" id="profileForm"> 
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <span class="error text-danger" id="file_upload"></span>

                                                <div class="form-group row titleeventimage">
                                                    <div class="col-sm-3 file-upload">
                                                        <img id="blah1" src="<?php echo base_url(); ?>assets/vendor/common/images/logo/dummy.jpg" alt="your image" />
                                                        <label for="upload1" class="file-upload__label">Upload Image </label>
                                                        <input id="upload1" accept=".jpg,.png,.jpeg" class="file-upload__input" type="file" name="file_upload" onchange="readURL(this, 1);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <span class="error text-danger" id="name"></span>
                                                <?=form_error('name')?>
                                                <input type="text" name="name" class="form-control validate" value="<?= $user['name']; ?>" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <span class="error text-danger" id="mobile"></span>
                                                <?=form_error('mobile')?>
                                                <input type="number" onchange="checkMobile(this);" name="mobile" class="form-control" value="<?= $user['mobile']; ?>" placeholder="Mobile">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <?=form_error('shop_name')?>
                                                <span class="error text-danger" id="shop_name"></span>
                                                <input type="text" name="shop_name" class="form-control validate" value="<?= $user['shop_name']; ?>" placeholder="Company Name">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">

                                                <label>Address</label>
                                                <span class="error text-danger" id="latitude"></span>
                                                <?=form_error('latitude')?>
                                                <div value="" placeholder="Enter Location" class="form-control validate" id="map" style="width:478px;height:200px;background:grey"></div>

                                                <div class="pac-card" id="pac-card">

                                                    <div id="pac-container">

                                                        <input id="pac-input" class="form-control validate" onkeyup="checkLocation(this);" type="text" name="address" placeholder="Enter a location" value="<?= $user['address']; ?>">
                                                        <input id="lat" type="hidden" value="<?= $user['lat']; ?>" class='validate' placeholder="latitude" name="latitude">
                                                        <input id="lng" type="hidden" value="<?= $user['lng']; ?>" class="validate" placeholder="longitude" name="longitude">

                                                    </div>
                                                </div>
                                                <div id="map"></div>
                                                <div id="infowindow-content">
                                                    <img src="" width="16" height="16" id="place-icon">
                                                    <span id="place-name"  class="title"></span><br>
                                                    <span id="place-address"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 ml-auto">
                                            <button type="button" onclick="validate();" class="btn btn-primary" name="signup" value="Sign up">Update</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- state end-->
            </div>


        </main>

    </div>

</div>
<script>
    function edit() {
        $('.edit').css('display', 'block');
        $('html, body').animate({
            scrollTop: $(".edit").offset().top
        }, 1000);

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
        var formData = $("#profileForm").find('.validate:input').not(':input[type=button]');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0' || val == null) {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });

        if (flag) {
            $('#profileForm').submit();
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
                var message = 'mobile invalid';
            } else {
                if (mobile.length < 6 || mobile.length > 15) {
                    valid_mobile = false;
                    var message = 'mobile invalid';
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

</script>