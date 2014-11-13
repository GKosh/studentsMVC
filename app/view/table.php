<table class="table table-hover">
        <thead>
            <tr>
				<th></th>
                <th>ID</th>
                <th>ФИО</th>
              	<th>Пол</th>
				<th>Возраст</th>
                <th>Группа</th>
              	<th>Факультет</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
		<?php
		foreach ($students as $student){
		?>
            <tr class="student-row">
				<td style="width: 5px;"><label><input id="radio" class="radio" type="radio" name="id" form="form" value=<?php echo $student['ID'];?>></label></td>
 				<td style="text-align:center;"><?php echo $student['ID'];?></td>
                <td class="name"><?php echo $student['Name'];?></td>
                <td class="sex"><?php echo $student['Sex'];?></td>
				<td class="age"><?php echo $student['Age'];?></td>
                <td class="group"><?php echo $student['Group'];?></td>
				<td class="faculty"><?php echo $student['Faculty'];?></td>
				<td class="delete" style="cursor: pointer; width: 15px; text-align:center;"> X </td>
				
            </tr>
		<?php
		};	
		?>
    
        </tbody>
    </table>