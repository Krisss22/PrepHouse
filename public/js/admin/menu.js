const itemsWithSubMenu = document.querySelectorAll('#admin-main-menu .has-sub-menu');
itemsWithSubMenu && itemsWithSubMenu.forEach(function(el) {
    el.addEventListener('click', function(event) {
        const element = event.currentTarget;
        let subMenuElement = element.querySelector('.nav-item-submenu');
        if (subMenuElement && subMenuElement.classList.contains('hidden')) {
            hideAllSubMenus();
            subMenuElement.classList.remove('hidden');
        } else {
            subMenuElement.classList.add('hidden');
        }
    });
});

function hideAllSubMenus() {
    const subMenus = document.querySelectorAll('#admin-main-menu .nav-item-submenu');
    subMenus && subMenus.forEach(function(element) {
        if (!element.classList.contains('hidden')) {
            element.classList.add('hidden');
        }
    });
}
