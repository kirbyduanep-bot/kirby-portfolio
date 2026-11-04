<div
    id="certificate-modal"
    class="fixed inset-0 z-50 items-center justify-center"
    style="display: none"
    role="dialog"
    aria-modal="true"
    aria-labelledby="certificate-modal-title"
    aria-hidden="true"
>
    <div class="modal-backdrop absolute inset-0" data-certificate-close></div>

    <div class="certificate-modal-dialog relative z-10 w-full flex flex-col overflow-hidden">
        <div class="certificate-modal-header">
            <div class="certificate-modal-heading">
                <div class="certificate-modal-kicker">Certificate</div>
                <h3 id="certificate-modal-title" class="certificate-modal-title" data-certificate-title></h3>
                <div class="certificate-modal-meta">
                    <span data-certificate-issuer></span>
                    <span data-certificate-date></span>
                </div>
            </div>

            <button
                type="button"
                class="certificate-modal-close"
                data-certificate-close
                aria-label="Close certificate viewer"
            >
                ✕
            </button>
        </div>

        <div class="certificate-modal-body">
            <img
                class="certificate-modal-image"
                data-certificate-image
                alt=""
                decoding="async"
            />
        </div>

        <div class="certificate-modal-footer">
            <p class="certificate-modal-description" data-certificate-description></p>
            <button type="button" class="resume-action" data-certificate-close>Close</button>
        </div>
    </div>
</div>
