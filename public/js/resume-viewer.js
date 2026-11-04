/*
 * Resume viewer.
 *
 * Loads the PDF into an iframe only when the visitor asks for it, then keeps
 * the viewer accessible (Escape, backdrop, focus return) and leaves the
 * download link available in both the contact card and the viewer footer.
 */
(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn, { once: true });
        } else {
            fn();
        }
    }

    ready(function () {
        var modal = document.getElementById('resume-modal');
        if (!modal) return;

        var frame = document.getElementById('resume-frame');
        var openers = document.querySelectorAll('[data-resume-open]');
        var closers = modal.querySelectorAll('[data-resume-close]');
        var closeButton = modal.querySelector('.resume-modal-close');
        var closeTimer = null;
        var lastFocused = null;

        function openModal(event) {
            if (event) event.preventDefault();

            lastFocused = document.activeElement;

            if (frame && !frame.hasAttribute('src')) {
                var src = frame.getAttribute('data-src');
                if (src) {
                    frame.setAttribute('src', src);
                }
            }

            if (closeTimer) {
                window.clearTimeout(closeTimer);
                closeTimer = null;
            }

            modal.classList.remove('is-closing');
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            window.requestAnimationFrame(function () {
                modal.classList.add('is-open');
            });

            if (closeButton) {
                closeButton.focus({ preventScroll: true });
            }
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.classList.add('is-closing');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            closeTimer = window.setTimeout(function () {
                modal.style.display = 'none';
                modal.classList.remove('is-closing');
                closeTimer = null;

                if (lastFocused && typeof lastFocused.focus === 'function') {
                    lastFocused.focus({ preventScroll: true });
                }
            }, 220);
        }

        openers.forEach(function (opener) {
            opener.addEventListener('click', openModal);
        });

        closers.forEach(function (closer) {
            closer.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });
    });
})();
