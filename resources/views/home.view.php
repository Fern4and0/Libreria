<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Libreria/public/assets/css/home.css">
    <title>Biblioteca de Libros</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-top">
                <h1>Descubre nuevos libros</h1>
                <button class="login-button" onclick="handleLogin()">
                    Iniciar Sesión
                </button>
            </div>
            
            <div class="search-section">
                <select class="category-select">
                    <option>Todas las categorías</option>
                    <option>Ficción</option>
                    <option>No ficción</option>
                    <option>Negocios</option>
                    <option>Diseño</option>
                    <option>Superación personal</option>
                </select>
                <input type="text" class="search-input" placeholder="Encuentra el libro que quieres">
                <button class="search-button">Buscar</button>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Libros populares</h2>
                <a href="#" class="ver-todos">Ver todos →</a>
            </div>
            
            <div class="books-grid">
                <div class="book-card">
                    <div class="book-cover green">
                        <div>
                            <div style="font-size: 18px; margin-bottom: 10px;">LOS HOMBRES DEL NORTE</div>
                            <div style="font-size: 12px; opacity: 0.8;">JOHN HAYWOOD</div>
                        </div>
                    </div>
                </div>
                
                <div class="book-card">
                    <div class="book-cover blue">
                        <div>
                            <div style="font-size: 18px; margin-bottom: 10px;">J.R.R. TOLKIEN</div>
                            <div style="font-size: 14px; margin-bottom: 5px;">EL SEÑOR</div>
                            <div style="font-size: 14px;">DE LOS ANILLOS</div>
                        </div>
                    </div>
                </div>
                
                <div class="book-card">
                    <div class="book-cover dark">
                        <div>
                            <div style="font-size: 18px; margin-bottom: 10px;">EL VALS</div>
                            <div style="font-size: 18px;">DE LA BRUJA</div>
                        </div>
                    </div>
                </div>
                
                <div class="book-card">
                    <div class="book-cover red">
                        <div>
                            <div style="font-size: 18px; margin-bottom: 10px;">EL JARDÍN</div>
                            <div style="font-size: 18px; margin-bottom: 10px;">DE LAS</div>
                            <div style="font-size: 18px;">MARIPOSAS</div>
                        </div>
                    </div>
                </div>
                
                <div class="book-card">
                    <div class="book-cover teal">
                        <div>
                            <div style="font-size: 18px; margin-bottom: 10px;">EL JARDÍN</div>
                            <div style="font-size: 18px;">SECRETO</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Categorías</h2>
                <a href="#" class="ver-todos">⚙️</a>
            </div>
            
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon money">💰</div>
                    <div class="category-name">Dinero/Inversiones</div>
                </div>
                
                <div class="category-card">
                    <div class="category-icon design">🎨</div>
                    <div class="category-name">Diseño</div>
                </div>
                
                <div class="category-card">
                    <div class="category-icon business">💼</div>
                    <div class="category-name">Negocios</div>
                </div>
                
                <div class="category-card">
                    <div class="category-icon habits">⚡</div>
                    <div class="category-name">Superación personal</div>
                </div>
                
                <div class="category-card">
                    <div class="category-icon fiction">📚</div>
                    <div class="category-name">Ficción</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad del botón de login
        function handleLogin() {
            // Aquí puedes agregar la lógica de autenticación real
            alert('Redirigiendo a la página de inicio de sesión...');
        }

        // Funcionalidad de búsqueda
        document.querySelector('.search-button').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value;
            const category = document.querySelector('.category-select').value;
            
            if (searchTerm.trim()) {
                alert(`Buscando: "${searchTerm}" en categoría: ${category}`);
            } else {
                alert('Por favor, ingresa un término de búsqueda');
            }
        });

        // Funcionalidad para presionar Enter en el campo de búsqueda
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-button').click();
            }
        });

        // Hover effects para las tarjetas
        document.querySelectorAll('.book-card, .category-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.cursor = 'pointer';
            });
            
            card.addEventListener('click', function() {
                if (this.classList.contains('book-card')) {
                    alert('Abriendo libro...');
                } else {
                    alert('Explorando categoría...');
                }
            });
        });
    </script>
</body>
</html>