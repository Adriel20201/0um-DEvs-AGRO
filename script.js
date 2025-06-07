//simple javascript to change the theme and change the sections 

function showSection(id) {
    document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');
    document.getElementById(id).style.display = 'flex';
}

const toggleBtn = document.getElementById('themeToggle');
const body = document.body;

const savedTheme = localStorage.getItem('theme') || 'light';
body.classList.add(savedTheme);

toggleBtn.addEventListener('click', () => {
    body.classList.add('fade-out');
    setTimeout(() => {
        body.classList.toggle('dark');
        body.classList.toggle('light');
        localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
        body.classList.remove('fade-out');
    }, 300);
});
