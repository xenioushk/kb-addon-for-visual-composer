;(function ($) {
  function bkbm_kavc_installation_counter() {
    return $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        action: "bkbm_kavc_installation_counter", // this is the name of our WP AJAX function that we'll set up next
        product_id: BkbmKavcAdminData.product_id, // change the localization variable.
      },
      dataType: "JSON",
    })
  }

  if (typeof BkbmKavcAdminData.installation != "undefined" && BkbmKavcAdminData.installation != 1) {
    $.when(bkbm_kavc_installation_counter()).done(function (response_data) {
      // console.log(response_data)
    })
  }
})(jQuery)