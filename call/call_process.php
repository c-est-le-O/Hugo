<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Identifier l'utilisateur
$userId = $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : null;

// Définir le chemin du fichier de stockage
$storagePath = '../data/signaling_data/'; // Assurez-vous que ce chemin est correct

// Assurez-vous que le répertoire de stockage existe
if (!file_exists($storagePath)) {
    mkdir($storagePath, 0777, true);
}

function readData($file) {
    global $storagePath;
    $filePath = $storagePath . $file;
    return file_exists($filePath) ? file_get_contents($filePath) : null;
}

function writeData($file, $data) {
    global $storagePath;
    $filePath = $storagePath . $file;
    file_put_contents($filePath, $data);
}

function deleteData($file) {
    global $storagePath;
    $filePath = $storagePath . $file;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

switch ($action) {
    case 'offer':
        $offer = $_POST['offer'];
        writeData('offer_' . $userId, $offer);
        break;
    case 'answer':
        $answer = $_POST['answer'];
        writeData('answer_' . $userId, $answer);
        break;
    case 'candidate':
        $candidate = $_POST['candidate'];
        file_put_contents($storagePath . 'candidates_' . $userId, $candidate . PHP_EOL, FILE_APPEND);
        break;
    case 'get_offer':
        $peerId = $_POST['peer_id'];
        echo readData('offer_' . $peerId);
        break;
    case 'get_answer':
        $peerId = $_POST['peer_id'];
        echo readData('answer_' . $peerId);
        break;
    case 'get_candidates':
        $peerId = $_POST['peer_id'];
        echo readData('candidates_' . $peerId);
        deleteData('candidates_' . $peerId); // Suppression des candidats après la lecture
        break;
    default:
        echo 'Action non reconnue';
        break;
}
?>