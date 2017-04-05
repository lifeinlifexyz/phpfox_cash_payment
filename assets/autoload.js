
function cm_controllerPopup(sUrl) {
    var id = Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);

    var jId = '#' + id;
    console.log('<a href="' + sUrl +'" class="popup hidden" id="' + id + '"></a>');
    $('body').append('<a href="' + sUrl + '" class="popup" id="' + id + '">test</a>');
    alert('asdfasdf');
    console.log($(jId));
    $(jId).trigger('click');
    setTimeout(function () {
        $('#' + id).remove();
    }, 2000);
}
