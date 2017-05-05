<div class="container well">
    <p>
        <span style='font-size:20px'>Class name:</span>
        <select ng-model='selected_class' ng-change='class_selected()' >
            <option value=""></option>
            <option ng-repeat="class in classes" value="{{class.class_id}}">{{class.name}}</option>
        </select>
    </p>

    <p>
        <span style='font-size:20px'>Student list:</span>
        <select ng-model='selected_student' ng-change='student_selected()'>
            <option value=""></option>
            <option ng-repeat="student in students" value="{{student.student_id}}">{{student.student_name}}</option>
        </select>
    </p>

    <p>
        <span style='font-size:20px'>Student details:</span>
        <h3>Average score is: {{avg}}</h3>
        <table>
            <tr ng-repeat='row in student_detail'>
                <td>{{row.name}}</td>
                <td>{{row.grade}}</td>
            </tr>
        </table>
    </p>

</div>