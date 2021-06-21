<?php include('../page/template/header.php');?>

<?php if($user->can('displayUsersByRole'))
{
    $html=DashboardUtils::welcome($user->getFirstName(),$user->getLastName(),$nbEmployee,$nbService,$nbDirection);
}
else{
    $html=DashboardUtils::welcome($user->getFirstName(),$user->getLastName());
}



echo $html ;
?>

<div class="d-flex">
<?= SmallBox::success('Nombre de tâches effectuées',$nbTaskDone,'taskList'); ?>
<?= SmallBox::warning('Tâches non effectuées',$taskNotDone[0]->getTasks(),'taskList'); ?>

</div>


    <div class="chart-container" style="position: relative; height:50%; width:50%; margin-top: 1em; display: <?= $display; ?>;">
        <canvas id="myChart"></canvas>
        <canvas id="myChart2"></canvas>
    </div>


    <script>

        function chartJs()
        {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['<?= date('Y', strtotime('-11 year')) ?>', '<?= date('Y', strtotime('-10 year')) ?>', '<?= date('Y', strtotime('-9 year')) ?>', '<?= date('Y', strtotime('-8 year')) ?>', '<?= date('Y', strtotime('-7 year')) ?>', '<?= date('Y', strtotime('-6 year')) ?>', '<?= date('Y', strtotime('-5 year')) ?>', '<?= date('Y', strtotime('-4 year')) ?>', '<?= date('Y', strtotime('-3 year')) ?>', '<?= date('Y', strtotime('-2 year')) ?>', '<?= date('Y', strtotime('-1 year')) ?>', '<?= date('Y') ?>'],
                    datasets: [{
                        label: 'Tâches Réalisés',
                        data: <?= json_encode($graphTasksDone) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1.5
                    },
                        {
                            label: "Tâches non réalisées",
                            data: <?= json_encode($graphTasksNotDone) ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderWidth: 1.5
                        }
                    ]
                },

                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        function chartJs2()
        {
            var ctx = document.getElementById('myChart2');
            var myChart2 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Red',
                        'Blue',
                        'Yellow'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
                });
        }
        document.addEventListener("DOMContentLoaded", function(){
            chartJs();
            chartJs2();
        });
    </script>

<?php
$scripts = ['https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js'];
include ('../page/template/footer.php');
?>