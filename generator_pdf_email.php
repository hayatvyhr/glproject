<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';

$recipientEmail = $_POST['email']; 
$demandeID = $_POST['demandeID'];
$subject = 'Reponse a la reclamation declaree.'; 
$message = 'Votre document demandé'; 
$pdfContent = generatePDF($demandeID);

sendEmailWithAttachment($recipientEmail, $subject, $message, $pdfContent);

function generatePDF($demandeID) {
  $host = "localhost:3307";
  $username = "root";
  $password = "";
  $database = "gestionetudiants";
  $conn = new mysqli($host, $username, $password, $database);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sqlDemande = "SELECT * FROM demande WHERE id = $demandeID";
  $sqlReleveNotes = "SELECT * FROM relevenotes WHERE id = $demandeID";
  $sqlConventionStage = "SELECT * FROM conventionstage WHERE id = $demandeID";
  $sqlDocumentAcademique = "SELECT * FROM documentacademique WHERE id = $demandeID";



  $resultDemande = $conn->query($sqlDemande);
  $resultReleveNotes = $conn->query($sqlReleveNotes);
  $resultConventionStage = $conn->query($sqlConventionStage);
  $resultDocumentAcademique = $conn->query($sqlDocumentAcademique);


  $typeDemandeID = 'typeDemandeID';
  $attestationscolarite = 'Attestation de scolarite';
  $attestationresusite = 'Attestation de reussite';
  $convention = 'conventionstage';
  $relevenotes = 'relevenotes';



  if ($resultDemande->num_rows > 0) {
      $rowDemande = $resultDemande->fetch_assoc();


      $etudiantID =   $rowDemande['etudiantID'];
      $sqlEtudiant = "SELECT * FROM etudiant WHERE id = $etudiantID";
      $resultetudiant = $conn->query($sqlEtudiant);
      $rowEtudiant = $resultetudiant->fetch_assoc();

      $options = new Options();
      $options->set('isHtml5ParserEnabled', true);
      $options->set('isPhpEnabled', true);
      
      $dompdf = new Dompdf($options);

      
      $html  = '<div style="text-align: center;">';
      $html .= '<h2 style="color: #728FCE; font-weight: bold;">École Nationale des Sciences Appliquées de Tétouan</h2>';
      $html .= '</div>';
      
      $html .= '<div>';
      $html .= '<p>Etudiant nom: ' . $rowEtudiant['nomEtudiant'] . '</p>';
      $html .= '<p>Etudiant ID: ' . $rowEtudiant['id'] . '</p>';
      $html .= '<p>CodeApogee: ' . $rowEtudiant['codeApogee'] . '</p>';
      $html .= '<p>CIN: ' . $rowEtudiant['cin'] . '</p>';
      $html .= '</div>';
      
    
      

      


      if ($rowDemande[$typeDemandeID] === $convention && $resultConventionStage->num_rows > 0) {
        $rowConventionStage = $resultConventionStage->fetch_assoc();
      $html .= '<table style="width:100%; border-collapse: collapse;">';
      $html .= '<tr><td colspan="2">&nbsp;</td></tr>';    
        $html .= '<table>';
          $html .= '<tr>';
          $html .= '<td colspan="2" style="text-align: center;"><strong>Convention de Stage</strong></td>';
          $html .= '</tr>';
          $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
          $html .= '<tr>';
          $html .= '<td colspan="2"> L’Ecole Nationale des Sciences Appliquées, Université Abdelmalek Essaâdi - Tétouan
          B.P. 2222, Mhannech II, Tétouan , Maroc
          Tél. +212 5 39 68 80 27 ; Fax. +212 39 99 46 24. Web: https://ensa-tetouan.ac.ma
            Représenté par le Professeur Kamal REKLAOUI en qualité de Directeur.     
          </td>';
          $html .= '</tr>';
          $html .= '<tr><td colspan="2">&nbsp;</td></tr>';

        $fields = array(
            'Nom de l\'Entreprise' => 'nomEntreprise',
            'Secteur' => 'secteur',
            'Téléphone' => 'telephone',
            'Email' => 'email',
            'Address' => 'address',
            'Ville' => 'ville',
            'Représentant' => 'representant',
            'Fonction du Représentant' => 'fonctionRepresentant',
            'Superviseur de l\'Entreprise' => 'superviseurEntreprise',
            'Fonction du Superviseur' => 'fonctionSuperviseur',
            'Email du Superviseur' => 'emailSuperviseur',
            'Tel du Superviseur' => 'telSuperviseur',
            'Superviseur à l\'ENSA' => 'superviseurEnsa',
            'Duree' => 'duree',
            'Sujet' => 'sujet'
        );
    
        foreach ($fields as $label => $fieldName) {
            $html .= '<tr>';
            $html .= '<td><strong>' . $label . ':</strong></td>';
            $html .= '<td>' . $rowConventionStage[$fieldName] . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</table>';
    }
    
      elseif ($rowDemande[$typeDemandeID] === $relevenotes  && $resultReleveNotes->num_rows > 0) {
          $rowReleveNotes = $resultReleveNotes->fetch_assoc();
            $html .= '<table style="width:100%; border-collapse: collapse;">';

          $html .= '<table>';
          $html .= '<tr>';
          $html .= '<td colspan="2" style="text-align: center;"><strong>Le relevé de notes</strong></td>';
          $html .= '</tr>';
      
          $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
      
          $html .= '<tr>';
          $html .= '<td colspan="2">La présente attestation a été délivrée par l\'École Nationale des Sciences Appliquées de Tétouan.';
          $html .= 'Ceci confirme que l\'étudiant a soumis une demande de relevé de notes.</p>';
          $html .= '<p>Nous vous prions de trouver ci-joint le relevé de notes demandé.</p>';
          $html .= '</td>';
          $html .= '</tr>';
      
          $fields = array(
              'Student Name' => 'nomEtudiant',
              'CIN' => 'cin',
              'Date of Birth' => 'dateNaissance',
              'Address' => 'address',
              'Academic Year' => 'anneeAcademique',
              'Programme' => 'programme',
              'Module' => 'module',
              'Average' => 'moyenne',
              'Observation' => 'observation'
          );
      
          foreach ($fields as $label => $fieldName) {
              $html .= '<tr>';
              $html .= '<td><strong>' . $label . ':</strong></td>';
              $html .= '<td>' . $rowReleveNotes[$fieldName] . '</td>';
              $html .= '</tr>';
          }
      
          $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
      
          $html .= '<tr>';
          $html .= '<td colspan="2" style="text-align: center;"><strong>Informations sur les notes des modules</strong></td>';
          $html .= '</tr>';
          $html .= '<tr><td colspan="2">&nbsp;</td></tr>';

          $sqlNotes = "SELECT * FROM notes WHERE ID_ETU = $etudiantID AND ANNEE_SCOL = '{$rowReleveNotes['anneeAcademique']}'";
          $resultNotes = $conn->query($sqlNotes);
      
          if ($resultNotes->num_rows > 0) {
              $rowNotes = $resultNotes->fetch_assoc();
              $modules = array('MODULE1', 'MODULE2', 'MODULE3', 'MODULE4', 'MODULE5', 'MODULE6', 'MODULE7', 'MODULE8', 'MODULE9', 'MODULE10', 'MODULE11', 'MODULE12');
      
              foreach ($modules as $module) {
                if (!empty($rowNotes[$module])) {

                  $html .= '<tr>';
                  $html .= '<td><strong>' . $module . ':</strong></td>';
                  $html .= '<td>' . $rowNotes[$module] . '</td>';
                  $html .= '</tr>';
                }
              }
          }
      
      $html .= '</table>';
      $html .= '</table>';

      }
      if ($rowDemande[$typeDemandeID] === $attestationscolarite && $resultDocumentAcademique->num_rows > 0) {
        $rowDocumentAcademique = $resultDocumentAcademique->fetch_assoc();
    
        $html .= '<table style="width:100%; border-collapse: collapse;">';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
    
        $html .= '<table style="width:100%; border-collapse: collapse;">';
    
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center;"><strong>Attestation de Scolarité</strong></td>';
        $html .= '</tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
    
        $html .= '<tr>';
        $html .= '<td colspan="2">La présente attestation a été délivrée par l\'École Nationale des Sciences Appliquées de Tétouan.<br>';
        $html .= 'Ceci confirme que l\'étudiant a soumis une demande de type "' . $rowDemande[$typeDemandeID] . '".</p>';
        $html .= '<p>Nous vous prions de trouver ci-joint le document demandé.</p>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
    
        $fields = array(
            'Contenu' => 'contenu',
            'Format' => 'format',
            'Nom de l\'Étudiant' => 'nomEtudiant',
            'CIN' => 'cin',
            'Date de Naissance' => 'dateNaissance',
            'Address' => 'address',
            'Année Académique' => 'anneeAcademique',
            'Programme' => 'programme',
            'Module' => 'module',
            'Moyenne' => 'moyenne',
            'Observation' => 'observation',
        );
    
        foreach ($fields as $label => $fieldName) {
            $html .= '<tr>';
            $html .= '<td style="width:30%;"><strong>' . $label . ':</strong></td>';
            $html .= '<td>' . $rowDocumentAcademique[$fieldName] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
    
        $html .= '</table>';
    }
    elseif ($rowDemande[$typeDemandeID] === $attestationresusite && $resultDocumentAcademique->num_rows > 0) {
      $rowDocumentAcademique = $resultDocumentAcademique->fetch_assoc();
  
      $html .= '<table style="width:100%; border-collapse: collapse;">';
      $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
  
      $html .= '<table style="width:100%; border-collapse: collapse;">';
  
      $html .= '<tr>';
      $html .= '<td colspan="2" style="text-align: center;"><strong>Attestation de Reussite</strong></td>';
      $html .= '</tr>';
      $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
  
      $html .= '<tr>';
      $html .= '<td colspan="2">La présente attestation a été délivrée par l\'École Nationale des Sciences Appliquées de Tétouan.<br>';
      $html .= 'Ceci confirme que l\'étudiant a soumis une demande de type "' . $rowDemande[$typeDemandeID] . '".</p>';
      $html .= '<p>Nous vous prions de trouver ci-joint le document demandé.</p>';
      $html .= '</td>';
      $html .= '</tr>';
      $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
  
      $fields = array(
          'Contenu' => 'contenu',
          'Format' => 'format',
          'Nom de l\'Étudiant' => 'nomEtudiant',
          'CIN' => 'cin',
          'Date de Naissance' => 'dateNaissance',
          'Address' => 'address',
          'Année Académique' => 'anneeAcademique',
          'Programme' => 'programme',
          'Module' => 'module',
          'Moyenne' => 'moyenne',
          'Observation' => 'observation',
      );
  
      foreach ($fields as $label => $fieldName) {
          $html .= '<tr>';
          $html .= '<td style="width:30%;"><strong>' . $label . ':</strong></td>';
          $html .= '<td>' . $rowDocumentAcademique[$fieldName] . '</td>';
          $html .= '</tr>';
      }
  
    
      $html .= '</table>';
        $html .= '</table>';
  }
  
      
  
      



      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();

      $conn->close();

      return $dompdf->output();
  } else {
      $conn->close();
      die("No data found for demandeID: $demandeID");
  }
}

function sendEmailWithAttachment($recipientEmail, $subject, $message, $attachmentContent) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'aensate@gmail.com'; 
        $mail->Password = 'qkwm agor oddh xati'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    
        $mail->setFrom('aensate@gmail.com', 'Your Name'); 
        $mail->addAddress($recipientEmail);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);

        
        $mail->addStringAttachment($attachmentContent, 'DOCUMENT.pdf', 'base64', 'application/pdf');

        $mail->send();

        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo 'Error: ' . $mail->ErrorInfo;
    }
}






?>