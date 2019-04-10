$(document).ready(function() {

    function initPasteListener() {

        $('#file-uploader').bind('paste', function (event) {

            var pastedData = event.originalEvent.clipboardData.getData('text');

            var data = 'url=' + pastedData;

            sendData(data, '/create');
        } );

    }

    initPasteListener();

    function initRemoveListener() {

        $('#file-list').on('click', 'button.js-file-remove', function () {

            var fileID = $(this).data('id');

            $.confirm({
                title: 'Remove File ',
                content: 'Are sure to remove selected file?',
                type: 'blue',
                buttons: {
                    ok: {
                        text: "yes",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function() {
                            removeDataById(fileID, '/remove');
                        }
                    },
                    cancel: {
                        text: "no",
                        action: function() {}
                    }
                }
            })

        });

    }

    initRemoveListener();

    function sendData(data, url) {

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (data, status) {
                addToHtml(data.fileData);
                showAlertResponse(data, status);
            },
            error: function (xhr, status) {
                showAlertResponse(xhr, status);
            }
        });

    }

    function showAlertResponse(response, status) {

        $('#alert-response').empty();

        if(status === 'success') {
            $('#alert-response').append('<div class="alert alert-success" role="alert">' + response.message + '</div');
        } else {
            $('#alert-response').append('<div class="alert alert-danger" role="alert">' + response.responseJSON.message + '</div');
        }

    }

    function removeDataById(id, url) {

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'id=' + id,
            success: function (response, status) {
                removeFromHTML(id);
                showAlertResponse(response, status);
            },
            error: function (xhr, status) {
                showAlertResponse(xhr, status);
            }
        });

    }

    function addToHtml(fileData) {
        $("#file-list").prepend(fileData.original.html);
    }

    function removeFromHTML(id) {
        var fileList = $("#file-list");
        fileList.find('.file-row[data-file-row="' + id + '"]').remove();
    }

});