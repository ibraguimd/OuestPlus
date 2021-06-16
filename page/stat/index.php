<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Test ChartJS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/helpers.esm.min.js"</script>
</head>
<body>
    <canvas style="display: block; box-sizing: border-box; height: 384px; width: 768px;" width="768" height="384"></canvas>
</body>

<script>
    const labels = Utils.months({count: 7});
    const data = {
        labels: labels,
        datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
</script>

</html>
