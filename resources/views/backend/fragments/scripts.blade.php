<script>
    let dialog = null;
    const currentLocale = '{{app()->getLocale()}}';

    window.onload = () => {
        dialog = bootbox.dialog({
            size: 'small',
            title: '<span class="text-center mb-0 font-weight-bolder">Please wait!</span>',
            message: '<p class="text-center mb-0"><i class="fa fa-spin fa-circle-notch" style="font-size: 24px;"/> </p>',
            closeButton: false,
            show: false,
            centerVertical: true,
        });
        dialog.find('.modal-dialog').css({'max-width': '180px'});
        dialog.find('.modal-header').addClass('mx-auto');
        dialog.find('.modal-content').addClass('shadow-lg');

        if (typeof window.initialized === "function") {
            window.initialized();
        }
    }

    window.confirm = (config) => {
        bootbox.confirm({
            title: config.title,
            centerVertical: true,
            message: config.message,
            buttons: {
                cancel: {
                    label: 'Cancel',
                    className: 'btn btn-outline-secondary'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn btn-outline-info'
                }
            },
            callback: function (result) {
                if (result) {
                    config.confirmed();
                }
            }
        });
    };

    window.performDelete = (config) => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: config.url,
            type: 'DELETE',
            success: (response) => {
                if (response.success === 1) {
                    config.success(response.message);
                } else {
                    config.failed(response.message);
                }
            },
            beforeSend: (xhr, settings) => {
                if (config.hasOwnProperty('before')) {
                    config.before();
                }
            },
            complete: (xhr, status) => {
                if (config.hasOwnProperty('complete')) {
                    config.complete();
                }
            }
        });
    };

    window.performGet = (config) => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: config.url,
            type: 'GET',
            success: (response) => {
                if (response.success === 1) {
                    config.success(response.message, response.data);
                } else {
                    config.failed(response.message);
                }
            },
            beforeSend: (xhr, settings) => {
                if (config.hasOwnProperty('before')) {
                    config.before();
                }
            },
            complete: (xhr, status) => {
                if (config.hasOwnProperty('complete')) {
                    config.complete();
                }
            }
        });
    };

    window.performPut = (config) => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
                'Content-Type': 'application/json'
            },
            url: config.url,
            data: config.data,
            type: 'PUT',
            success: (response) => {
                if (response.success === 1) {
                    config.success(response.message, response.data);
                } else {
                    config.failed(response.message);
                }
            },
            beforeSend: (xhr, settings) => {
                if (config.hasOwnProperty('before')) {
                    config.before();
                }
            },
            complete: (xhr, status) => {
                if (config.hasOwnProperty('complete')) {
                    config.complete();
                }
            }
        });
    };

    function reload() {
        window.location.reload();
    }

    setLoading = (loading, ready = null) => {
        dialog.modal(loading ? 'show' : 'hide');
        if (ready !== null && typeof ready === "function") {
            dialog.one('shown.bs.modal', (e) => {
                console.log('OnShown called');
                ready();
            });
        }
        dialog.shown = loading;
    };

    isLoading = () => {
        return dialog.shown;
    };

    window.showLoadingOnSubmit = function () {
        // Attach global handler to show loading dialog when submitting the form.
        $('form').on('submit', function () {
            setLoading(true);
        });
    };
</script>