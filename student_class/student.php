<div class="container well">
    <form ng-submit='submit_student()' >
    <div class="error" ng-show="showError">
      {{error}}
    </div>

    <div class="success" ng-show="showSuccess">
      Added one new student.
    </div>

    <div class="form-group">
      <label for="student_name">Student name:</label>
      <input name="student_name" type="text" ng-model="student_name" required />
    </div>
    <div class="form-group">
      <label for="student_email">Student email:</label>
      <input name="student_email" type="text" ng-model="student_email" required />
    </div>
    <div class="form-group">
      <label for="classes">Enrolled Classes:</label>
      
      <!--<select ng-model='enrolled_class'>
            <option value=""></option>
            <option ng-repeat="class in classes" value="{{class.class_id}}">{{class.name}}</option>
        </select>-->
    </div>
    <br />
    <br />
    <br />
    <ul type="checkbox" ng-repeat='class in classes track by $index'>   
        <li>
          <input type="checkbox" value="{{class.class_id}}" />{{class.name}}
          <input type="text" placeholder='Enter score...' ng-model='scores[$index]'/>
        </li>
    </ul>
    <!--<div class="form-group">
      <label for="score">Score:</label>
      <input name="score" type="text" ng-model="score" />
    </div>-->
    <input type="submit" value="Submit" class="btn btn-primary"/>
    <input type="reset" value="Reset" class="btn btn-warning" />
  </form>
</div>