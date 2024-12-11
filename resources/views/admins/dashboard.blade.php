@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-2 gap-4 p-4">
    <!-- Gender Distribution -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Gender Distribution</h3>
        <canvas id="genderChart"></canvas>
    </div>

    <!-- Age Distribution -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Age Groups</h3>
        <canvas id="ageChart"></canvas>
    </div>

    <!-- Civil Status -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Civil Status</h3>
        <canvas id="civilStatusChart"></canvas>
    </div>

    <!-- Educational Attainment -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Educational Attainment</h3>
        <canvas id="educationChart"></canvas>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gender Chart
        new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: @json($genderStats -> pluck('sex')),
                datasets: [{
                    data: @json($genderStats -> pluck('count')),
                    backgroundColor: ['#4169E1', '#FF69B4']
                }]
            }
        });

        // Age Chart
        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: @json($ageStats -> pluck('age_group')),
                datasets: [{
                    label: 'Number of Residents',
                    data: @json($ageStats -> pluck('count')),
                    backgroundColor: '#4169E1'
                }]
            }
        });

        // Civil Status Chart
        new Chart(document.getElementById('civilStatusChart'), {
            type: 'pie',
            data: {
                labels: @json($civilStatusStats -> pluck('civil_status')),
                datasets: [{
                    data: @json($civilStatusStats -> pluck('count')),
                    backgroundColor: ['#4169E1', '#FF69B4', '#FFB347', '#98FB98']
                }]
            }
        });

        // Education Chart
        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: @json($educationStats -> pluck('educational_attainment')),
                datasets: [{
                    label: 'Number of Residents',
                    data: @json($educationStats -> pluck('count')),
                    backgroundColor: '#4169E1'
                }]
            },
            options: {
                indexAxis: 'y' // Horizontal bar chart
            }
        });
    });
</script>
@endsection