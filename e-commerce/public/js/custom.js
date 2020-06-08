$(document).ready(function () {

    let url = document.location.href;

    if(url.includes('/user-details/my-information')){
        initialActiveAccordion('collapse0', 'my_information')
    }else if(url.includes('user-details/statistic')){
        initialActiveAccordion('collapse1', 'statistic')
    }else if(url.includes('user-details/settings')){
        initialActiveAccordion('collapse0', 'edit_setting')
    }else if(url.includes('user-details/change-password')){
        initialActiveAccordion('collapse0', 'changePassword')
    }else if(url.includes('user-details/all-order')){
        initialActiveAccordion('collapse5', 'allOrder')
    }else if(url.includes('user-details/shipment-order')){
        initialActiveAccordion('collapse5', 'shipmentOrder')
    }else if(url.includes('user-details/completed-order')){
        initialActiveAccordion('collapse5', 'completedOrder')
    }else if(url.includes('user-details/cancel-order')){
        initialActiveAccordion('collapse5', 'cancelOrder')
    }else if(url.includes('user-details/bidding-history')){
        initialActiveAccordion('collapse1', 'biddingHistory')
    }else if(url.includes('user-details/credit-buy-history')){
        initialActiveAccordion('collapse1', 'creditBuyingHistory')
    }else if(url.includes('user-details/referral')){
        initialActiveAccordion('collapse2', 'addReferral')
    }else if(url.includes('user-details/referral-friend')){
        initialActiveAccordion('collapse2', 'referFriend')
    }


    window.addEventListener("pageshow", function (event) {
        var historyTraversal = event.persisted ||
            ( typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2 );
        if (historyTraversal) {
            // Handle page restore.
            window.location.reload();
        }
    });

    new WOW().init(); // animate initialization
    window.addEventListener('load', function () {
        let preload = document.getElementById("preload");
        // preload.classList.add("changeOpacity")
    })
    $('.sp-wrap').smoothproducts();
    setTimeout(function () {
        $('#successMessage').css('display','none')
        $('#successMessage').css('display','none')
    },4000)


});

function editCartItem(id, rowId) {
    $('#cartQuantity' + id).removeAttr('disabled')
    $('#cartUpdateBtn' + id).css("display", "block")
    $('#cartEditBtn' + id).css("display", "none")
    var val = $('#cartQuantity' + id).val()
    $('#cartUpdateUrl' + id).attr("href", "/update/cart-item/" + rowId + '/' + val)
}

function setCartUpdateUrl(id, rowId) {
    var val = $('#cartQuantity' + id).val()
    $('#cartUpdateUrl' + id).attr("href", "/update/cart-item/" + rowId + '/' + val)


}

$("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
    $(e.target)
        .prev()
        .find("i:last-child")
        .toggleClass("fa-minus fa-plus");
});

function initialActiveAccordion(parentId, currentId) {
    $("#" + parentId).addClass('show');
    $("#" + currentId).addClass('pushActive');
}