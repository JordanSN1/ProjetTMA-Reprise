/*==================== MENU MOBILE ====================*/
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne les éléments du DOM
    const navMenu = document.getElementById('nav-menu');
    const navToggle = document.getElementById('nav-toggle');
    const navLinks = document.querySelectorAll('.nav__link');
    const header = document.getElementById('header');
    
    // Fonction pour afficher/masquer le menu
    if (navToggle) {
        navToggle.addEventListener('click', function(e) {
            e.preventDefault();
            navMenu.classList.toggle('show-menu');
            
            // Ajoute ou supprime la classe menu-open sur le body
            document.body.classList.toggle('menu-open');
        });
    }
    
    // Ferme le menu quand on clique sur un lien
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Vérifier si le lien est une ancre
            if (this.getAttribute('href').includes('#') && window.innerWidth <= 768) {
                e.preventDefault();
                const targetId = this.getAttribute('href').split('#')[1];
                const targetElement = document.getElementById(targetId);
                
                // Ferme le menu mobile
                navMenu.classList.remove('show-menu');
                document.body.classList.remove('menu-open');
                
                // Attendre que l'animation de fermeture soit terminée
                setTimeout(() => {
                    // Si l'élément existe, fait défiler jusqu'à lui
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    } else if (this.getAttribute('href').split('#')[0]) {
                        // Si c'est un lien vers une autre page
                        window.location.href = this.getAttribute('href');
                    }
                }, 300);
            } else if (window.innerWidth <= 768) {
                // Si ce n'est pas une ancre mais qu'on est en mobile
                navMenu.classList.remove('show-menu');
                document.body.classList.remove('menu-open');
            }
        });
    });
    
    // Fermer le menu quand on clique en dehors
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && 
            navMenu.classList.contains('show-menu') && 
            !navMenu.contains(e.target) && 
            e.target !== navToggle && 
            !navToggle.contains(e.target)) {
            navMenu.classList.remove('show-menu');
            document.body.classList.remove('menu-open');
        }
    });
    
    // Gestion de la taille de l'écran pour le menu
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu.classList.contains('show-menu')) {
            navMenu.classList.remove('show-menu');
            document.body.classList.remove('menu-open');
        }
    });
    
    /*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
    // Obtient toutes les sections avec un ID
    const sections = document.querySelectorAll('section[id]');
    
    // Définir la classe active pour le bon lien en fonction de la page actuelle
    function setActiveLink() {
        // Si nous sommes sur la page d'index
        if (window.location.pathname.includes('index.php') || window.location.pathname.endsWith('/') || window.location.pathname.endsWith('/restaurant/')) {
            // Active le lien basé sur le scroll
            const scrollY = window.pageYOffset;
            
            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 70;
                const sectionId = section.getAttribute('id');
                
                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    try {
                        document.querySelector('.nav__link[href*=' + sectionId + ']').classList.add('active-link');
                    } catch (e) {
                        // Si le sélecteur n'existe pas, ignore l'erreur
                    }
                } else {
                    try {
                        document.querySelector('.nav__link[href*=' + sectionId + ']').classList.remove('active-link');
                    } catch (e) {
                        // Si le sélecteur n'existe pas, ignore l'erreur
                    }
                }
            });
        } else {
            // Pour les autres pages, on enlève active-link de tous les liens
            navLinks.forEach(link => {
                link.classList.remove('active-link');
                
                // Si le lien correspond à la page actuelle
                if (link.getAttribute('href') === window.location.pathname) {
                    link.classList.add('active-link');
                }
            });
        }
    }
    
    // Appelle la fonction au chargement
    setActiveLink();
    
    // Et au scroll pour les pages d'index
    if (window.location.pathname.includes('index.php') || window.location.pathname.endsWith('/') || window.location.pathname.endsWith('/restaurant/')) {
        window.addEventListener('scroll', setActiveLink);
    }
    
    /*==================== CHANGE BACKGROUND HEADER ====================*/
    function scrollHeader() {
        const scrollY = window.pageYOffset;
        
        // Quand le scroll est supérieur à 100px de hauteur, ajoute la classe scroll-header
        if (scrollY >= 100) {
            header.classList.add('scroll-header');
        } else {
            header.classList.remove('scroll-header');
        }
    }
    
    window.addEventListener('scroll', scrollHeader);
    
    /*==================== SCROLL SMOOTH ====================*/
    // Pour tous les liens qui commencent par un #
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Récupère l'ID du lien (sans le #)
            const targetId = this.getAttribute('href').substring(1);
            
            // Trouve l'élément correspondant
            const targetElement = document.getElementById(targetId);
            
            // Si l'élément existe, fait défiler jusqu'à lui
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });
}); 