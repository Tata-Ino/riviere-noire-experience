import './bootstrap';

document.querySelectorAll('[data-locale]').forEach(el => {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        const locale = this.dataset.locale;
        window.location.href = '/language/' + locale;
    });
});

document.querySelectorAll('[data-slug-source]').forEach(source => {
    const target = document.querySelector(source.dataset.slugTarget);
    if (target) {
        source.addEventListener('input', function() {
            target.value = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
        });
    }
});

document.querySelectorAll('[data-filter]').forEach(btn => {
    btn.addEventListener('click', function() {
        const filter = this.dataset.filter;
        document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        document.querySelectorAll('.gallery-item').forEach(item => {
            if (filter === 'all' || item.dataset.type === filter) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

setTimeout(() => {
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
