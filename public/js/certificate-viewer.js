/*
 * Certificate viewer.
 *
 * Opens a certificate thumbnail in a modal without leaving the page. The
 * modal can be dismissed with the close button, the backdrop, or Escape, and
 * focus returns to the thumbnail that opened it.
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
        var modal = document.getElementById('certificate-modal');
        if (!modal) return;

        var image = modal.querySelector('[data-certificate-image]');
        var title = modal.querySelector('[data-certificate-title]');
        var issuer = modal.querySelector('[data-certificate-issuer]');
        var date = modal.querySelector('[data-certificate-date]');
        var description = modal.querySelector('[data-certificate-description]');
        var meta = modal.querySelector('.certificate-modal-meta');
        var openers = document.querySelectorAll('[data-certificate-open]');
        var closers = modal.querySelectorAll('[data-certificate-close]');
        var closeButton = modal.querySelector('.certificate-modal-close');
        var closeTimer = null;
        var lastFocused = null;

        function setOptionalText(element, text, wrapper) {
            if (!element) return;

            element.textContent = text || '';

            if (wrapper) {
                wrapper.style.display = text ? '' : 'none';
            } else {
                element.style.display = text ? '' : 'none';
            }
        }

        function openModal(opener) {
            lastFocused = opener;

            var titleText = opener.getAttribute('data-certificate-title') || 'Certificate';
            var imageSrc = opener.getAttribute('data-certificate-src') || '';

            if (title) {
                title.textContent = titleText;
            }

            if (image && imageSrc) {
                image.src = imageSrc;
                image.alt = titleText + ' certificate';
            }

            setOptionalText(issuer, opener.getAttribute('data-certificate-issuer'));
            setOptionalText(date, opener.getAttribute('data-certificate-date'));
            setOptionalText(description, opener.getAttribute('data-certificate-description'));

            if (meta) {
                var hasMeta = Boolean(
                    opener.getAttribute('data-certificate-issuer') ||
                    opener.getAttribute('data-certificate-date')
                );
                meta.style.display = hasMeta ? '' : 'none';
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

                if (image) {
                    image.removeAttribute('src');
                    image.alt = '';
                }

                if (lastFocused && typeof lastFocused.focus === 'function') {
                    lastFocused.focus({ preventScroll: true });
                }
            }, 220);
        }

        openers.forEach(function (opener) {
            opener.addEventListener('click', function () {
                openModal(opener);
            });
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
