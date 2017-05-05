<div class="container well">
  <form ng-submit='submit_info()' >
    <div class="error" ng-show="showError">
      Username or password is not correct.
    </div>
    <div class="form-group">
      <label for="username">User name:</label>
      <input name="username" type="text" ng-model="username" required />
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input name="password" type="password" ng-model="password" required />
    </div>
    <input type="submit" value="Submit" class="btn btn-primary"/>
    <input type="reset" value="Register" class="btn btn-warning" ng-click='go_register()'/>
  </form>
</div>