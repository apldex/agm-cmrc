<?php defined('BASEPATH') or Exit('No direct script access allowed'); ?>
<!-- FOOTER -->
<footer id="footer">
    <div class="container footer-zero">
        <div class="row mb-40 fs-13 footer-zero">
            <!-- col #1 -->
            <div class="col-12 col-md-7 pb-10 footer-zero">
                <h2 class="pt-10">
                    Stay in the know
                </h2>
                <h6>Be the first to hear about new inventory and offers.</h6>
                <form method="post" action="<?=site_url('home/subscribe')?>">
                    <div class="input-email">
                        <input type="email" name="email" class="form-control form-control-footer" placeholder="Your Mail"
                               aria-label="Your Mail" aria-describedby="basic-addon2" style="background-color: #5F5F5F;">
                        <div>
                            <button class="email-button eyebrow">SUBMIT<i class="pl-5 fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>

                <!-- Social Icons -->
                <div class="pt-15">
                    <div class="clearfix">
                        <a href="https://facebook.com"
                           class="social-icon social-icon-border social-icon-round social-facebook float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="https://twitter.com"
                           class="social-icon social-icon-border social-icon-round social-twitter float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="https://instagram.com"
                           class="social-icon social-icon-border social-icon-round social-instagram float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Instagram">
                            <i class="icon-instagram2"></i>
                            <i class="icon-instagram2"></i>
                        </a>
                        <a href="https://web.whatsapp.com"
                           class="social-icon social-icon-border social-icon-round social-whatsapp float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Whatsapp">
                            <i class="icon-call"></i>
                            <i class="icon-call"></i>
                        </a>
                    </div>
                </div>
                <!-- /Social Icons -->
            </div>
            <!-- /col #1 -->

            <!-- col #2 -->
            <div class="col-sm-12 col-md-5 pt-10 footer-zero">
                <div class="row">
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">SHOP</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url('home/shop/1'); ?>">Aireloom</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/2'); ?>">Kingkoil</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/4'); ?>">Serta</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/5'); ?>">Tempur</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/3'); ?>">Florence</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/6'); ?>">Stressless</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">ABOUT</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url(''); ?>home/pageAbout">About Us</a></li>
                            <li><a class="block" href="<?= site_url(''); ?>home/pageContact">Contact Us</a></li>
                            <li><a class="block" href="<?= site_url(''); ?>home/pageFaq">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">HELP</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url(''); ?>home/termCondition">Terms & Conditions</a>
                            </li>
                            <li><a class="block" href="<?= site_url(''); ?>home/privacyPolicy">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /col #2 -->
        </div>
    </div>
    <div class="copyright">
        <div class="container text-center">
            &copy; All Rights Reserved, <b>AGM - American Giant Mattress</b>
        </div>
    </div>
</footer>
<!-- /FOOTER -->


</div>
<!-- SCROLL TO TOP -->
<a href="<?= site_url('#'); ?>" id="toTop"></a>

<!-- JAVASCRIPT FILES -->
<script>
    var plugin_path = "<?= base_url('asset/plugins/');?>";
</script>
<script src="<?= base_url('asset/plugins/jquery/jquery-3.3.1.min.js'); ?>"></script>

<script src="<?= base_url('asset/javascript/scripts.js'); ?>"></script>
<script src="<?= base_url('asset/javascript/scrollAnimated.js'); ?>"></script>

<!-- STYLESWITCHER - REMOVE -->
<!-- <script async type="text/javascript" src="demo_files/styleswitcher/styleswitcher.js"></script> -->

<!-- AutoNumber -->
<script type="text/javascript" src="https://unpkg.com/autonumeric"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script src="<?= base_url('asset/javascript/demo.shop.js'); ?>"></script>
<script>
    $(window).on('load', e => {
        if ($('#store-location').length) {
            // load map location lookup
            loadLocationLookup();
        }
    });

    function loadLocationLookup() {
        $('#store-location').load('<?php echo base_url('home/store-lookup'); ?>');
    }
    

    // var stores = <?= $stores?>;
    // var lat = document.getElementById('lat');
    // var lng = document.getElementById('lng');
    // var km = 30;
    // var map;
    // var markers = [];
    // var infoWindow; // markers information
    // var locationSelect;
    // var mapOption = {
    //     center: {lat: -2.0372851958986224, lng: 117.06773251302911},
    //     zoom: 5,
    //     mapTypeId: 'roadmap'
    // }

    // for (var i = 0; i < stores.length; i++) {
    //     console.log(stores[i]);
    // }

    // function initMap() {
    //     var indonesia = {lat: -2.0372851958986224, lng: 117.06773251302911};
    //     map = new google.maps.Map(document.getElementById('maps'), mapOption);
    //     infoWindow = new google.maps.InfoWindow({map: map});

    //     map.data.addGeoJson(stores);
    //     map.data.setStyle(function (feature) {
    //         return {
    //             icon: '<?= base_url('asset/logo-agm/favicon.png');?>',
    //             title: feature.getProperty('company_name')
    //         }
    //     })

    //     map.data.addListener('click', function (e) {
    //         console.log($(this))
    //         var company_nameField = e.feature.getProperty('company_name');
    //         var addressField = e.feature.getProperty('address');
    //         var logo = "<?= base_url('asset/logo-agm/favicon.png');?>";
    //         infoWindow.setContent("<div style='width: 150px;'><img src='"
    //             + logo +
    //             "'/><h4>"
    //             + company_nameField +
    //             "</h4><p>"
    //             + addressField +
    //             "</p></div>");
    //         infoWindow.setPosition(e.feature.getGeometry().get());
    //         infoWindow.setOptions({pixelOffest: new google.maps.Size(0, -30)});
    //         infoWindow.open(map);
    //         console.log(e.feature.getGeometry().get());
    //     })

    //     $.each(stores.features, function (index, store) {
    //         item = '<a href="#" class="list-group-item" data-toggle="outlet-item" data-target=' + store.id + '>' +
    //             '<h4 class="list-group-item-heading">' + store.properties.company_name + '</h4>' +
    //             '<p class="list-group-item-heading">' +
    //             '<strong>Address : </strong>' + store.properties.address +
    //             '</p>' +
    //             '<p class="list-group-item-heading">' +
    //             '<strong>Phone : </strong>' + store.properties.phone +
    //             '</p>'
    //         '</a>';
    //         $('#store').append(item);
    //     });

    //     $('a[data-toggle="outlet-item"]').click(function (e) {
    //         e.preventDefault()
    //         var target = $(this).data('target');
    //         var result = $.grep(stores.features, function (e) {
    //             return e.id == target;
    //         });
    //         $('div[title="' + result[0].properties.company_name + '"]').click()
    //     })

    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function (position) {
    //             var pos = {
    //                 lat: position.coords.latitude,
    //                 lng: position.coords.longitude,
    //             };
    //             lat.value = position.coords.latitude;
    //             lng.value = position.coords.longitude;
    //             // info.nodeValue = position.coords.longitude;

    //             var marker = new google.maps.Marker({
    //                 position: new google.maps.LatLng(pos),
    //                 map: map,
    //                 animation: google.maps.Animation.BOUNCE,
    //             })
    //             map.setCenter(pos);
    //             map.setZoom(12);

    //             // showLocation(mapOption, map, pos, km);
    //         }, function () {
    //             handleLocationError(true, map.getCenter());
    //         });
    //     } else {
    //         handleLocationError(false, map.getCenter());
    //     }
    // }

    // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    //     infoWindow.setPosition(pos);
    //     infoWindow.setContent(browserHasGeolocation ?
    //         'Error: Browser hasn\'t have location.' :
    //         'Error: Browser doesn\'t support.');
    // }

    // function infoMarker(marker, info_marker) {
    //     var infoWindow = new google.maps.InfoWindow({
    //         content: info_marker
    //     });

    //     marker.addListener('click', function () {
    //         infoWindow.open(marker.get('map'), marker);
    //     });
    // }

</script>
<script>
    $(document).ready(function () {
        $('#province').change(function () {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: "<?=site_url('home/checkProv/')?>" + province_id,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        $("#city").attr('disabled', false);
                        $("#city").empty();
                        $("#city").append(
                            '<option value="Select" selected disabled> Select </option>'
                        );
                        $('#sub_district').empty();
                        $("#sub_district").append(
                            '<option value="Select" selected disabled> Select </option>'
                        );
                        $.each(response, function (key, value) {
                            $("#city").append(
                                '<option value=' + value.id_kab + '>' + value.nama + '</option>'
                            );
                        });
                    }
                })
            }
        });

        $('#city').change(function () {
            var city = $(this).val();
            if (city) {
                $.ajax({
                    url: "<?=site_url('home/checkSubDistrict/')?>" + city,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        $("#sub_district").attr('disabled', false);
                        $("#sub_district").empty();
                        $("#sub_district").append(
                            '<option value="Select" selected disabled> Select </option>'
                        );
                        $.each(response, function (key, value) {
                            $("#sub_district").append(
                                '<option value=' + value.id_kec + '>' + value.nama + '</option>'
                            );
                        });
                    }
                })
            }
        });

        $('#sub_district').change(function(){
            var selectedDistrict = $(this).children("option:selected").val();
            var url = "<?= site_url('home/addToCart/');?>"+selectedDistrict
            $('#cart_form').attr('action', url);
            console.log(url);
        });
    });
</script>
<script>
    // process quantity or size item
    // TODO: Get Sub price
    // If sub price not null, strike regular price, show sub-price
    // Set sub-price as regular price (cart will get sub-price)
    $(document).ready(function () {
        const formatter = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        });

        $('#stockDetail').hide();
        $('#shoppingForm').hide();
        $('#sub_district').on('change', function () {
            var subDistrict = $('#sub_district').val();
            var productId = $('#product_id').val();
            $('#pageloader').fadeIn(150, function () {
                $('#pageloader').hide();
            });
            if (subDistrict) {
                $.ajax({
                    url: "<?=site_url('home/checkStockbyDistrict/')?>" + productId + "/" + subDistrict,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (response != '') {
                            $("div.toggle.active > label").trigger("click");
                            $("#stockTitle").html("Available in your location");
                            $("#stockLabel").html('<i id="stockIcon" class="fa fa-check text-oldblue"></i> In Stock');
                            $('#stockDetail').show();
                            $('#shoppingForm').show();
                            $("#size").attr('disabled', false);
                            $("#size").empty();

                            // check whether subprice null or not 

                            if(response.sub_price == 0) { 
                            var price = `Rp.<span class='totalpr ice' value="${response.price}">${formatter.format(response.price)}</span>
                            `
                            $("#price2").html(price);
                            } else { 
                                // result for the subprice
                            var price = `<span class='line-through fw-500 fs-15 mr-15'>Rp.<span class='totalprice' value="${response.price}">${formatter.format(response.price)}</span></span>
                            Rp.<span class='totalprice' value="${response.sub_price}">${formatter.format(response.sub_price)}</span>`
                            $("#price2").html(price);

                            }
                            
                            // var price = `<span class='line-through fw-500 fs-15 mr-15'>Rp.<span class='totalprice' value="${response[0].price}">${formatter.format(response[0].price)}</span></span>
                            // Rp.<span class='totalprice' value="${response[0].sub_price}">${formatter.format(response[0].sub_price)}</span>`
                            // $("#price2").html(price);
                            
                            //$('#price2').append("<span class='totalprice' value=" + response[0].price + "><?//=number_format(floatval(), 0, ',', '.')?>//" + "</span>");

                            $("#price").val(response[0].price);
                            $.each(response, function (key, value) {
                                $("#size").append(
                                    '<option value="' + value.id_product_size + '" data-max="' + value.quantity + '">' + value.name + ' (' + value.size + ')</option>'
                                );
                                // $("#size").change(function(){
                                // 	$('input[type=number]').attr('max', $(this).find(":selected").data('max'));
                                // });
                                $("div.toggle.active > label").trigger("click");
                            });
                            $("#sku").val(response[0].idTr);
                        } else {
                            $('#stockDetail').hide();
                            $('#shoppingForm').hide();
                            $("#size").empty();
                            $("#stockTitle").html("Not available in your location");
                        }

                    }
                })
            }
        });

        $('#size').on('change', function () {
            var size = $("#size").val();
            var productId = $('#product_id').val();
            if (size) {
                $.ajax({
                    url: "<?=site_url('home/checkPricebyProdSize/')?>" + productId + "/" + size,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        // $("#price2").html("Rp. " + formatter.format(response.price));
                        // $("#price").val(response.price);
                        // $("#sku").val(response.id);

                        
                         if(response.sub_price == 0 ) { 
                             
                            var price = `Rp.<span class='totalprice' value="${response.price}">${formatter.format(response.price)}</span>
                            `
                            $("#price2").html(price);
                        } else { 
                             
                            var price = `<span class='line-through fw-500 fs-15 mr-15'>Rp.<span class='totalprice' value="${response.price}">${formatter.format(response.price)}</span></span>
                            Rp.<span class='totalprice' value="${response.sub_price}">${formatter.format(response.sub_price)}</span>`
                            $("#price2").html(price);

                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?=site_url("snap/token")?>',
            cache: false,
            success: function(data) {
                //location = data;
                console.log('token = '+data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');
                function changeResult(type,data){
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }
                snap.pay(data, {

                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onClose: function(result){
                        window.location = "<?=site_url('home/shop_summary')?>";
                    }
                });
            }
        });
    });
</script>

<!-- <script>
	jQuery("#shipswitch").bind("click",function(){jQuery('#shipping').slideToggle(200,function(){if(jQuery('#shipping').is(":visible")){_scrollTo('#shipping',150);}});});

	jQuery("#shipswitch").bind("click", function(){
		jQuery("#historyshipping").slideToggle(200, function(){
			if(jQuery("#historyshipping").is(":visible")){
				_scrollTo("#historyshipping", 150);
				$("#shippinghistory").show();
				jQuery("#shipswitch1").bind("click", function(){
					jQuery("#shipping").slideToggle(200, function(){
						if(jQuery("#shipping").is(":visible")){
							_scrollTo("#shipping",150);
							$("default_address").hide();
							$("#historyshipping").hide();
						}else{
							$("default_address").show();
							$("#historyshipping").hide();
						}
					});
				});
			}else{
				$("#historyshipping").hide();
			}
		})
	})
</script> -->

<script>
    grecaptcha.ready(function() {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6Lcxm5wUAAAAAEhnAdo5xeknvh7RXGpTqWq5XDTO', {action: 'create_comment'}).then(function(token) {
            // add token to form
            $('#token').val(token)
        });;
    });
</script>

<script>
    var label = $('#voucher-label');
    label.hide();
    $('#btn-voucher').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var voucher = $('#cart-code').val();

        if(voucher === "") {
            label.html('<i class="fa fa-times text-danger"></i> Please input voucher code');
            label.attr("class","text-danger");
            label.show();
            $(this).removeAttr("disabled");
        } else {
            $.ajax({
                url: '<?=site_url("home/check_voucher/")?>' + voucher,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    //location = data;
                    console.log('data = '+data);

                    if(data.status === 0) {
                        label.html('<i class="fa fa-times text-danger"></i> Voucher invalid');
                        label.attr("class","text-danger");
                        label.show();
                        $('#btn-voucher').removeAttr("disabled");
                    } else {
                        label.html("");
                        label.hide();
                        $('#voucher-input').submit();
                        // $('#voucher-input').remove();
                        // label.after(`
                        //             <div id="voucher-detail" class="row">
                        //             <div class="col-6">
                        //                 <p>${voucher}</p>
                        //             </div>
                        //             <div class="col-6">
                        //                 <a href="#" class="float-right" id="remove-voucher" >remove</a>
                        //             </div>
                        //             </div>`);
                    }
                }
            });
        }
    });
    $('#remove-voucher').click(function (event) {
        $('#voucher-detail').empty();
        label.after(` <form id="voucher-input" action="#" method="post" class="m-0">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" id="cart-code" name="voucher" class="form-control text-center mb-10" placeholder="Voucher Code" required="required">
                                        <button class="btn btn-oldblue btn-block" id="btn-voucher" type="button">APPLY</button>
                                    </div>
                                </div>
                        </form> `);
    });
</script>

<script>
$(document).ready(function () {
    var url = window.location.href.replace(window.location.search,'');
    $('ul li a[href="'+ url +'"]').parent().addClass('active');
    $('ul li a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
});
</script>

</body>

</html>
