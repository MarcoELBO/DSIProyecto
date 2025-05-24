document.addEventListener('DOMContentLoaded', function() {
    const dropdownTriggers = document.querySelectorAll('.dropdown__trigger');

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            // Prevenir la navegación por defecto del enlace '#'
            e.preventDefault(); 
            // Prevenir que el clic se propague al documento (para cerrar otros menús)
            e.stopPropagation();

            const parentItem = this.closest('.dropdown');
            
            // Cerrar otros menús abiertos
            document.querySelectorAll('.dropdown.active').forEach(item => {
                if (item !== parentItem) {
                    item.classList.remove('active');
                }
            });

            // Toggle del menú actual
            parentItem.classList.toggle('active');
        });
    });

    // Cerrar el menú si se hace clic fuera de él en dispositivos móviles
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.main-nav')) {
            document.querySelectorAll('.dropdown.active').forEach(item => {
                item.classList.remove('active');
            });
            document.getElementById('menu-toggle').checked = false; // Cierra el menú de hamburguesa
        }
    });
});