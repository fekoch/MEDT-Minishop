order = function (e) {
    if(e.type == 'keypress') {
        if (e.which != '13') return;
    }
    let sender = e.target;  //the element which sent the event
    let artikelID = $(sender).parents('.click-row').data('artikel-id');
    let menge = $(sender).parents('.click-row').find('input').val();
    /*$.post("orderArticle.php",{id: artikelID, anz: menge},function (response) {
        let link =  "index.php?site=suchen";
        if(response.err == true) link += '&msg=' + response.msg;
        window.location = link;
    });*/
    $.ajax({
        url: 'orderArticle.php',
        type: "POST",
        data: {id:artikelID, anz: menge},
        success: function (data) {
            let link =  "index.php?site=suchen";
            if(data.error === true) {
                alert(data.msg);
            }
            else {
                window.location = link;
            }
        }
    });
}

//go back button (but ignore the edit site)
function goBack() {
    let prev = document.referrer;
    if (prev.match(/edit=true$/) != null) {
// davor war edit
        window.history.go(-2);
    }
    else window.history.back();
}

//loaded with the site
$(document).ready(function () {
    /* Clickable Row */
    $(".click-row").click(function (e) {
        let artikelID;
        let sender = e.target;  //the element which sent the event
        //if the element is <tr>
        if (($(sender).is('tr'))) {
            //get the article id from the tr element
            artikelID = $(sender).data('artikel-id');
            window.location = 'artikel?id='+artikelID;
            //console.log("redirect to: "+'artikel?id='+artikelID);
        }
        //else if it is td or th
        else if ($(sender).is('td') || $(sender).is('th')) {
            artikelID = $(sender).parent().data('artikel-id');
            window.location = 'index.php?site=artikel&aid='+artikelID;
        }
        return true;
    });
    $('.edit-article').click(function (e) {
        let sender = e.target;  //the element which sent the event
        let artikelID = $(sender).parents('.click-row').data('artikel-id');
        window.location = "index.php?site=artikel&aid="+artikelID+"&edit=true";
    });
    /*delete button*/
    $('.delete-article').click(function (e) {
        let sender = e.target;  //the element which sent the event
        let artikelID = $(sender).parents('.click-row').data('artikel-id');
        $.post("removeArticle.php",{id: artikelID},function () {
            window.location = "index.php?site=suchen";//refresh the page
        });
    });

    /*TODO Edit Button*/

    /*Order Article*/
    $('.order-article').click(order);
    $('.click-row input').keypress(order);

    /* Un-Order Button */
    $('.un-order-article').click(function (e) {
        let sender = e.target;  //the element which sent the event
        let artikelID = $(sender).parents('.click-row').data('artikel-id');
        $.post("unOrderArticle.php",{id: artikelID},function () {
            window.location = "index.php?site=korb";
        });

    });
});
