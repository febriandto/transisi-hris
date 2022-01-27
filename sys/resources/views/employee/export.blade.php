<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Employee_List_Export(".date('d-F-Y').").xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<img src="{{ asset('images/logo.PNG') }}"><br>
<h3> DAFTAR KARYAWAN PT. XD SAKTI INDONESIA (<?php echo date('d-F-Y');?>)</h3>
  <table width="100%" id="data" border="1" cellpadding="8">
    <thead>
      <tr>
        <th>NIK</th>
        <th>Employee Name</th>
        <th>Department</th>
        <th>Section</th>
        <th>Level</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach( $employee as $data )
      <tr>
        <td align="center"><?php echo $i++; ?></td>
        <td><?php echo $data->id_emp;?></td>
        <td><a href="emp_detail?id_emp=<?php echo $data->id_emp;?>">
          <?php echo $data->emp_name;?>
        </td>
        <td><?php echo $data->dept_name;?></td>
        <td><?php echo $data->section_name;?></td>
        <td><?php echo $data->grade_name;?></td>
        <td><?php echo $data->emp_status;?></td>
      </tr>
      @endforeach
	</table>