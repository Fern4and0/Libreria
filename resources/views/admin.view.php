<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Libreria/public/assets/css/admin.css">
    <title>Panel de Administración - Libros</title>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="nav-container">
            <div class="nav-left">
                <span class="home-icon">🏠</span>
                <span class="nav-title">Inicio</span>
            </div>
            <div class="nav-right" onclick="handleLogout()">
                Cerrar sesión
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        <div class="content-header">
            <div></div>
            <button class="add-book-btn" onclick="openAddModal()">
                <div class="add-icon"></div>
                Agregar Libro
            </button>
        </div>

        <div class="books-table" id="booksTable">
            <!-- Los libros se cargarán aquí dinámicamente -->
        </div>
    </main>

    <!-- Modal para Agregar/Editar Libro -->
    <div class="modal" id="bookModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Agregar Libro</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            
            <form id="bookForm">
                <div class="form-group">
                    <label class="form-label">Título</label>
                    <input type="text" id="bookTitle" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Autor</label>
                    <input type="text" id="bookAuthor" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Año</label>
                    <input type="number" id="bookYear" class="form-input" required min="1000" max="2030">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Género</label>
                    <select id="bookGenre" class="form-select" required>
                        <option value="">Seleccionar género</option>
                        <option value="Superación personal">Superación personal</option>
                        <option value="Terror">Terror</option>
                        <option value="Romance">Romance</option>
                        <option value="Acción">Acción</option>
                        <option value="Ficción">Ficción</option>
                        <option value="No ficción">No ficción</option>
                        <option value="Ciencia">Ciencia</option>
                        <option value="Historia">Historia</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select id="bookStatus" class="form-select" required>
                        <option value="Disponible">Disponible</option>
                        <option value="No Disponible">No Disponible</option>
                    </select>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Ver Libro -->
    <div class="modal" id="viewBookModal">
        <div class="view-modal-content">
            <div class="view-modal-header">
                <button class="view-modal-close" onclick="closeViewModal()">&times;</button>
                <div class="book-cover-large" id="viewBookCover">
                    <div id="viewBookCoverText">TÍTULO DEL LIBRO</div>
                </div>
                <h1 class="book-title-large" id="viewBookTitle">Título del libro</h1>
                <p class="book-author-large" id="viewBookAuthor">Autor</p>
            </div>
            
            <div class="view-modal-body">
                <div class="book-description" id="viewBookDescription">
                    En La Isla del Viento Eterno, el joven explorador Elías Ferrel se embarca en una misión imposible tras descubrir un antiguo mapa oculto en el desván de su abuelo. La ruta lo lleva a una isla misteriosa perdida en el océano Índico, rodeada de leyendas sobre tormentas perpetuas, tribus ancestrales y un tesoro maldito que nunca ha sido reclamado.
                </div>
                
                <div class="book-details">
                    <div class="detail-item">
                        <span class="detail-label">Autor:</span>
                        <span class="detail-value" id="viewBookAuthorDetail">Andrés Lopez</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Género:</span>
                        <span class="detail-value" id="viewBookGenre">Terror</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Año:</span>
                        <span class="detail-value" id="viewBookYear">2001</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Estado:</span>
                        <span class="detail-value" id="viewBookStatus">No Disponible</span>
                    </div>
                    
                    <div class="availability-status" id="viewBookAvailability">
                        Disponible en la Biblioteca
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Datos de ejemplo
        let books = [
            {
                id: 1,
                title: "Atomic Habits",
                author: "James Clear",
                year: 2018,
                genre: "Superación personal",
                status: "No Disponible",
                cover: "orange",
                description: "Un método revolucionario para crear buenos hábitos y abandonar los malos. James Clear nos muestra cómo pequeños cambios pueden generar resultados extraordinarios a lo largo del tiempo."
            },
            {
                id: 2,
                title: "El Principito",
                author: "Andrés Lopez",
                year: 2001,
                genre: "Terror",
                status: "No Disponible",
                cover: "brown",
                description: "En La Isla del Viento Eterno, el joven explorador Elías Ferrel se embarca en una misión imposible tras descubrir un antiguo mapa oculto en el desván de su abuelo. La ruta lo lleva a una isla misteriosa perdida en el océano Índico, rodeada de leyendas sobre tormentas perpetuas, tribus ancestrales y un tesoro maldito que nunca ha sido reclamado."
            },
            {
                id: 3,
                title: "Hasta Que El Té Se Enfríe",
                author: "Sutana Perengana",
                year: 2006,
                genre: "Romance",
                status: "Disponible",
                cover: "green",
                description: "Una emotiva historia sobre segundas oportunidades y el poder transformador del tiempo. Una novela que explora los vínculos humanos más profundos a través de encuentros inesperados en un pequeño café."
            },
            {
                id: 4,
                title: "Spy x Family",
                author: "Gege Akutami",
                year: 2018,
                genre: "Acción",
                status: "Disponible",
                cover: "colorful",
                description: "Una familia poco convencional formada por un espía, una asesina y una telépata debe mantener sus secretos mientras navegan por misiones peligrosas y la vida cotidiana. Una mezcla perfecta de acción, comedia y drama familiar."
            }
        ];

        let editingBookId = null;

        // Función para renderizar los libros
        function renderBooks() {
            const container = document.getElementById('booksTable');
            container.innerHTML = '';

            books.forEach(book => {
                const bookRow = document.createElement('div');
                bookRow.className = 'book-row';
                bookRow.innerHTML = `
                    <div class="book-cover-small ${book.cover}">
                        <div style="font-size: 8px; font-weight: bold;">${book.title.toUpperCase()}</div>
                    </div>
                    <div class="book-info">
                        <h3>${book.title}</h3>
                        <p>${book.author}</p>
                        <p>${book.year}</p>
                    </div>
                    <div class="book-genre">
                        Genero: ${book.genre}<br>
                        ${book.status}
                    </div>
                    <div class="book-actions">
                        <button class="action-btn edit-btn" onclick="editBook(${book.id})">Editar</button>
                        <button class="action-btn view-btn" onclick="viewBook(${book.id})">Ver</button>
                        <button class="action-btn delete-btn" onclick="deleteBook(${book.id})">Eliminar</button>
                    </div>
                `;
                container.appendChild(bookRow);
            });
        }

        // Función para abrir modal de agregar
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Agregar Libro';
            document.getElementById('bookForm').reset();
            editingBookId = null;
            document.getElementById('bookModal').style.display = 'block';
        }

        // Función para editar libro
        function editBook(id) {
            const book = books.find(b => b.id === id);
            if (book) {
                document.getElementById('modalTitle').textContent = 'Editar Libro';
                document.getElementById('bookTitle').value = book.title;
                document.getElementById('bookAuthor').value = book.author;
                document.getElementById('bookYear').value = book.year;
                document.getElementById('bookGenre').value = book.genre;
                document.getElementById('bookStatus').value = book.status;
                editingBookId = id;
                document.getElementById('bookModal').style.display = 'block';
            }
        }

        // Función para ver libro (nueva versión con modal)
        function viewBook(id) {
            const book = books.find(b => b.id === id);
            if (book) {
                // Actualizar el contenido del modal
                document.getElementById('viewBookCover').className = `book-cover-large ${book.cover}`;
                document.getElementById('viewBookCoverText').textContent = book.title.toUpperCase();
                document.getElementById('viewBookTitle').textContent = book.title;
                document.getElementById('viewBookAuthor').textContent = book.author;
                document.getElementById('viewBookDescription').textContent = book.description;
                document.getElementById('viewBookAuthorDetail').textContent = book.author;
                document.getElementById('viewBookGenre').textContent = book.genre;
                document.getElementById('viewBookYear').textContent = book.year;
                document.getElementById('viewBookStatus').textContent = book.status;
                
                // Actualizar el estado de disponibilidad
                const availabilityElement = document.getElementById('viewBookAvailability');
                if (book.status === 'Disponible') {
                    availabilityElement.textContent = 'Disponible en la Biblioteca';
                    availabilityElement.className = 'availability-status available';
                } else {
                    availabilityElement.textContent = 'No Disponible Actualmente';
                    availabilityElement.className = 'availability-status unavailable';
                }
                
                // Mostrar el modal
                document.getElementById('viewBookModal').style.display = 'block';
            }
        }

        // Función para cerrar el modal de vista
        function closeViewModal() {
            document.getElementById('viewBookModal').style.display = 'none';
        }

        // Función para eliminar libro
        function deleteBook(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este libro?')) {
                books = books.filter(b => b.id !== id);
                renderBooks();
            }
        }

        // Función para cerrar modal
        function closeModal() {
            document.getElementById('bookModal').style.display = 'none';
            editingBookId = null;
        }

        // Función para manejar el envío del formulario
        document.getElementById('bookForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const bookData = {
                title: document.getElementById('bookTitle').value,
                author: document.getElementById('bookAuthor').value,
                year: parseInt(document.getElementById('bookYear').value),
                genre: document.getElementById('bookGenre').value,
                status: document.getElementById('bookStatus').value,
                cover: ['orange', 'brown', 'green', 'colorful'][Math.floor(Math.random() * 4)],
                description: 'Descripción generada automáticamente para este libro. Una historia fascinante que captura la imaginación del lector desde la primera página.'
            };

            if (editingBookId) {
                // Editar libro existente
                const bookIndex = books.findIndex(b => b.id === editingBookId);
                if (bookIndex !== -1) {
                    books[bookIndex] = { ...books[bookIndex], ...bookData };
                }
            } else {
                // Agregar nuevo libro
                const newId = Math.max(...books.map(b => b.id)) + 1;
                books.push({ id: newId, ...bookData });
            }

            renderBooks();
            closeModal();
        });

        // Función para cerrar sesión
        function handleLogout() {
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                alert('Cerrando sesión...');
                // Aquí puedes agregar la lógica de logout real
            }
        }

        // Cerrar modals al hacer clic fuera de ellos
        window.addEventListener('click', function(e) {
            const bookModal = document.getElementById('bookModal');
            const viewModal = document.getElementById('viewBookModal');
            
            if (e.target === bookModal) {
                closeModal();
            }
            
            if (e.target === viewModal) {
                closeViewModal();
            }
        });

        // Renderizar libros al cargar la página
        renderBooks();
    </script>