// Funcionalidad del menú hamburguesa
jQuery(document).ready(function ($) {
    $('#mobile-menu').click(function () {
        $('.nav-menu').toggleClass('active'); 
        $('.menu-toggle').toggleClass('active'); 
        $('.site-header').toggleClass('active'); 
    });
});


document.addEventListener("DOMContentLoaded", function() {
    // Obtener datos de currículo desde el JSON
    fetch(adriaMonroig.jsonUrl)
        .then(response => {
            // Verifica si la respuesta es correcta
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('data-section');
                    showSection(sectionId, data);
                });
            });

            // Muestra la sección correspondiente
            function showSection(section, data) {
                const sections = ['theater', 'tv', 'advertising', 'film'];

                sections.forEach(sec => {
                    const sectionDiv = document.getElementById(sec);
                    if (!sectionDiv) {
                        console.warn(`⚠️ Elemento con ID '${sec}' no encontrado.`);
                        return;
                    }

                    if (sec === section) {
                        sectionDiv.style.display = 'block'; // Mostrar la sección
                        sectionDiv.style.opacity = 1; // Asegurar que sea opaca
                        sectionDiv.innerHTML = renderContent(sec, data[sec]);
                    } else {
                        sectionDiv.style.display = 'none'; // Ocultar las demás secciones
                        sectionDiv.style.opacity = 0; // Hacer invisibles
                    }
                });

                tabs.forEach(tab => {
                    tab.classList.remove('active');
                });

                const activeTab = [...tabs].find(tab => tab.getAttribute('data-section') === section);
                if (activeTab) {
                    activeTab.classList.add('active');
                }
            }

            // Renderiza el contenido para cada sección
            function renderContent(section, items) {
                let content = '';
                items.forEach(item => {
                    if (section === 'theater' || section === 'tv' || section === 'advertising') {
                        content += `<p>${item.year} - ${item.title}${item.venue ? ' (' + item.venue + ')' : ''}${item.network ? ', ' + item.network : ''}${item.client ? ', ' + item.client : ''}</p>`;
                    } else if (section === 'film') {
                        content += `<p>${item.year}: ${item.description}</p>`;
                    }
                });
                return content;
            }

            // Inicializa la primera sección (Theater)
            showSection('theater', data);
        })
        .catch(error => console.error('Error fetching data:', error));

    // Efecto Parallax y scroll
    document.addEventListener("scroll", function () {
        const scrolled = window.pageYOffset;
        const parallaxBg = document.querySelector(".parallax-bg");
        const contentSection = document.querySelector(".content-parallax");
    
        // Parallax para el fondo
        if (parallaxBg) {
            parallaxBg.style.transform = `translateY(${scrolled * 0.7}px)`;
            parallaxBg.style.opacity = Math.max(0, 1 - scrolled / 400);
        }

        // Parallax para la sección de contenido
        if (contentSection) {
            contentSection.style.transform = `translateY(-${Math.min(150, scrolled * 0.4)}px)`;
        }

        // Parallax para la imagen
        const parallaxImage = document.querySelector(".parallax-image");
        if (parallaxImage) {
            parallaxImage.style.transform = `translateY(${scrolled * 0.6}px) scale(${1 + scrolled / 5000})`;
        }

        // Parallax para la historia de la biografía
        const bioStory = document.querySelector(".biography-story");
        if (bioStory) {
            bioStory.style.backgroundPositionY = `${scrolled * 0.3}px`;
        }
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'fadeDuration': 300,
        'imageFadeDuration': 300
    });

    let videos = document.querySelectorAll(".video-item iframe");

    videos.forEach(video => {
        let loader = video.previousElementSibling; // Obtiene el .video-loader asociado

        video.addEventListener("load", function () {
            loader.style.display = "none"; // Oculta el loader cuando el video carga
        });

        // También oculta el loader después de 5 segundos por seguridad
        setTimeout(() => {
            loader.style.display = "none";
        }, 5000);
    });

    let footer = document.querySelector(".site-footer");
        let homeButton = document.querySelector(".home-button");

        function checkFooterVisibility() {
            let rect = footer.getBoundingClientRect();
            let isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            homeButton.style.display = isVisible ? "block" : "none";
        }

        checkFooterVisibility();
        window.addEventListener("scroll", checkFooterVisibility);
        window.addEventListener("resize", checkFooterVisibility);
});






