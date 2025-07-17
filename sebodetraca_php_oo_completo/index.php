<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set CORS headers to allow frontend requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Get the request URI and method
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove query string from URI
$uri_parts = explode('?', $request_uri);
$path = $uri_parts[0];

// Remove any leading slash and get path components
$path = ltrim($path, '/');
$path_parts = explode('/', $path);

// Helper function to get JSON input data
function getJsonInput() {
    $input = file_get_contents('php://input');
    return json_decode($input, true);
}

// Helper function to send JSON response
function sendJsonResponse($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Router logic
switch ($path) {
    case '':
    case 'index.php':
        // Serve the main index.html file
        if (file_exists('index.html')) {
            include 'index.html';
        } else {
            http_response_code(404);
            echo "Index page not found";
        }
        break;

    case 'api/cadastro':
        if ($request_method === 'POST') {
            // Handle both JSON and form data
            $data = null;
            $content_type = $_SERVER['CONTENT_TYPE'] ?? '';
            
            if (strpos($content_type, 'application/json') !== false) {
                // Handle JSON data
                $data = getJsonInput();
                if ($data) {
                    $_POST['nome'] = $data['nome'] ?? '';
                    $_POST['email'] = $data['email'] ?? '';
                    $_POST['senha'] = $data['senha'] ?? '';
                }
            }
            
            // Include and execute the cadastro.php file
            ob_start();
            try {
                include 'api/cadastro.php';
                $output = ob_get_clean();
                
                // If it was a JSON request, return JSON response
                if (strpos($content_type, 'application/json') !== false) {
                    if (strpos($output, 'sucesso') !== false) {
                        sendJsonResponse(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
                    } else {
                        sendJsonResponse(['success' => false, 'message' => 'Erro ao cadastrar usuário.'], 400);
                    }
                } else {
                    echo $output;
                }
            } catch (Exception $e) {
                ob_get_clean(); // Clear any output buffer
                if (strpos($content_type, 'application/json') !== false) {
                    sendJsonResponse(['success' => false, 'message' => 'Erro de conexão com banco de dados.'], 500);
                } else {
                    echo "Erro de conexão com banco de dados.";
                }
            }
        } else {
            try {
                include 'api/cadastro.php';
            } catch (Exception $e) {
                echo "Erro de conexão com banco de dados.";
            }
        }
        break;

    case 'api/login':
        if ($request_method === 'POST') {
            // Handle both JSON and form data
            $data = null;
            $content_type = $_SERVER['CONTENT_TYPE'] ?? '';
            
            if (strpos($content_type, 'application/json') !== false) {
                // Handle JSON data
                $data = getJsonInput();
                if ($data) {
                    $_POST['email'] = $data['email'] ?? '';
                    $_POST['senha'] = $data['senha'] ?? '';
                }
            }
            
            // Include and execute the login.php file
            ob_start();
            try {
                include 'api/login.php';
                $output = ob_get_clean();
                
                // If it was a JSON request, return JSON response
                if (strpos($content_type, 'application/json') !== false) {
                    if (strpos($output, 'sucesso') !== false) {
                        sendJsonResponse(['success' => true, 'message' => 'Login realizado com sucesso!']);
                    } else {
                        sendJsonResponse(['success' => false, 'message' => 'E-mail ou senha inválidos.'], 401);
                    }
                } else {
                    echo $output;
                }
            } catch (Exception $e) {
                ob_get_clean(); // Clear any output buffer
                if (strpos($content_type, 'application/json') !== false) {
                    sendJsonResponse(['success' => false, 'message' => 'Erro de conexão com banco de dados.'], 500);
                } else {
                    echo "Erro de conexão com banco de dados.";
                }
            }
        } else {
            try {
                include 'api/login.php';
            } catch (Exception $e) {
                echo "Erro de conexão com banco de dados.";
            }
        }
        break;

    case 'api/livros':
        if ($request_method === 'POST') {
            // Handle both JSON and form data
            $data = null;
            $content_type = $_SERVER['CONTENT_TYPE'] ?? '';
            
            if (strpos($content_type, 'application/json') !== false) {
                // Handle JSON data
                $data = getJsonInput();
                if ($data) {
                    $_POST['titulo'] = $data['titulo'] ?? '';
                    $_POST['autor'] = $data['autor'] ?? '';
                    $_POST['paginas'] = $data['paginas'] ?? '';
                    $_POST['editora'] = $data['editora'] ?? '';
                    $_POST['ano'] = $data['ano'] ?? '';
                }
            }
            
            // Include and execute the livros.php file
            ob_start();
            include 'api/livros.php';
            $output = ob_get_clean();
            
            // If it was a JSON request, return JSON response
            if (strpos($content_type, 'application/json') !== false) {
                if (strpos($output, 'sucesso') !== false) {
                    sendJsonResponse(['success' => true, 'message' => 'Livro cadastrado com sucesso!']);
                } else {
                    sendJsonResponse(['success' => false, 'message' => 'Erro ao cadastrar livro.'], 400);
                }
            } else {
                echo $output;
            }
        } else {
            include 'api/livros.php';
        }
        break;

    case 'api/discos':
        if ($request_method === 'POST') {
            // Handle both JSON and form data
            $data = null;
            $content_type = $_SERVER['CONTENT_TYPE'] ?? '';
            
            if (strpos($content_type, 'application/json') !== false) {
                // Handle JSON data
                $data = getJsonInput();
                if ($data) {
                    $_POST['album'] = $data['album'] ?? '';
                    $_POST['artista'] = $data['artista'] ?? '';
                    $_POST['gravadora'] = $data['gravadora'] ?? '';
                    $_POST['nfaixas'] = $data['nfaixas'] ?? '';
                    $_POST['ano'] = $data['ano'] ?? '';
                }
            }
            
            // Include and execute the discos.php file
            ob_start();
            include 'api/discos.php';
            $output = ob_get_clean();
            
            // If it was a JSON request, return JSON response
            if (strpos($content_type, 'application/json') !== false) {
                if (strpos($output, 'sucesso') !== false) {
                    sendJsonResponse(['success' => true, 'message' => 'Disco cadastrado com sucesso!']);
                } else {
                    sendJsonResponse(['success' => false, 'message' => 'Erro ao cadastrar disco.'], 400);
                }
            } else {
                echo $output;
            }
        } else {
            include 'api/discos.php';
        }
        break;

    default:
        // Try to serve static files
        $file_path = __DIR__ . '/' . $path;
        
        if (file_exists($file_path) && is_file($file_path)) {
            // Get file extension to set appropriate content type
            $ext = pathinfo($file_path, PATHINFO_EXTENSION);
            
            switch ($ext) {
                case 'html':
                    header('Content-Type: text/html');
                    break;
                case 'css':
                    header('Content-Type: text/css');
                    break;
                case 'js':
                    header('Content-Type: application/javascript');
                    break;
                case 'png':
                    header('Content-Type: image/png');
                    break;
                case 'jpg':
                case 'jpeg':
                    header('Content-Type: image/jpeg');
                    break;
                case 'gif':
                    header('Content-Type: image/gif');
                    break;
                default:
                    header('Content-Type: application/octet-stream');
            }
            
            readfile($file_path);
        } else {
            // 404 Not Found
            http_response_code(404);
            echo "404 - Page not found";
        }
        break;
}
?>