jQuery(function($) {
    $('#registration-form').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this)
        var data = $form.serialize();

        $.ajax({
            type: 'POST',
            url: '/form_submit.php',
            data: data,
            success: function(data){
                var request = JSON.parse(data);
                if(request.errors) {
                    console.log(request.errors.length);
                    $('#notices').html(request.errors);
                }
                else {
                    $('#notices').html('<div class="success">Form was successfully submitted!</div>');
                    $form[0].reset();
                }
            }
        });
    });

    $('#discipline').on('change', function() {
        var selected;
        $('fieldset[data-set]').hide();
        $('fieldset[data-set]').find('select').val('');
        if(selected = $(this).find(":selected").attr('data-set')){
            console.log(selected);
            $('fieldset[data-set='  + selected + ']').show();
        }
    });

    if($('#statistics-page').length) {
        $('#data-table').DataTable();
        var labels, nums;

        $.ajax({
            type: 'POST',
            url: '/statistics_ajax.php?action=getStatisticsData',
            async: false,
            success: function(data){
                var res = JSON.parse(data);
                console.log(data);
                labels = res.labels;
                nums = res.data_nums;
            }
        });

        var pie = $("#all-discipline-pie");
        var bar = $("#all-discipline-bar");
        var data_pie = {
            datasets: [{
                data: nums,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }],
            labels: labels
        };
        var data_bar= {
            datasets: [{
                data: nums,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }],
            labels: labels
        };
        var options_bar = {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        };

        var doughnutChart = new Chart(pie, {
            type: 'pie',
            data: data_pie,
        });

        var barChart = new Chart(bar, {
            type: 'bar',
            data: data_bar,
            options: options_bar
        });
    }
});