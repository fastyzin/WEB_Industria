function openDrawer() {

    var drawer = document.getElementById('drawer');
    drawer.classList.add('open');
    }

function closeDrawer() {
    var drawer = document.getElementById('drawer');
    drawer.classList.remove('open');
    }

    document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDrawer();
    }
});

