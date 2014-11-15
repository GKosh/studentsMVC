<?php
/**
* Default view 
* view.php
* 
* View use variables provided by controller and output html 
*
*
* @vertion 1.0
* @author G.Kosh
*/
?>

 <div id="content">
<h2><?php echo $title; ?></h2>
<div id="table_container">
<div class="form">
    <table class="table table-hover">
        <thead>
            <tr>
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
    <form  id="users_form" action="<?= \app::getURL() . "students" ?>" class="form-horizontal">
	
	<tr id="edit-form">
				<td id="id"></td>
                <td>
					<input id="name" name="Name" type="text" placeholder="ФИО"/> </input>
				</td>
                <td>
					<input id="sex" name="Sex" type="text" placeholder="Пол"/> </input>
				</td>
				<td>
					<input id="age" name="Age" type="text" placeholder="Возраст"/> </input>
				</td>
                <td>
					<input id="group" name="Group" type="text" placeholder="Группа"/> </input>
				</td>
				<td>
						<input id="faculty" name="Faculty" type="text" placeholder="Пол"/> </input>
				</td>
				<td> 
				 <input id="addNew" type="button" class="button" value="Добавить">
                <input id="update" type="button" class="button" value="Переписать">
				</td>
				
    </tr>
	
			   
     </form>
		</tbody>
	</table>
</div>
</div>
<div id="table_container">
<div  id="tableBody" class="bs-example">
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
				<th>Удалить</th>
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
</div>
</div>

 
</div>