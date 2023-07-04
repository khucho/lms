$(document).ready(function(){
    $(document).on('click','.btn_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') // javascript cann't edit database
            /////////////////////////// ..AJAX..//////////////////////////////////////////
            $.ajax({
                method:'post',
                url:'delete_category.php',
                data:{id:id},
                success:function(response){
                    if(response == 'success')
                    {
                        alert ("Successfully deleted!")
                        location.href = 'category.php'
                    }
                    else{
                        alert(response)
                    }
                },
                error:function(error){
                    
                }
            })
        }
    })
    $(document).on('click','.instructor_btn_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') // javascript cann't edit database
            /////////////////////////// ..AJAX..//////////////////////////////////////////
            $.ajax({
                method:'post',
                url:'delete_instructor.php',
                data:{id:id},
                success:function(response){
                    if(response == 'success')
                    {
                        alert ("Successfully deleted!")
                        location.href = 'instructor.php'
                    }
                    else{
                        alert(response)
                    }
                },
                error:function(error){
                    
                }
            })
        }
    })
    $(document).on('click','.course_btn_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') // javascript cann't edit database
            /////////////////////////// ..AJAX..//////////////////////////////////////////
            $.ajax({
                method:'post',
                url:'delete_course.php',
                data:{id:id},
                success:function(response){
                    if(response == 'success')
                    {
                        alert ("Successfully deleted!")
                        location.href = 'course.php'
                    }
                    else{
                        alert(response)
                    }
                },
                error:function(error){
                    
                }
            })
        }
    })
    $(document).on('click','.trainee_btn_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') // javascript cann't edit database
            /////////////////////////// ..AJAX..//////////////////////////////////////////
            $.ajax({
                method:'post',
                url:'delete_trainee.php',
                data:{id:id},
                success:function(response){
                    if(response == 'success')
                    {
                        alert ("Successfully deleted!")
                        location.href = 'trainee.php'
                    }
                    else{
                        alert(response)
                    }
                },
                error:function(error){
                    
                }
            })
        }
    })
    $(document).on('click','.batch_btn_delete',function(event){
        event.preventDefault();
        let status = confirm("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id')

            $.ajax({
                method: 'post',
                url : 'delete_batch.php',
                data: {id:id},
                success:function(response){
                    if(response == 'success')
                     {
                        alert('Successfully deleted!')
                        location.href = 'batch.php'
                     }
                     else
                     {
                        alert(response)
                     }
                },
                error:function(error){

                }
            })
        }
    })
    $(document).on('click','.tc_delete',function(event){
        event.preventDefault();
        let status = confirm("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id')

            $.ajax({
                method: 'post',
                url : 'delete_trainee_course.php',
                data: {id:id},
                success:function(response){
                    if(response == 'success')
                     {
                        alert('Successfully deleted!')
                        location.href = 'trainee_course.php'
                     }
                     else
                     {
                        alert(response)
                     }
                },
                error:function(error){

                }
            })
        }
    })
    $(document).on('click','.project_delete',function(event){
        event.preventDefault();
        let status = confirm("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id')

            $.ajax({
                method: 'post',
                url : 'delete_project.php',
                data: {id:id},
                success:function(response){
                    if(response == 'success')
                     {
                        alert('Successfully deleted!')
                        location.href = 'project.php'
                     }
                     else
                     {
                        alert(response)
                     }
                },
                error:function(error){

                }
            })
        }
    })
    $(document).on('click','.add_btn',function(event){
        event.preventDefault();
        let id = $(this).parent().attr('id');
        $.ajax({
            url : 'get_trainee.php',
            method: 'post',
            data:{id:id},
            success:function(response){
                $('.rows').append(response);
            },
            error: function(message){

            }
        })
        
     
    })
    $(document).on('click','.delete_btn',function(event){
        event.preventDefault();
        $(this).parent().parent().remove();
    })
    $('#mytable').DataTable();
    $.ajax({
        url : 'report_chart.php',
        method: 'post',
        success:function(response)
        {
            let batch = JSON.parse(response)
            console.log(batch);
            let year= [];
            let data = [];
            for(let index = 0; index < batch.length; index++)
            {
                year[index] = batch[index].year;
                data[index] = batch[index].total;
             }

            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line", // bar_chart,pie, etc....
				data: {
					labels: year,
					datasets: [{
						label: "Batches",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: data
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
        },
        error:function(message)
        {

        }
    })
    $.ajax({
        url : 'report_pie.php',
        method: 'post',
        success: function(response)
        {
            let course = JSON.parse(response);
            console.log(course);
            let total = [];
            let data = [];

            for(let index = 0; index < course.length; index++)
            {
                total[index] = course[index].total;
                data[index] = course[index].tname;
            }
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: data,
					datasets: [{
						data: total,
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});

        },
        error: function(message)
        {

        }
    })


})