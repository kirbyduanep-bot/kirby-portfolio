@php
    $resumeUrl = asset(ltrim(config('portfolio.meta.pdf'), '/'));
@endphp

<div
    id="resume-modal"
    class="fixed inset-0 z-50 items-center justify-center"
    style="display: none"
    role="dialog"
    aria-modal="true"
    aria-labelledby="resume-modal-title"
    aria-hidden="true"
>
    <div class="modal-backdrop absolute inset-0" data-resume-close></div>

    <div class="modal-dialog resume-modal-dialog relative z-10 w-full flex flex-col overflow-hidden">
        <div class="resume-modal-header">
            <div class="resume-modal-heading">
                <h3 id="resume-modal-title" class="resume-modal-title">Parel Kirby — Resume</h3>
                <p class="resume-modal-subtitle">Preview the PDF, then download a copy if you need it.</p>
            </div>

            <button
                type="button"
                class="resume-modal-close"
                data-resume-close
                aria-label="Close resume viewer"
            >
                ✕
            </button>
        </div>

        <div class="resume-modal-body">
            <iframe
                id="resume-frame"
                class="resume-frame"
                title="Parel Kirby resume PDF"
                data-src="{{ $resumeUrl }}#view=FitH&amp;toolbar=0&amp;navpanes=0"
                loading="lazy"
            ></iframe>
        </div>

        <div class="resume-modal-footer">
            <span class="resume-modal-note">PDF · ParelKirbs_Resume.pdf</span>
            <div class="resume-modal-actions">
                <a
                    href="{{ $resumeUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="resume-action"
                >
                    <x-icon name="external-link" class="w-4 h-4" />
                    Open in new tab
                </a>
                <a
                    href="{{ $resumeUrl }}"
                    download="ParelKirbs_Resume.pdf"
                    class="resume-action resume-action-primary"
                >
                    <x-icon name="download" class="w-4 h-4" />
                    Download Resume
                </a>
            </div>
        </div>
    </div>
</div>
