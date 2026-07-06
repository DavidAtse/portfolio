/* CURSOR */
const curDot  = document.getElementById('cursor');
const curRing = document.getElementById('cursor-ring');
document.addEventListener('mousemove', e => {
    curDot.style.left  = e.clientX + 'px';
    curDot.style.top   = e.clientY + 'px';
    setTimeout(() => {
        curRing.style.left = e.clientX + 'px';
        curRing.style.top  = e.clientY + 'px';
    }, 60);
});

/* LOADER */
const counter = document.getElementById('loader-counter');
if (counter) {
    let count = 0;
    const interval = setInterval(() => {
        count = Math.min(count + Math.floor(Math.random() * 6 + 2), 100);
        counter.textContent = count + '%';
        if (count >= 100) clearInterval(interval);
    }, 80);
}
setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hidden');
    document.body.style.overflowY = 'auto';
}, 2600);

/* HAMBURGER MENU */
const hamburger = document.getElementById('nav-hamburger');
const navMenu   = document.querySelector('.nav-links');
if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        navMenu.classList.toggle('open');
    });
    navMenu.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navMenu.classList.remove('open');
        });
    });
}

/* SCROLL REVEAL */
function checkReveal() {
    document.querySelectorAll('.reveal:not(.visible)').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 60) {
            el.classList.add('visible');
        }
    });
}
window.addEventListener('scroll', checkReveal, { passive: true });
checkReveal();

/* ACTIVE NAV ON SCROLL */
const sections   = document.querySelectorAll('section[id]');
const navLinkEls = document.querySelectorAll('.nav-links a');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 120) current = s.id;
    });
    navLinkEls.forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === '#' + current);
    });
});

/* CURSOR HOVER EFFECT */
document.querySelectorAll('a, button, .service-card').forEach(el => {
    el.addEventListener('mouseenter', () => {
        curRing.style.width   = '56px';
        curRing.style.height  = '56px';
        curRing.style.opacity = '0.35';
    });
    el.addEventListener('mouseleave', () => {
        curRing.style.width   = '36px';
        curRing.style.height  = '36px';
        curRing.style.opacity = '0.5';
    });
});
