/*==================== DARK LIGHT THEME ====================*/ 
document.addEventListener('DOMContentLoaded', function() {
    const themeButton = document.getElementById('theme-button');
    const darkTheme = 'dark-theme';
    const iconTheme = 'bx-sun';

    // Thème précédemment sélectionné (si l'utilisateur en a sélectionné un)
    const selectedTheme = localStorage.getItem('selected-theme');
    const selectedIcon = localStorage.getItem('selected-icon');

    // On obtient le thème actuel de l'interface en validant la classe dark-theme
    const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
    const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'bx-moon' : 'bx-sun';

    // On valide si l'utilisateur a précédemment choisi un thème
    if (selectedTheme) {
        // Si la validation est remplie, on demande quel était le problème pour savoir si on a activé ou désactivé le dark
        document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
        themeButton.classList[selectedIcon === 'bx-moon' ? 'add' : 'remove'](iconTheme);
    }

    // Activer/désactiver le thème manuellement avec le bouton
    themeButton.addEventListener('click', () => {
        // Ajouter ou supprimer le thème sombre / icône
        document.body.classList.toggle(darkTheme);
        themeButton.classList.toggle(iconTheme);
        // On sauvegarde le thème et l'icône actuelle que l'utilisateur a choisi
        localStorage.setItem('selected-theme', getCurrentTheme());
        localStorage.setItem('selected-icon', getCurrentIcon());
    });
}); 