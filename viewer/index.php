<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Integrity Monitoring</title>
        
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/> 
        <link href="javascript/lib/c3-0.7.8/c3.min.css " rel="stylesheet">
   

		
        <script src="javascript/lib/jquery/jquery-3.4.1.min.js"></script>
        
        <script src="javascript/lib/leaflet/leaflet.js"></script>
        
        <script src="javascript/lib/d3-5.11.0/d3.min.js" charset="utf-8"></script>
        <script src="javascript/lib/c3-0.7.8/c3.min.js"></script>

        <script src="javascript/lib/highchart-7.2.0/highcharts.js"></script>
        <script src="javascript/lib/highchart-7.2.0/highcharts-more.js"></script>
        <script src="javascript/lib/highchart-7.2.0/modules/exporting.js"></script>
        <script src="javascript/monitor.js"></script>

    </head>
    


    <body>
        <div class='header'>
        <h1>PPP-RtQM<img class='logo' src="images/unesp.jpg"></h1>
        <h2>PPP-based Real-time Quality Monitoring of GNSS-SP reference stations</h2>
        </div>
        <div class='split-container'>
            <div class='left'>
                <div id="stations-map"></div>
            </div>
            <div class='right'>
                <table>
                    <tr>
                        <th>Ref Station</th>
                        <th>Last Epoch</th>
                        <th>Last Status</th>
                        <th>Quality in                 
                            <select id='cbTime'>
                                <option value='30' selected> 30 min</option>
                                <option value='60'>1 hour</option>
                                <option value='120'>2 hours</option>
                                <option value='All'>all time</option>
                            </select>
                        </th>
                    </tr>
                    <tr id="PPTE0-tr">
                        <td>PPTE0</td>
                        <td id='PPTE0-last-solution'></td>
                        <td id='PPTE0-status'></td>
                        <td id='PPTE0-percent'></td>
                    </tr>
                    <tr id="ROSA0-tr">
                        <td>ROSA0</td>
                        <td id='ROSA0-last-solution'></td>
                        <td id='ROSA0-status'></td>
                        <td id='ROSA0-percent'></td>
                    </tr>
                    <tr id="SPAR0-tr">
                        <td>SPAR0</td>
                        <td id='SPAR0-last-solution'></td>
                        <td id='SPAR0-status'></td>
                        <td id='SPAR0-percent'></td>
                    </tr>
                    <tr id="SPDR0-tr">
                        <td>SPDR0</td>
                        <td id='SPDR0-last-solution'></td>
                        <td id='SPDR0-status'></td>
                        <td id='SPDR0-percent'></td>
                    </tr>
                    <tr id="SPTU0-tr">
                        <td>SPTU0</td>
                        <td id='SPTU0-last-solution'></td>
                        <td id='SPTU0-status'></td>
                        <td id='SPTU0-percent'></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class='chart-container'>
            <div class='toolbar'>
                <select id='cbStation'>
                    <option value='PPTE0' selected>PPTE0</option>
                    <option value='ROSA0'>ROSA0</option>
                    <option value='SPAR0'>SPAR0</option>
                    <option value='SPDR0'>SPDR0</option>
                    <option value='SPTU0'>SPTU0</option>
                </select>
                <button type="button" id='btnSigma'>Show sigma</button>

            </div>
            <div id='neu-chart'>

            </div>
        </div>
    </body>
</html>