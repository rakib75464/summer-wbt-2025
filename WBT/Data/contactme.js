document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.contact-form').addEventListener('submit', function(e) {
        e.preventDefault(); 
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        const email = document.getElementById('email').value;
        const meeting = document.querySelector('input[name="meeting"]:checked').value;

        const categories = Array.from(document.querySelectorAll('input[name="category"]:checked'))
                                .map(cb => cb.value);

        const consulting = document.getElementById('consulting').value;
        const username = firstname.toLowerCase() + Math.floor(Math.random() * 1000);
        const password = Math.random().toString(36).slice(-4);

        localStorage.setItem('contactData', JSON.stringify({
            firstname, lastname, email, meeting, categories, consulting, username, password
        }));

        const popup = document.createElement('div');
        popup.style.position = 'fixed';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.backgroundColor = '#eef4f8';
        popup.style.padding = '30px';
        popup.style.border = '2px solid #0066cc';
        popup.style.borderRadius = '10px';
        popup.style.textAlign = 'center';
        popup.style.zIndex = '2000';
        popup.innerHTML = `
            <h3>Your Credentials</h3>
            <p><strong>Username:</strong> ${username}</p>
            <p><strong>Password:</strong> ${password}</p>
            <button id="checkBtn">Check</button>
        `;
        document.body.appendChild(popup);

        document.getElementById('checkBtn').addEventListener('click', function() {
            window.location.href = '/WBT/HTML/display.html';
        });
    });
});
