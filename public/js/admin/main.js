/**
 * get all points approvement
 */
function getPointsApprovementCount() {
    return $.ajax({
        type: "GET",
        url: window.location.origin + '/admin/points-approvement/count'
    }).done(function (count) {
        if (count > 0) {
            //fills the badge
            $("#pa-count").text(count);
        } else {
            $("#pa-count").text('');
        }
    });
}

(function() {
    getPointsApprovementCount();
})();