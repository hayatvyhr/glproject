<?php include "database.php";


// Get counts from the database
$reclamationCountQuery = "SELECT COUNT(*) AS totalReclamations FROM reclamation";
$demandeCountQuery = "SELECT COUNT(*) AS totalDemandes FROM demande";
$filierCountQuery = "SELECT COUNT(DISTINCT filiere) AS totalFilieres FROM etudiant";

$reclamationCountResult = mysqli_query($conn, $reclamationCountQuery);
$demandeCountResult = mysqli_query($conn, $demandeCountQuery);
$filierCountResult = mysqli_query($conn, $filierCountQuery);

$totalReclamations = mysqli_fetch_assoc($reclamationCountResult)['totalReclamations'];
$totalDemandes = mysqli_fetch_assoc($demandeCountResult)['totalDemandes'];
$totalFilieres = mysqli_fetch_assoc($filierCountResult)['totalFilieres'];
?>



 

<html>
  <link rel="stylesheet" href="style.css">
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['dateSubmission', 'Réclamation', 'demande'],
          <?php
            $reclamationQuery = "SELECT DATE(dateSubmission) AS date, ROUND(COUNT(*)) AS reclamations FROM reclamation GROUP BY DATE(dateSubmission)";
            $demandeQuery = "SELECT DATE(dateSubmission) AS date, ROUND(COUNT(*)) AS demandes FROM demande GROUP BY DATE(dateSubmission)";

            $reclamationRes = mysqli_query($conn, $reclamationQuery);
            $demandeRes = mysqli_query($conn, $demandeQuery);

            $reclamationData = [];
            while($reclamation = mysqli_fetch_array($reclamationRes)) {
              $reclamationData[$reclamation['date']] = $reclamation['reclamations'];
            }

            $demandeData = [];
            while($demande = mysqli_fetch_array($demandeRes)) {
              $demandeData[$demande['date']] = $demande['demandes'];
            }

            $dates = array_unique(array_merge(array_keys($reclamationData), array_keys($demandeData)));

            foreach($dates as $date) {
          ?>
           ['<?php echo $date;?>', <?php echo $reclamationData[$date] ?? 0;?>, <?php echo $demandeData[$date] ?? 0;?>],   
          <?php   
            }
          ?> 
        ]);

        var options = {
          chart: {
            title: 'STATISTIQUE',
            subtitle: 'Réclamation and demande by dateSubmission',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div class="parent">
      
 
      <div class="row">
        <div class="col-md-3">
          <div class="panel panel-default font-med">
          <div class="panel-heading text-muted">Reclamation</div>
          <div class="panel-body"><?php echo $totalReclamations; ?></div>

          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default font-med">
            <div class="panel-heading text-muted">Demande</div>
            
            <div class="panel-body" ><?php echo $totalDemandes; ?></div>

          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default font-med">
            <div class="panel-heading text-muted">Filiere</div>

            <div class="panel-body"><?php echo $totalFilieres; ?></div>
          </div>
        </div>
      </div>
      <div class="div7" id="barchart_material" style="width: 900px; height: 500px;"><?php include "database.php";?></div>
    </div>
  </body>
</html>
