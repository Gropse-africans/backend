
    <footer>
    <div class="content_footer_top">
        <div class="container"></div>
    </div>

    <div id="footer" class="container">
        <div class="row">
            <div class="footer-blocks">
                <div class="footer-right">
                    <div class="content_footer_left"></div>
                </div>
                <div class="footer-left">
                    <div id="block_3" class="footer-area">
                        <div id="info" class="col-sm-3 column">
                            <h5>About</h5>
                            <ul class="list-unstyled">
                                <li><a href="<?=base_url();?>about-us">About Us</a></li>
                                <li><a href="<?=base_url();?>delivery-information">Delivery Information</a></li>
                                <li><a href="<?=base_url();?>privacy-policy">Privacy Policy</a></li>
                                <li><a href="<?=base_url();?>term-and-condition">Terms &amp; Conditions</a></li>
                                <li><a href="<?=base_url();?>contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                        <div id="extra-link" class="col-sm-3 column">
                            <h5>Help</h5>
                            <ul class="list-unstyled">
                                <li><a href="<?=base_url();?>">Specials</a></li>
                                <li><a href="<?=base_url();?>">Brands</a></li>
                                <li><a href="<?=base_url();?>">Special Discount</a></li>
                                <li><a href="<?=base_url();?>">Specials</a></li>
                                <li><a href="<?=base_url();?>">Wish List</a></li>
                            </ul>
                        </div>
                        <div id="account_link" class="col-sm-3 column">
                            <h5>Policy</h5>
                            <ul class="list-unstyled">
                                <li><a href="<?=base_url();?>">Policy</a></li>
                                <li><a href="<?=base_url();?>">Order History</a></li>
                                <li><a href="<?=base_url();?>">Wish List</a></li>
                                <li><a href="<?=base_url();?>">Affiliates</a></li>
                                <li><a href="<?=base_url();?>">Newsletter</a></li>
                            </ul>
                        </div>

                    </div>

                    <div id="block_4" class="footer-area">
                        <div class="content_footer_right">
                            <div id="block_1" class="footer-area col-sm-3 column">
                                <h5 class="toggle">Address</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="address">
                                            <div class="address-icon"></div>
                                            <div class="contact_address">184 DBD Rd, St IPS Road PLC 3021, South Africa</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="email">
                                            <div class="email-icon"></div>
                                            <a href="#">contact@africanssupermarket.com</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact">
                                            <div class="contact-icon"></div>
                                            <div class="contact_phone">++253 2233 456 / +253 3265 666</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="newsletter col-sm-3 column">

                                <h5 class="toggle">Subscribe Now</h5>

                                <ul class="list-unstyled">

                                    <span class="news-title2">Subscribe to our newsletter get 10% off your first purchase at here for update.</span>
                                    <form method="post">
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-firstname">Enter Your ID</label>
                                            <div class="input-news">
                                                <input type="email" name="txtemail" id="txtemail" value="" placeholder="Enter Your ID" class="form-control input-lg" />

                                                <button type="submit" class="btn btn-default btn-lg" onclick="return subscribe();">Subscribe</button>

                                            </div>

                                        </div>
                                    </form>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bottomfooter">
        <div class="container">
            <div class="row">

                 <ul class="list-unstyled">
                    <li><a href="<?=base_url()?>">Specials</a></li>
                    <li><a href="<?=base_url()?>">Affiliates</a></li>
                    <li><a href="<?=base_url()?>">Special Discount</a></li>
                    <li><a href="<?=base_url()?>">Brands</a></li>
                </ul>


                <p class="powered">Powered By <a href="<?=base_url()?>">Africa Supermarket</a> Your Store &copy; 2019</p>
                <div class="content_footer_bottom">
                    <div id="paymentcmsblock" class="paymentcmsblock">
                        <p></p>
                        <div class="payment-block">
                            <ul>
                                <img src="<?=base_url()?>assets/web/images/catalog/visa.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/discover.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/maestro.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/master.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/paypal.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/american-express.png">
                                <img src="<?=base_url()?>assets/web/images/catalog/mastercard.png">
                            </ul>
                        </div>
                        <p></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="searchlocation" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Select Your Address</h4>
      </div>
      <div class="modal-body">
            <div class="pac-card" id="pac-card">
              <div>
                <div id="title">
                  Autocomplete search
                </div>
              </div>
              <div id="pac-container">
                  <form method="post" name="location_form" id="location_form">
                    <input id="pac-input" onkeyup="checkLocation(this);" type="text" name="address" placeholder="Enter a location">
                    <input id="lat" type="hidden" placeholder="latitude" name="latitude">
                    <input id="lng" type="hidden" placeholder="longitude" name="longitude">
                    <button type="button" onclick="saveLocation();" disabled="true" id="location_btn" class="btn btn-success  locationbth">Submit</button>
                  </form>
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
  </div>
</div>
<div class="modal fade " id="loginModal" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">You are not logged in</h4>
                <button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <p>Please log in to continue.</p>

                <div class="row md-form mb-5">
                    <div class='col-md-12'>
                        <a class="mx-auto" href="<?= base_url() ?>login"><button class="btn btn-default" type="button">Login</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

            <script src="<?=base_url()?>assets/web/js/jquery-2.1.1.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/bootstrap.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/owl.carousel.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.countdown.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.countdown.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.magnific-popup.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/moment.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/moment-with-locales.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/bootstrap-datetimepicker.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/swiper.jquery.js"></script>
            <script src="<?=base_url()?>assets/web/js/common.js"></script>
            <script src="<?=base_url()?>assets/web/js/jstree.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/carousel.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/megnor.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.custom.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.formalize.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/jquery.elevatezoom.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/bootstrap-notify.min.js"></script>
            <script src="<?=base_url()?>assets/web/js/tabs.js"></script>
            <script src="<?=base_url()?>assets/web/js/lightbox-2.6.min.js"></script>
             
            <script src="<?=base_url()?>assets/web/js/custom.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js">
            
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

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }else{
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
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzPCjYZGjfQyRKanR7NMOyxmRAJIS0A-Y&libraries=places&callback=initMap"
        async defer></script>
            <script type="text/javascript">
                         
              var popkey= $.cookie('pop');
                 if ((typeof popkey == 'undefined') || (popkey == 1)) {
                     $("#searchlocation").modal("show");
                 }
            </script>
            <script type="text/javascript">
                  $('#tabs a').tabs();
             </script> 
            <script> 
					function quickbox(){
					 if ($(window).width() > 767) {
					    $('.quickview-button').magnificPopup({
					      type:'iframe',
					      delegate: 'a',
					      preloader: true,
					      tLoading: 'Loading image #%curr%...',
					    });
					 }  
					}
					jQuery(document).ready(function() {quickbox();});
					jQuery(window).resize(function() {quickbox();});
			</script>
                  <script type="text/javascript"><!--
$('#slideshow0').swiper({
      mode: 'horizontal',
      slidesPerView: 1,
      pagination: '.slideshow0',
      paginationClickable: true,
      nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    spaceBetween: 0,
         autoplay: 2500,
    autoplayDisableOnInteraction: true,
      loop: true,
  effect:'fade'
});
--></script>
<script type="text/javascript">
      // Can also be used with $(document).ready()
      $(window).load(function() {         
        $("#spinner").fadeOut("slow");
      });   
</script>

<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
  $.ajax({
    url: 'index.php?route=product/product/getRecurringDescription',
    type: 'post',
    data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
    dataType: 'json',
    beforeSend: function() {
      $('#recurring-description').html('');
    },
    success: function(json) {
      $('.alert-dismissible, .text-danger').remove();

      if (json['success']) {
        $('#recurring-description').html(json['success']);
      }
    }
  });
});
//--></script> 
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
  $.ajax({
    url: 'index.php?route=checkout/cart/add',
    type: 'post',
    data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
    dataType: 'json',
    beforeSend: function() {
      $('#button-cart').button('loading');
    },
    complete: function() {
      $('#button-cart').button('reset');
    },
    success: function(json) {
      $('.alert-dismissible, .text-danger').remove();
      $('.form-group').removeClass('has-error');

      if (json['error']) {
        if (json['error']['option']) {
          for (i in json['error']['option']) {
            var element = $('#input-option' + i.replace('_', '-'));

            if (element.parent().hasClass('input-group')) {
              element.parent().before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            } else {
              element.before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
            }
          }
        }

        if (json['error']['recurring']) {
          $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
        }

        // Highlight any found errors
        $('.text-danger').parent().addClass('has-error');
      }

      if (json['success']) {
        $.notify({
          message: json['success'],
          target: '_blank'
        },{
          // settings
          element: 'body',
          position: null,
          type: "info",
          allow_dismiss: true,
          newest_on_top: false,
          placement: {
            from: "top",
            align: "center"
          },
          offset: 0,
          spacing: 10,
          z_index: 2031,
          delay: 5000,
          timer: 1000,
          url_target: '_blank',
          mouse_over: null,
          animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
          },
          onShow: null,
          onShown: null,
          onClose: null,
          onClosed: null,
          icon_type: 'class',
          template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-success" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">&nbsp;&times;</button>' +
            '<span data-notify="message"><i class="fa fa-check-circle"></i>&nbsp; {2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
              '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
          '</div>' 
        });

        $('#cart > button').html('<div class="cart_detail"><div class="cart_image"></div><span id="cart-total"> ' + json['total'] + '</span>'  + '</div>');

        //$('html, body').animate({ scrollTop: 0 }, 'slow');

        $('#cart > ul').load('index.php?route=common/cart/info ul li');
      }
    },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
  });
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
  language: 'en-gb',
  pickTime: false
});

$('.datetime').datetimepicker({
  language: 'en-gb',
  pickDate: true,
  pickTime: true
});

$('.time').datetimepicker({
  language: 'en-gb',
  pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
  var node = this;

  $('#form-upload').remove();

  $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

  $('#form-upload input[name=\'file\']').trigger('click');

  if (typeof timer != 'undefined') {
      clearInterval(timer);
  }

  timer = setInterval(function() {
    if ($('#form-upload input[name=\'file\']').val() != '') {
      clearInterval(timer);

      $.ajax({
        url: 'index.php?route=tool/upload',
        type: 'post',
        dataType: 'json',
        data: new FormData($('#form-upload')[0]),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $(node).button('loading');
        },
        complete: function() {
          $(node).button('reset');
        },
        success: function(json) {
          $('.text-danger').remove();

          if (json['error']) {
            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
          }

          if (json['success']) {
            alert(json['success']);

            $(node).parent().find('input').val(json['code']);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }
  }, 500);
});
//--></script> 
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=30');

$('#button-review').on('click', function() {
  $.ajax({
    url: 'index.php?route=product/product/write&product_id=30',
    type: 'post',
    dataType: 'json',
    data: $("#form-review").serialize(),
    beforeSend: function() {
      $('#button-review').button('loading');
    },
    complete: function() {
      $('#button-review').button('reset');
    },
    success: function(json) {
      $('.alert-dismissible').remove();

      if (json['error']) {
        $('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
      }

      if (json['success']) {
        $('#review').after('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

        $('input[name=\'name\']').val('');
        $('textarea[name=\'text\']').val('');
        $('input[name=\'rating\']:checked').prop('checked', false);
      }
    }
  });
});

//$(document).ready(function() {
//  $('.thumbnails').magnificPopup({
//    type:'image',
//    delegate: 'a',
//    gallery: {
//      enabled: true
//    }
//  });
//});


$(document).ready(function() {
if ($(window).width() > 767) {
    $("#tmzoom").elevateZoom({
        
        gallery:'additional-carousel',
        //inner zoom         
                 
        zoomType : "inner", 
        cursor: "crosshair" 
        
        /*//tint
        
        tint:true, 
        tintColour:'#F90', 
        tintOpacity:0.5
        
        //lens zoom
        
        zoomType : "lens", 
        lensShape : "round", 
        lensSize : 200 
        
        //Mousewheel zoom
        
        scrollZoom : true*/
        
        
      });
    var z_index = 0;
                  
                  $(document).on('click', '.thumbnail', function () {
                    $('.thumbnails').magnificPopup('open', z_index);
                    return false;
                  });
              
                  $('.additional-carousel a').click(function() {
                    var smallImage = $(this).attr('data-image');
                    var largeImage = $(this).attr('data-zoom-image');
                    var ez =   $('#tmzoom').data('elevateZoom');  
                    $('.thumbnail').attr('href', largeImage);  
                    ez.swaptheimage(smallImage, largeImage); 
                    z_index = $(this).index('.additional-carousel a');
                    return false;
                  });
      
  }else{
    $(document).on('click', '.thumbnail', function () {
    $('.thumbnails').magnificPopup('open', 0);
    return false;
    });
  }
});
$(document).ready(function() {     
  $('.thumbnails').magnificPopup({
    delegate: 'a.elevatezoom-gallery',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-with-zoom',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      titleSrc: function(item) {
        return item.el.attr('title');
      }
    }
  });
});

$('#custom_tab a').tabs();
 $('#tabs a').tabs();

//--></script>

                                    <script>
    var $loading = $('#loading').hide();
    
    
    //Attach the event handler to any element
    $(document)
            .ajaxStart(function () {
                //ajax request went so show the loading image
                $loading.show();
            })
            .ajaxStop(function () {
                //got response so hide the loading image
                $loading.hide();
                
            });
            
            
          
 function readURL(input,count) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah'+count)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function checkout() {
        $('#loginModal').modal();
    }
    
     function addtocart(id, type) {

        $.ajax({
            url: "<?= base_url(); ?>add-to-cart",
            type: 'post',
            data: 'id=' + id + '&type=' + type,
            success: function (data) {

                var dt = $.trim(data);

                var jsonData = JSON.parse(dt);

                if (jsonData.error_code == "100" || jsonData.error_code == "105") {

                    location.reload();

                } else {

                    return false

                }
            }
        });
    }

    function addtowishlist(id) {

        $.ajax({
            url: "<?= base_url(); ?>web/ajax/addToFavourite",
            type: 'post',
            data: 'product=' + id,
            success: function (data) {

                var dt = $.trim(data);

                var jsonData = JSON.parse(dt);

                if (jsonData.error_code == '200') {

                    location.reload();

                } else {

                    return false;

                }
            }
        });
    }
    function checkSearchInput(obj){
    var search=$(obj).val();
    if(search){
            $('#search_btn').attr('disabled',false);
        }else{
        $('#search_btn').attr('disabled',true);
        }
    }
    
    function checkLocation(obj){
    var location=$(obj).val();
    if(location){
            $('#location_btn').attr('disabled',false);
        }else{
        $('#location_btn').attr('disabled',true);
        }
                }
    
    function saveLocation(){
        var input=$('#location_form');
        var address=$("input[name='address']").val();
        var lat=$("#lat").val();
        var lng=$("#lng").val();
        if(address && lat && lng){
            $.ajax({
                url: "<?= base_url(); ?>web/ajax/save_location",
            type: 'post',
            data:  input.serialize(),
            success: function (data) {

                var dt = $.trim(data);

                var jsonData = JSON.parse(dt);

                if (jsonData.error_code == '200') {
                    
                    $('#locator').html(address);
                    $("#searchlocation").modal('hide');
                    $("body").removeClass('modal-open');
                    $.cookie('pop', '2');

                    location.reload();

                } else {

                    alert(jsonData.message);
                    $.removeCookie("pop");
                }
            }
                            });
                        }
                    }
                    
                  
</script>

                                </body>
</html>