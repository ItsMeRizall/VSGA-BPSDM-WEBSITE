document.addEventListener('DOMContentLoaded', function() {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginButton = document.getElementById('btnLogin');

    loginButton.addEventListener('click', function(event) {
        event.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;

        // Lakukan validasi
        if (username === 'admin' && password === 'bpsdmp') {
            window.location.href = './admin/admin.php'; // Redirect ke halaman admin jika login berhasil
        } else {
            const errorText = document.createElement('p');
            errorText.textContent = 'Username or password is incorrect.';
            errorText.classList.add('text-red-500', 'text-sm', 'text-center', 'mt-2');
            
            // Periksa apakah pesan kesalahan sudah ada, jika belum tambahkan ke bawah tombol
            if (!document.querySelector('.error-text')) {
                loginButton.parentNode.appendChild(errorText);
            }
        }
    });
});
