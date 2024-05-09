<?php
$repo_owner = 'octocat';
$repo_name = 'Hello-World';
$url = "https://api.github.com/repos/$repo_owner/$repo_name";
$response = file_get_contents($url);
$data = json_decode($response, true);
$stars_count = $data['stargazers_count'];
$watchers_count = $data['watchers_count'];
$forks_count = $data['forks_count'];
$chart_data = json_encode([
    'labels' => ['Stars', 'Watchers', 'Forks'],
    'datasets' => [
        [
            'label' => 'GitHub Stats',
            'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
            'borderColor' => ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
            'borderWidth' => 1,
            'data' => [$stars_count, $watchers_count, $forks_count],
        ],
    ],
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Stats</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="githubChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById('githubChart').getContext('2d');
        var githubChart = new Chart(ctx, {
            type: 'bar',
            data: <?php echo $chart_data; ?>,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>