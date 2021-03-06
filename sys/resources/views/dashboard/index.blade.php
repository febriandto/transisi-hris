@extends('dashboard')

@section('title')
	Dashboard
@stop

@section('breadcrumb')
	<span class="small"> Dashboard </span>
@stop

@section('content')
<section id="konten">

	<div class="container ">
	   <h5 class="page_title"> Halo, {{Auth::user()->name}} </h5> 
	</div>

	<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

    		
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h5> Jalan Pintas </h5>
                        <hr>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="col-md-6 sh_link" style=" margin-bottom:20px; ">
                                <a href="{{ route('employee.index') }}">
                                    <div class="shortcut_list" style="padding: 5px !important;">
                                        <h1 align="center" style="font-size: 50px; font-weight: bold; color: orange;">
                                            {{ $CountEmploye }}
                                        </h1> 
                                        <p style="font-size: 14px; font-style: italic;"> &nbsp;Semua Karyawan </p>

                                    </div>
                                </a>
                                </div>

                                <div class="col-md-6 sh_link" style=" margin-bottom:20px;">
                                <a href="{{ route('employee.bod') }}">
                                    <div class="shortcut_list" style="padding: 5px !important">
                                        <h1 align="center" style="font-size: 50px; font-weight: bold; color: orange;">
                                            {{ $CountBOD }}
                                        </h1> 
                                        <p style="font-size: 14px; font-style: italic;"> &nbsp; BOD </p>

                                    </div>
                                </a>
                                </div>

                                <div class="col-md-6 sh_link" style=" margin-bottom:20px;">
                                <a href="{{ route('employee.local') }}">
                                    <div class="shortcut_list" style="padding: 5px !important">
                                        <h1 align="center" style="font-size: 50px; font-weight: bold; color: orange;">
                                            {{ $CountLocalEmploye }}
                                        </h1> 
                                        <p style="font-size: 14px; font-style: italic;"> &nbsp;Karyawan Lokal </p>

                                    </div>
                                </a>
                                </div>

                                <div class="col-md-6 sh_link" style=" margin-bottom:20px;">
                                <a href="{{ route('employee.foreign') }}">
                                    <div class="shortcut_list" style="padding: 5px !important">
                                        <h1 align="center" style="font-size: 50px; font-weight: bold; color: orange;">
                                            {{ $CountForeignEmploye }}
                                        </h1> 
                                        <p style="font-size: 14px; font-style: italic;"> &nbsp; Karyawan Asing </p>

                                    </div>
                                </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="../employee/emp?add=true" title="New Employee">
                                            <div class="shortcut_list">
                                                <p align="center"><i class="fa fa-plus" style="color: blue"></i>
                                                </p>
                                                <h5 align="center"> Karyawan </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="../acc_emp/acc_emp?add=true" title="New Accident">
                                            <div class="shortcut_list">
                                                <p align="center"><i class="fa fa-info-circle" style="color: orange;"></i></p>
                                                <h5 align="center"> Kecelakaan </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="../sp/sp?add=true" title="New SP">
                                            <div class="shortcut_list">
                                                <p align="center"><i class="fa fa-file-text-o" style="color: purple;"></i></p>
                                                <h5 align="center"> SP </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="#../notes/notes?add=true">
                                            <div class="shortcut_list" title="New Notes">
                                                <p align="center"><i class="fa fa-sticky-note-o" style="color: grey;"></i></p>
                                                <h5 align="center"> Catatan </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="#../todo/todo?add=true">
                                            <div class="shortcut_list" title="To Do List">
                                                <p align="center"><i class="fa fa-pencil" style="color: green;"></i></p>
                                                <h5 align="center"> List Pekerjaan </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 sh_link" style="margin-bottom: 20px;"> 
                                        <a href="../training/training?add=true" >
                                            <div class="shortcut_list" title="New Training">
                                                <p align="center"><i class="fa fa-bicycle" style="color: black;"></i></p>
                                                <h5 align="center"> Pelatihan </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                        
                        <hr> 

                        <ul class="nav nav-tabs">
                          <li class="active"><a id="no_radius" data-toggle="tab" href="#home">Jenis Kelamin & Status</a></li>
                          <li><a id="no_radius" data-toggle="tab" href="#menu1">Anggota Tim</a></li>
                          <li><a id="no_radius" data-toggle="tab" href="#menu2">Keahlian</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <br>
                                <h5> Umum HR</h5><hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="container3" class="chart_box"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="container2" class="chart_box"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <br>
                                <h5> Anggota Tim</h5><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="container4" class="chart_box"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="container5" class="chart_box"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <br>
                                <h3>Keahlian</h3>
                                <p>Area Keahlian</p>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content">
                                <h5> Monitoring Karyawan Kontrak </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3 sh_link"> 
                                                <a href="../employee/emp_contract_list">
                                                    <div class="shortcut_list">
                                                        <p align=""><i class="fa fa-black-tie red_text" style="border: 1px solid rgba(1,1,1,0.1); padding: 15px;"></i> 
                                                        <span> {{ $CountToday }} </span></p>
                                                        <hr>
                                                        <h5 align="center"> Kontrak Berakhir ( Hari Ini ) </h5>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3 sh_link"> 
                                                <a href="../employee/emp_contract_list?this_month=true">
                                                    <div class="shortcut_list">
                                                        <p align=""><i class="fa fa-black-tie" style="color:orange;border: 1px solid rgba(1,1,1,0.1); padding: 15px;"></i> 
                                                        <span> {{ $CountMonth }} </span></p>
                                                        <hr>
                                                        <h5 align="center"> Kontrak Berakhir ( Bulan Ini ) </h5>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3 sh_link"> 
                                                <a href="../employee/emp_contract_list?next_month=true">
                                                    <div class="shortcut_list">
                                                        <p align=""><i class="fa fa-black-tie" style="color:green; border: 1px solid rgba(1,1,1,0.1); padding: 15px;"></i> 
                                                        <span> {{ $CountNextMonth }} </span></p>
                                                        <hr>
                                                        <h5 align="center"> Kontrak Berakhir ( Bulan Depan ) </h5>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-3 sh_link"> 
                                                <a href="../employee/emp_contract_list?non_permanent=true">
                                                    <div class="shortcut_list">
                                                        <p align=""><i class="fa fa-black-tie" style="color:purple; border: 1px solid rgba(1,1,1,0.1); padding: 15px;"></i> 
                                                        <span> {{ $CountAll }} </span></p>
                                                        <hr>
                                                        <h5 align="center"> Semua Karyawan Kontrak </h5>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
    
                    <br>

                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="content">
                                <h2 align="center"> We are "Growth" </h2>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    
</section>
@stop

@section('script')
<script>

        Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Gender Chart',
        align: 'center',
        verticalAlign: '',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Employee Gender',
        innerSize: '50%',
        data: [
            ['Male', {{ $CountMale }}],
            ['Female', {{ $CountFemale }}],            
        ]
    }]
});

    Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Employment Status Chart',
        align: 'center',
        verticalAlign: '',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Percentage',
        innerSize: '50%',
        data: [
                ['Probation',       {{ $CountProbation }}],
                ['Kontrak',         {{ $CountContract }}],
                ['Permanent',       {{ $CountPermanent }}],
                ['Outsourching',    {{ $CountOutsourching }}],
        ]
    }]
});

// Time
function show2(){
    if (!document.all&&!document.getElementById)
    return
    thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
    var Digital=new Date()
    var hours=Digital.getHours()
    var minutes=Digital.getMinutes()
    var seconds=Digital.getSeconds()
    var dn="PM"
    if (hours<12)
    dn="AM"
    if (hours>12)
    hours=hours-12
    if (hours==0)
    hours=12
    if (minutes<=9)
    minutes="0"+minutes
    if (seconds<=9)
    seconds="0"+seconds
    var ctime=hours+":"+minutes+":"+seconds+" "+dn
    thelement.innerHTML=ctime
    setTimeout("show2()",1000)
}
window.onload=show2
//-->

</script>
@stop