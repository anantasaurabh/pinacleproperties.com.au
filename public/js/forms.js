document.addEventListener('DOMContentLoaded', function() {
    const ajaxForms = document.querySelectorAll('.ajax-form');

    ajaxForms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const responseDiv = form.querySelector('.form-response');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;

            // Reset UI
            responseDiv.innerHTML = '';
            responseDiv.className = 'form-response';
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Processing...</span><i class="fa-solid fa-circle-notch fa-spin"></i>';

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    responseDiv.classList.add('success');
                    responseDiv.innerHTML = `<p><i class="fa-solid fa-check-circle"></i> ${result.message}</p>`;
                    form.reset();
                } else {
                    responseDiv.classList.add('error');
                    if (result.errors) {
                        const errorList = Object.values(result.errors).map(err => `<li>${err}</li>`).join('');
                        responseDiv.innerHTML = `<p><i class="fa-solid fa-triangle-exclamation"></i> Please fix the following:</p><ul>${errorList}</ul>`;
                    } else {
                        responseDiv.innerHTML = `<p><i class="fa-solid fa-triangle-exclamation"></i> ${result.message || 'An error occurred.'}</p>`;
                    }
                }
            } catch (error) {
                responseDiv.classList.add('error');
                responseDiv.innerHTML = `<p><i class="fa-solid fa-triangle-exclamation"></i> Network error. Please try again later.</p>`;
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnContent;
            }
        });
    });
});
