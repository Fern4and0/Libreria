<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Libros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f6f0;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 40px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            color: #2c3e50;
        }

        .login-button {
            padding: 10px 20px;
            background-color: #2c5530;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-button:hover {
            background-color: #1e3d23;
            transform: translateY(-1px);
        }

        .search-section {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 40px;
        }

        .category-select {
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            color: #666;
            min-width: 160px;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        .search-button {
            padding: 12px 24px;
            background-color: #2c5530;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-button:hover {
            background-color: #1e3d23;
        }

        .section {
            margin-bottom: 50px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .ver-todos {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .ver-todos:hover {
            color: #2c5530;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px;
        }

        .book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .book-cover {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .book-cover.green { background: linear-gradient(135deg, #a8e6cf 0%, #7fcdcd 100%); }
        .book-cover.blue { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
        .book-cover.dark { background: linear-gradient(135deg, #2d3436 0%, #636e72 100%); }
        .book-cover.red { background: linear-gradient(135deg, #fab1a0 0%, #e17055 100%); }
        .book-cover.teal { background: linear-gradient(135deg, #81ecec 0%, #00b894 100%); }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .category-icon {
            width: 80px;
            height: 100px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .category-icon.money { background: linear-gradient(135deg, #e17055 0%, #d63031 100%); }
        .category-icon.design { background: linear-gradient(135deg, #fdcb6e 0%, #f39c12 100%); }
        .category-icon.business { background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%); }
        .category-icon.habits { background: linear-gradient(135deg, #fab1a0 0%, #e84393 100%); }
        .category-icon.fiction { background: linear-gradient(135deg, #81ecec 0%, #00b894 100%); }

        .category-name {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
            
            .search-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .category-select, .search-input {
                margin-bottom: 10px;
            }
            
            .books-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }
            
            .book-cover {
                height: 200px;
            }
        }
    </style>
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