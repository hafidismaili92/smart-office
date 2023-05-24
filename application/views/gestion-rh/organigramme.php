<html>
<head>
  <style type="text/css">
    #chart_div .google-visualization-orgchart-linebottom {
      border-bottom: 1px solid gray;
    }

    #chart_div .google-visualization-orgchart-lineleft {
      border-left: 1px solid gray;
    }

    #chart_div .google-visualization-orgchart-lineright {
      border-right: 1px solid gray;
    }

    #chart_div .google-visualization-orgchart-linetop {
      border-top: 1px solid gray;
    }
    .organigramme-block
    {
      border:1px solid #dddfdd;
      background-color: white;
      border-radius: 3px;
    }
   .organigramme-block.redborder
    {
       border-top: 3px solid #e76f51;
    }
    .organigramme-block.blueborder
    {
       border-top: 3px solid #264653;
    }
    .organigramme-block.greenborder
    {
       border-top: 3px solid #2a9d8f;
    }
    .organigramme-block.cyanborder
    {
       border-top: 3px solid #00FFFF;
    }
    .organigramme-block.magentaborder
    {
       border-top: 3px solid #8338ec;
    }
    .google-visualization-orgchart-table tr td.google-visualization-orgchart-node-medium div {
     width: 160px !important; 

   }
   .google-visualization-orgchart-noderow-medium
   {
    height: 80px !important;
   }

  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>assets/libraries/jquery/jquery-3.4.1.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {packages:["orgchart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Name');
      data.addColumn('string', 'Manager');
      data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        /*data.addRows([
          [{'v':'Mike', 'f':'Mike<div style="color:red; font-style:italic">President</div>'},
           '', 'The President'],
          [{'v':'Jim', 'f':'Jim<div style="color:red; font-style:italic">Vice President</div>'},
           'Mike', 'VP'],
          ['Alice', 'Mike', ''],
          ['Bob', 'Jim', 'Bob Sponge'],
          ['Carol', 'Bob', '']
          ]);*/
        //console.log(<?php echo $organigramme ?>);
        data.addRows(<?php echo $organigramme ?>);
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'nodeClass':'organigramme-block'});
        $colors = ['redborder','blueborder','greenborder','magentaborder','cyanborder'];
        $('#chart_div').find('.google-visualization-orgchart-noderow-medium').each(function(index){
          if(index  <5)
            $(this).find('.organigramme-block').addClass($colors[index]);
          else if(index % 5 == 0)
            $(this).find('.organigramme-block').addClass($colors[index % 5]);
          
        })
      }
    </script>
  </head>
  <body>
    <div id="chart_div"></div>
  </body>
  </html>
