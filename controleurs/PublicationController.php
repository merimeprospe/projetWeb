<?php
require_once __DIR__ . '/../modules/DAO/PublicationDAO.php';

class GoodPublicationController {
    private $publicationDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();
        $this->publicationDAO = new PublicationDAO($conn);
    }

    public function listPublications() {
        $publications = $this->publicationDAO->findAllPublications();
        require_once './pages/publications.php';
    }

    public function blockPublication($id_pub) {
        header('Content-Type: application/json');
        if ($this->publicationDAO->blockPublication($id_pub)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors du blocage de la publication']);
        }
        exit();
    }

    public function activatePublication($id_pub) {
        header('Content-Type: application/json');
        if ($this->publicationDAO->activatePublication($id_pub)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'activation de la publication']);
        }
        exit();
    }

    public function deletePublication($id_pub) {
        header('Content-Type: application/json');
        if ($this->publicationDAO->deletePublication($id_pub)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression de la publication']);
        }
        exit();
    }

    public function getPublicationDetails($id_pub) {
        header('Content-Type: application/json');
        $publication = $this->publicationDAO->findPublicationById($id_pub);
        $comments = $this->publicationDAO->getPublicationComments($id_pub);
        $likes = $this->publicationDAO->getPublicationLikes($id_pub);
        echo json_encode([
            'publication' => $publication,
            'comments' => $comments,
            'likes' => $likes
        ]);
        exit();
    }
}