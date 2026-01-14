<?php
// generate_pdf.php
require('fpdf.php');

// 1. Paramètres de connexion
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Récupération des vraies données
    $totalEtudiants = $pdo->query("SELECT COUNT(*) FROM etudiant")->fetchColumn();
    $totalLivres = $pdo->query("SELECT COUNT(*) FROM livre")->fetchColumn();

    // 3. Création du PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // --- En-tête ---
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(0, 86, 179); // Bleu comme votre thème
    $pdf->Cell(0, 20, utf8_decode('BIBLIO 2 - RAPPORT GÉNÉRAL'), 0, 1, 'C');
    
    $pdf->SetDrawColor(0, 86, 179);
    $pdf->Line(10, 30, 200, 30); // Ligne de séparation
    $pdf->Ln(10);

    // --- Corps du rapport ---
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, "Date de generation : " . date('d/m/Y H:i'), 0, 1);
    $pdf->Ln(5);

    // Tableau des statistiques
    $pdf->SetFillColor(230, 240, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(95, 12, utf8_decode("Indicateur"), 1, 0, 'C', true);
    $pdf->Cell(95, 12, utf8_decode("Valeur"), 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(95, 12, utf8_decode("Étudiants Inscrits"), 1, 0, 'L');
    $pdf->Cell(95, 12, $totalEtudiants, 1, 1, 'C');

    $pdf->Cell(95, 12, utf8_decode("Livres en Stock"), 1, 0, 'L');
    $pdf->Cell(95, 12, $totalLivres, 1, 1, 'C');

    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, utf8_decode("Fin du rapport automatique."), 0, 0, 'C');
    $pdf->Output('I', 'Rapport_Biblio.pdf');

} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}?>
