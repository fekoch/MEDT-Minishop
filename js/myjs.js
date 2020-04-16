
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
    /*delete button*/
    $('.delete-article').click(function (e) {
        let sender = e.target;  //the element which sent the event
        let artikelID = $(sender).parents('.click-row').data('artikel-id');
        $.post("removeArticle.php",{id: artikelID});
    });

    /*TODO Edit Button*/

    /*Order Article*/
    $('.order-article').click(function (e) {
        let sender = e.target;  //the element which sent the event
        let artikelID = $(sender).parents('.click-row').data('artikel-id');
        let parent = $(sender).parents('.click-row');
        let find = parent.find('input');
        let menge = $(sender).parents('.click-row').find('input').val();
        $.post("orderArticle.php",{id: artikelID, anz: menge},function () {
            window.location = "index.php?site=suchen";
        });

    });
});
