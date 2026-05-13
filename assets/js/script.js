/* CURSOR */
const cur = document.getElementById('cursor');
const ring = document.getElementById('cursor-ring');
document.addEventListener('mousemove', e => {
    cur.style.left = e.clientX + 'px';
    cur.style.top = e.clientY + 'px';
    setTimeout(() => {
    ring.style.left = e.clientX + 'px';
    ring.style.top = e.clientY + 'px';
    }, 60);
});

/* LOADER COUNTER */
const counter = document.getElementById('loader-counter');
let count = 0;
const interval = setInterval(() => {
    count = Math.min(count + Math.floor(Math.random() * 6 + 2), 100);
    counter.textContent = count + '%';
    if (count >= 100) clearInterval(interval);
}, 80);

/* HIDE LOADER */
setTimeout(() => {
    document.getElementById('loader').classList.add('hidden');
    document.body.style.overflowY = 'auto';
}, 2600);

/* ACTIVE NAV ON SCROLL */
const sections = document.querySelectorAll('section[id], div[id]');
const navLinks = document.querySelectorAll('.nav-links a');
window.addEventListener('scroll', () => {
    let cur = '';
    sections.forEach(s => {
    if (window.scrollY >= s.offsetTop - 120) cur = s.id;
    });
    navLinks.forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + cur);
    });
});

/* CURSOR HOVER EFFECT */
document.querySelectorAll('a, button, .service-card').forEach(el => {
    el.addEventListener('mouseenter', () => {
    ring.style.width = '56px';
    ring.style.height = '56px';
    ring.style.opacity = '0.35';
    });
    el.addEventListener('mouseleave', () => {
    ring.style.width = '36px';
    ring.style.height = '36px';
    ring.style.opacity = '0.5';
    });
});