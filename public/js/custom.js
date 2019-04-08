$(document).ready(function() {

    function initPasteListener() {

        $('#file-uploader').bind('paste', function (event) {

            var pastedData = event.originalEvent.clipboardData.getData('text');

            sendData(pastedData, '/create');

        } );

    }

    initPasteListener();

    function sendData(data, url) {

        $.ajax({
            type: 'post',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'url=' + data,
            success: function (response) {
                console.log("Z: ", response);
            },
            error: function () {

            }
        });

    }

});


