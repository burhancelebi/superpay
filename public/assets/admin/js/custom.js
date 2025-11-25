function loadingGif() {
    $('body').append('<div id="loading-overlay"><img width="80" src="/assets/gif/ZKZg.gif" alt="Loading..."></div>');
    $('#loading-overlay').css({
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100%',
        height: '100%',
        background: 'rgba(255, 255, 255, 0.8)',
        'z-index': 9999,
        display: 'flex',
        'justify-content': 'center',
        'align-items': 'center'
    });
}

function removeLoadingGif() {
    $('#loading-overlay').remove();
}

function toast() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    return toastr;
}

function confirmAction(event, element, text) {
    event.preventDefault();

    Swal.fire({
        title: "Are you sure ?",
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, proceed",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = element.href;
        }
    });
}

function infoSwalAction(title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: false,
        confirmButtonText: "Close",
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();

        }
    });
}
