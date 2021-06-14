<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Test ChartJS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/helpers.esm.min.js"</script>
</head>
<body>
    <canvas id="graph1"></canvas>
</body>
</html>

<script>
    var ctx = document.getElementById('graph1')

    var data = {
        labels: ['test 1','test 2','test 3','test 4','test 5']
        datasets:[
                {
                data1:[10, 20, 30, 40, 50]
                },
                {
                data2:[10, 20, 30, 40, 50]
                }
                ]

    }

    var options

    var config = {
        type:'line',
        data: data,
        options: options
    }
    var graph1 = new Chart(ctx, config)
</script>