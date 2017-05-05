<div class="container well">
  <form ng-submit='register_info()' >
  <div class="error" ng-show="showError">
      {{error_info}}
    </div>
    <div class="form-group">
      <label for="username">User name:</label>
      <input name="username" type="text" ng-model="username" required />
    </div>
    <div class="form-group">
      <label for="firstname">First name:</label>
      <input name="firstname" type="text" ng-model="firstname" required />
    </div>
    <div class="form-group">
      <label for="lastname">Last name:</label>
      <input name="lastname" type="text" ng-model="lastname" required />
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input name="password" type="password" ng-model="password" required />
    </div>
    <div class="form-group">
      <label for="cpassword">Confrim Password:</label>
      <input name="cpassword" type="password" ng-model="cpassword" required />
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input name="email" type="text" ng-model="primary_email" required />
    </div>
    <input type="submit" value="Register" class="btn btn-primary"/>
    <input type="reset" value="Reset" class="btn btn-warning"/>
  </form>
</div>