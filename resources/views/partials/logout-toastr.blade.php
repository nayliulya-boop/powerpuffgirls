<!-- Toastr CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    #toast-container > .toast {
        opacity: 0.98 !important;
        border-radius: 16px !important;
        padding: 16px 18px 16px 52px !important;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.28), 0 8px 10px -6px rgba(15, 23, 42, 0.18) !important;
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
        width: 360px !important;
    }
    #toast-container > .toast-warning.logout-confirm-toast {
        background-color: #0f172a !important;
        border: 1px solid rgba(56, 189, 248, 0.35) !important;
        color: #f8fafc !important;
    }
    #toast-container .toast-title {
        font-weight: 800 !important;
        font-size: 0.92rem !important;
        margin-bottom: 4px !important;
    }
    #toast-container .toast-message {
        font-size: 0.82rem !important;
        line-height: 1.45 !important;
    }
    #toast-container .toast-progress {
        height: 4px !important;
        opacity: 0.85 !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof toastr === 'undefined') {
            return;
        }

        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: true,
            showDuration: '300',
            hideDuration: '400',
            timeOut: '5000',
            extendedTimeOut: '1500',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };

        @if (session('status'))
            toastr.success(@json(session('status')), 'Notification');
        @endif

        @if (session('success'))
            toastr.success(@json(session('success')), 'Success');
        @endif

        @if (session('info'))
            toastr.info(@json(session('info')), 'Notice');
        @endif

        // Attach Toastr confirmation popup to all logout forms
        const logoutForms = document.querySelectorAll('form[action$="/logout"]');
        logoutForms.forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (form.dataset.confirmed === 'true') {
                    return;
                }
                e.preventDefault();

                toastr.clear();

                const confirmHtml = `
                    <div>Are you sure you want to log out of your account?</div>
                    <div style="margin-top: 12px; display: flex; gap: 8px;">
                        <button type="button" id="toastr-confirm-logout-btn" style="background: #ef4444; color: #fff; border: none; padding: 6px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer;">
                            Yes, Log Out
                        </button>
                        <button type="button" id="toastr-cancel-logout-btn" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.25); padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 12px; cursor: pointer;">
                            Cancel
                        </button>
                    </div>
                `;

                const $toast = toastr.warning(confirmHtml, 'Confirm Logout', {
                    timeOut: 0,
                    extendedTimeOut: 0,
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: false,
                    positionClass: 'toast-top-right',
                    toastClass: 'toast toast-warning logout-confirm-toast'
                });

                if ($toast) {
                    $toast.on('click', '#toastr-confirm-logout-btn', function () {
                        form.dataset.confirmed = 'true';
                        toastr.clear($toast, { force: true });
                        toastr.info('Signing you out safely...', 'Logging Out', {
                            timeOut: 2000,
                            progressBar: true,
                            positionClass: 'toast-top-right'
                        });
                        form.submit();
                    });

                    $toast.on('click', '#toastr-cancel-logout-btn', function () {
                        toastr.clear($toast, { force: true });
                    });
                }
            });
        });
    });
</script>

