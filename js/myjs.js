
$(document).ready(function () {
    /* Clickable Row */
    $(".click-row").click(function (e) {
        var sender = e.target;  //the element which sent the event
        //if the element is <tr>
        if (($(sender).is('tr'))) {
            //get the article id from the tr element
            var artikelID = $(sender).data('artikel-id');
            window.location = 'artikel?id='+artikelID;
            //console.log("redirect to: "+'artikel?id='+artikelID);
        }
        //else if it is td or th
        else if ($(sender).is('td') || $(sender).is('th')) {
            var artikelID = $(sender).parent().data('artikel-id');
            window.location = 'artikel?id='+artikelID;
        }
        return true;
    });
});
