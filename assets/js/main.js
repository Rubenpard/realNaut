document.addEventListener('DOMContentLoaded', function () {
  const burger = document.getElementById('burger');
  const menu = document.querySelector('.header__menu-list--main');
  const right = document.querySelector('.header__right');
  const submenuToggles = document.querySelectorAll('.header__submenu-toggle');

  // Menú hamburguesa
  if (burger && menu && right) {
    burger.addEventListener('click', () => {
      const isOpen = menu.classList.toggle('header__menu-list--open');
      right.classList.toggle('header__right--open', isOpen);
      burger.textContent = isOpen ? '✖' : '☰';
    });
  }

  // Cerrar menú móvil al hacer clic en enlaces
  const menuLinks = document.querySelectorAll('.header__menu-list--main a');
  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 900 && menu.classList.contains('header__menu-list--open')) {
        menu.classList.remove('header__menu-list--open');
        right.classList.remove('header__right--open');
        burger.textContent = '☰';
      }
    });
  });

  // Submenús en escritorio (click en el enlace principal)
  const menuItems = document.querySelectorAll('.header__menu-list--main > li');
  menuItems.forEach(item => {
    const subMenu = item.querySelector('ul');
    const link = item.querySelector('a');

    if (subMenu && link) {
      link.addEventListener('click', function (e) {
        if (window.innerWidth > 900) {
          e.preventDefault();
          item.classList.toggle('open');
        }
      });
    }
  });

  // Cerrar submenús al hacer clic fuera (escritorio)
  document.addEventListener('click', function (event) {
    if (window.innerWidth > 900) {
      menuItems.forEach(item => {
        if (!item.contains(event.target)) {
          item.classList.remove('open');
        }
      });
    }
  });

  // Submenús móviles con accesibilidad
  submenuToggles.forEach(button => {
    button.addEventListener('click', function (e) {
      e.stopPropagation();
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);

      const parentLi = this.closest('li');
      const submenu = parentLi.querySelector('.header__submenu');

      if (!expanded) {
        // Cierra otros submenús hermanos
        const siblings = parentLi.parentElement.children;
        Array.from(siblings).forEach(sib => {
          if (sib !== parentLi) {
            const sibSubmenu = sib.querySelector('.header__submenu');
            const sibToggle = sib.querySelector('.header__submenu-toggle');
            if (sibSubmenu && sibToggle) {
              sibSubmenu.classList.remove('header__submenu--open');
              sibToggle.setAttribute('aria-expanded', 'false');
            }
          }
        });
        submenu.classList.add('header__submenu--open');
        parentLi.classList.add('header__menu-item--open');
      } else {
        submenu.classList.remove('header__submenu--open');
        parentLi.classList.remove('header__menu-item--open');
      }
    });
  });
});

const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
  if (window.scrollY > 50) {
    header.classList.add('header--scrolled');
  } else {
    header.classList.remove('header--scrolled');
  }
});